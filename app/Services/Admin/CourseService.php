<?php

namespace App\Services\Admin;

use App\Http\Requests\Courses\StoreRequest;
use App\Http\Requests\Courses\UpdateRequest;
use App\Libs\Service\BaseService;
use App\Libs\Traits\HandleUpload;
use App\Models\Course;
use App\Models\CourseTeacher;
use App\Services\LMS\CourseLMSService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CourseService extends BaseService
{
    use HandleUpload;

    /**
     * @var int
     */
    protected $perPage = 10;

    public function index(Request $request)
    {
        $courses = $this->getCourses($request);
        $methods = Course::METHODS;

        return compact('courses', 'methods');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getCourses(Request $request)
    {
        $paginate = $request->perpage ?? $this->perPage;
        $query = Course::query();

        if ($request->text) {
            $query->where('name', 'like', '%'.$request->text.'%');
        }

        if ($request->get('method')) {
            $query->where('method', $request->get('method'));
        }

        if ($request->subjects) {
            $subjects = array_filter(explode(',', $request->subjects));
//            $query->join('course_subject', 'courses.id', '=', 'course_subject')
//                ->whereIn('course_subject.subject_id', $subjects);
            $query->whereHas('courseSubjects', function (Builder $builder) use ($subjects) {
                $builder->whereIn('subject_id', $subjects);
            });
        }

        $courses = $query
            ->orderByDesc('id')
            ->paginate($paginate);

        return $courses;
    }

    /**
     * @return array
     */
    public function create(): array
    {
        $types = Course::TYPES;
        $classes = (new ClassService())->index(request());
        $methods = Course::METHODS;

        return array_merge(compact('types', 'methods'), $classes);
    }

    /**
     * @param StoreRequest $request
     * @return int
     */
    public function store(StoreRequest $request): int
    {
        /** @var Course $course */
        $course = Course::query()->create($this->prepareData($request));
        $course->syncClasses((array) $request->classes);
        $course->syncSubjects((array) $request->subjects);
        if (!empty((array)$request->teachers)) {
            foreach ((array)$request->teachers as $teacherId) {
                $course->teachers()->syncWithoutDetaching([
                    $teacherId => [
                        'order' => (CourseTeacher::query()->where('course_id', $course->id)->max('order') ?? 0) + 1
                    ]
                ]);
            }
        }

        return $course->id;
    }

    /**
     * @param int $id
     * @return array
     */
    public function edit(int $id)
    {
        /** @var Course $course */
        $course = Course::query()->findOrFail($id);
        $course->classIds = $course->courseClasses()->pluck('class_id')->toArray();
        $lmsCourse = (new CourseLMSService())->findById($course->lms_id);
        $teachers = (new TeacherService())->getByCourse($id)->load('subjects');

        return array_merge($this->create(), compact('course', 'lmsCourse', 'teachers'));
    }

    /**
     * @param UpdateRequest $request
     * @param int $id
     * @return bool
     */
    public function update(UpdateRequest $request, int $id)
    {
        /** @var Course $course */
        $course = Course::query()->findOrFail($id);
        $course->update($this->prepareData($request));
        $course->syncClasses((array) $request->classes);
        $course->syncSubjects((array) $request->subjects);

        return true;
    }

    /**
     * @throws \Exception
     */
    public function destroy(int $id)
    {
        /** @var Course $course */
        $course = Course::query()->findOrFail($id);

        return $course->delete();
    }

    /**
     * @param StoreRequest|UpdateRequest $request
     * @return array
     */
    protected function prepareData(Request $request): array
    {
        $attributes = $request->all();
        unset($attributes['classes']);
        unset($attributes['subjects']);
        foreach (['is_public', 'is_highlight'] as $boolAttr) {
            $attributes[$boolAttr] = (int) isset($attributes[$boolAttr]);
        }

        $slug = $attributes['slug'] ?? $attributes['name'];
        $slug = Str::slug($slug);
        $slugQuery = Course::query()->where('slug', $slug);
        if ($request->id) {
            $slugQuery->where('id', '<>', $request->id);
        }
        while ($slugQuery->exists()) {
            $slug .= '-' . rand(0, 9);
        }
        $attributes['slug'] = $slug;
        foreach (['desktop_avatar', 'mobile_avatar'] as $key) {
            if ($request->file($key)) {
                $attributes[$key] = $this->uploadImage($request->file($key), storage_path('app/public/'.Course::AVATAR_DIR));
            }
        }

        $includesContentKeys = [
            'video_include',
            'article_include',
            'access_include',
            'certificate_include',
        ];
        $contents = [];
        foreach ($includesContentKeys as $key) {
            $contents[$key] = $request->{$key} ?? '';
        }
        $attributes['include_content'] = json_encode($contents);

        return $attributes;
    }

    /**
     * @param Request $request
     * @param int $id
     * @return bool
     */
    public function updateStatus(Request $request, int $id)
    {
        if (! in_array($request->column, ['is_public', 'is_highlight'])) {
            return false;
        }

        return $this->updateStatusData(new Course(), $id, $request->column);
    }

    /**
     * @param Request $request
     * @param int $id
     * @return array
     */
    public function addTeachers(Request $request, int $id)
    {
        /** @var Course $course */
        $course = Course::query()->findOrFail($id);
        foreach ((array)$request->teacher_ids as $teacherId) {
            $course->teachers()->syncWithoutDetaching([
                $teacherId => [
                    'order' => (CourseTeacher::query()->where('course_id', $course->id)->max('order') ?? 0) + 1
                ]
            ]);
        }

        $teachers = (new TeacherService())->getByCourse($id)->load('subjects');

        return compact('teachers', 'course');
    }

    /**
     * @param Request $request
     * @param int $id
     * @return bool
     */
    public function reorderTeachers(Request $request, int $id)
    {
        $teacherIds = array_values((array) $request->sort);

        $orders = CourseTeacher::query()
            ->where('course_id', $id)
            ->whereIn('teacher_id', $teacherIds)
            ->orderByDesc('order')
            ->pluck('order')
            ->toArray();

        foreach ($orders as $key => $value) {
            CourseTeacher::query()
                ->where([
                    ['course_id', $id],
                    ['teacher_id', $teacherIds[$key]]
                ])
                ->update(['order' => $value]);
        }

        return true;
    }

    /**
     * @param int $id
     * @param int $teacherId
     * @return bool
     */
    public function destroyTeacher(int $id, int $teacherId)
    {
        /** @var Course $course */
        $course = Course::query()->findOrFail($id);
        $course->teachers()->detach([$teacherId]);

        return true;
    }

    /**
     * @param int $id
     * @param int $teacherId
     * @return bool
     */
    public function addTeacher(int $id, int $teacherId)
    {
        /** @var Course $course */
        $course = Course::query()->findOrFail($id);
        $course->teachers()->syncWithoutDetaching([
            $teacherId => [
                'order' => (int) CourseTeacher::query()->where('course_id', $course->id)->max('order') + 1
            ]
        ]);

        return true;
    }

    /**
     * @param Request $request
     * @param int $id
     * @return array
     */
    public function getTeachersPaginate(Request $request, int $id)
    {
        $allTeachers = (new TeacherService())->index($request)['teachers'];
        /** @var Course $course */
        $course = Course::query()->findOrFail($id);
        $teacherSelectedIds = $course->courseTeachers()->pluck('teacher_id')->toArray();

        return compact('allTeachers', 'course', 'teacherSelectedIds');
    }

    /**
     * @param int $courseId
     * @return array
     */
    public function getAllTeacherByCourse(int $courseId)
    {
        /** @var Course $course */
        $course = Course::query()->findOrFail($courseId);
        $teachers = (new TeacherService())->getByCourse($courseId);

        return compact('course', 'teachers');
    }
}
