<?php

namespace App\Services\Admin;

use App\Http\Requests\Teachers\StoreRequest;
use App\Http\Requests\Teachers\UpdateRequest;
use App\Libs\Service\BaseService;
use App\Libs\Traits\HandleUpload;
use App\Models\Teacher;
use App\Models\TeacherSubject;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class TeacherService extends BaseService
{
    use HandleUpload;

    /**
     * @var int
     */
    protected $perPage = 10;

    public function index(Request $request)
    {
        $paginate = $request->perpage ?? $this->perPage;
        $query = Teacher::query();

        if ($request->text) {
            $query->where(function (Builder $builder) use ($request) {
                $text = '%'.$request->text.'%';
                $builder->where('name', 'like', $text)
                    ->orWhere('label', 'like', $text);
            });
        }

        if ($request->subject_ids) {
            $subjectIds = explode(',', $request->subject_ids);
            $query->whereHas('teacherSubjects', function (Builder $builder) use ($subjectIds) {
                return $builder->whereIn('subject_id', $subjectIds);
            });
        }

        if ($request->need_subjects) {
            $query->with('subjects');
        }

        if ($request->is_for_course) {
            if ($request->selected_ids) {
                $query->whereNotIn('id', (array)$request->selected_ids);
            } else {
                $query->whereNotIn('id', function ($query) {
                    $query->select('teacher_id')
                        ->from('course_teacher')
                        ->where('course_id', request()->course_id);
                });
            }
        }

        $teachers = $query
            ->orderByDesc('id')
            ->paginate($paginate);

        return compact('teachers');
    }

    /**
     * @param StoreRequest $request
     * @return int
     */
    public function store(StoreRequest $request)
    {
        /** @var Teacher $teacher */
        $teacher = Teacher::query()->create($this->prepareData($request));
        if (!empty((array)$request->subjects)) {
            foreach ((array)$request->subjects as $subjectId) {
                $teacher->subjects()->syncWithoutDetaching([
                    $subjectId => [
                        'order' => (TeacherSubject::query()->where('teacher_id', $teacher->id)->max('order') ?? 0) + 1
                    ]
                ]);
            }
        }

        return $teacher->id;
    }

    /**
     * @param int $id
     * @return array
     */
    public function edit(int $id): array
    {
        /** @var Teacher $teacher */
        $teacher = Teacher::query()->findOrFail($id);
        $subjects = (new SubjectService())->getByTeacher($id);

        return compact('teacher', 'subjects');
    }

    /**
     * @param UpdateRequest $request
     * @param int $id
     * @return bool
     */
    public function update(UpdateRequest $request, int $id)
    {
        /** @var Teacher $teacher */
        $teacher = Teacher::query()->findOrFail($id);

        return $teacher->update($this->prepareData($request));
    }

    /**
     * @param int $id
     * @return bool|null
     * @throws \Exception
     */
    public function destroy(int $id)
    {
        /** @var Teacher $record */
        $record = Teacher::query()->findOrFail($id);

        return $record->delete();
    }

    /**
     * @param int $id
     * @return bool
     */
    public function updateStatus(int $id)
    {
        return $this->updateStatusData(new Teacher(), $id);
    }

    /**
     * @param StoreRequest|UpdateRequest $request
     * @return array
     */
    protected function prepareData(Request $request): array
    {
        $attributes = $request->all();
        if ($request->file('avatar')) {
            $attributes['avatar'] = $this->uploadImage($request->file('avatar'), storage_path('app/public/'.Teacher::AVATAR_DIR));
        }
        $attributes['is_public'] = $request->is_public ? 1 : 0;

        return $attributes;
    }

    /**
     * @param Request $request
     * @param int $id
     * @return array
     */
    public function addSubjects(Request $request, int $id)
    {
        /** @var Teacher $teacher */
        $teacher = Teacher::query()->findOrFail($id);
        foreach ((array) $request->subject_ids as $subjectId) {
            $teacher->subjects()->syncWithoutDetaching([
                $subjectId => [
                    'order' => (TeacherSubject::query()->where('teacher_id', $id)->max('order') ?? 0) + 1
                ]
            ]);
        }
        $subjects = (new SubjectService())->getByTeacher($id);

        return compact('subjects', 'teacher');
    }

    /**
     * @param Request $request
     * @param int $id
     * @return bool
     */
    public function reorderSubjects(Request $request, int $id)
    {
        $subjectIds = array_values((array) $request->sort);

        $orders = TeacherSubject::query()
            ->where('teacher_id', $id)
            ->whereIn('subject_id', $subjectIds)
            ->orderByDesc('order')
            ->pluck('order')
            ->toArray();

        foreach ($orders as $key => $value) {
            TeacherSubject::query()
                ->where([
                    ['teacher_id', $id],
                    ['subject_id', $subjectIds[$key]]
                ])
                ->update(['order' => $value]);
        }

        return true;
    }

    /**
     * @param int $id
     * @param int $subjectId
     * @return bool
     */
    public function destroySubject(int $id, int $subjectId)
    {
        /** @var Teacher $teacher */
        $teacher = Teacher::query()->findOrFail($id);
        $teacher->subjects()->detach([$subjectId]);

        return true;
    }

    /**
     * @param int $courseId
     * @return Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getByCourse(int $courseId)
    {
        return Teacher::query()
            ->join('course_teacher', 'teachers.id', '=', 'course_teacher.teacher_id')
            ->where('course_teacher.course_id', $courseId)
            ->selectRaw('teachers.*, course_teacher.order')
            ->orderByDesc('course_teacher.order')
            ->get();
    }
}
