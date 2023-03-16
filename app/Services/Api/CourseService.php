<?php

namespace App\Services\Api;

use App\Http\Resources\ClassResource;
use App\Http\Resources\SubjectResource;
use App\Http\Resources\CourseResource;
use App\Http\Resources\CourseCmsResource;
use App\Models\ClassModel;
use App\Models\Subject;
use App\Models\Course;
use App\Models\CourseClass;
use App\Models\CourseSubject;
use App\Models\LMS\CourseModule;
use App\Models\LMS\CourseSection;
use App\Models\LMS\Module;
use App\Services\Api\CMS\UserService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourseService
{
    /**
     * @var bool
     */
    protected $hasUserLoggedin = null;

    /**
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function homeList(Request $request)
    {
        //sap xep theo lop
        if (isset($request->group_by_class)) {
            return $this->listByClass();
        }

        //sap xep theo mon
        if (isset($request->group_by_subject)) {
            return $this->listBySubject();
        }

        //filter lop va mon
        $query = Course::query()
            ->where([
                ['is_public', 1],
                ['is_highlight', 1]
            ]);

        if (isset($request->class_id)) {
            $query->join('course_class', 'courses.id', '=', 'course_class.course_id')
                ->where('course_class.class_id', $request->class_id);
        }
        if (isset($request->subject_id)) {
            $query->join('course_subject', 'courses.id', '=', 'course_subject.course_id')
                ->where('course_subject.subject_id', $request->subject_id);
        }

        $data = $query
            ->with('classes')
            ->orderByDesc('id')
            ->selectRaw('courses.*')
            ->with('teachers')
            ->get();

        return CourseResource::collection($data);
    }

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    protected function listByClass()
    {
        $dataClassGroup = ClassModel::public()
            ->with(['courses' => function ($builder) {
                $builder->where([
                    ['is_public', 1],
                    ['is_highlight', 1]
                ])
                    ->orderByDesc('id');
            }])
            ->orderByDesc('order')
            ->get();

        return ClassResource::collection($dataClassGroup);
    }

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    protected function listBySubject()
    {
        $dataSubjectGroup = Subject::query()
            ->with(['courses' => function ($builder) {
                $builder->where([
                    ['is_public', 1],
                    ['is_highlight', 1]
                ])
                    ->orderByDesc('id');
            }])
            ->orderByDesc('order')
            ->get();

        return SubjectResource::collection($dataSubjectGroup);
    }

    /**
     * @param int $id
     * @return CourseResource
     */
    public function detail(int $id): CourseResource
    {
        /** @var Course $course */
        $course = Course::query()
            ->findOrFail($id)
            ->load(['classes', 'teachers']);

        $course->load(['lmsSections' => function ($query) {
            $query->where('visible', 1)
                ->where('section', '<>', 0)
                ->orderBy('section');
        }]);
        $this->loadDetailSectionModule($course);
        $course->login = $this->hasUserLoggedin();

        return new CourseResource($course);
    }

    /**
     * @param Course $course
     */
    protected function loadDetailSectionModule(Course &$course)
    {
        $courseModules = CourseModule::query()
            ->where(CourseModule::field('course'), $course->lms_id)
            ->where(CourseModule::field('visible'), 1)
            ->whereIn(CourseModule::field('section'), $course->lmsSections->pluck('id')->toArray())
            ->join(Module::getMoodleTableName(), function (JoinClause $clause) use ($course) {
                $clause->on(Module::field('id'), '=', CourseModule::field('module'));
            })
            ->where(Module::field('visible'), 1)
            ->whereNotIn(Module::field('name'), Module::hidden())
            ->select([
                CourseModule::field('id'),
                CourseModule::field('module'),
                CourseModule::field('instance'),
                CourseModule::field('section'),
                Module::field('name'),
            ])
            ->get();

        $moduleNames = $courseModules->pluck('name')->unique()->toArray();
        foreach ($moduleNames as $moduleName) {
            $ids = $courseModules->where('name', $moduleName)->pluck('instance')->toArray();
            $moduleData = DB::connection('moodle')
                ->table(moodle_table_name($moduleName))
                ->whereIn('id', $ids)
                ->get();
            foreach ($moduleData as $moduleDetail) {
                $courseModule = $courseModules
                    ->where('name', $moduleName)
                    ->where('instance', $moduleDetail->id)
                    ->first();
                if (!is_null($courseModule)) {
                    $courseModule->detail = $moduleDetail;
                }
            }
        }

        $course->lmsSections->each(function (CourseSection $courseSection) use ($courseModules) {
            $courseSection->data = collect();
            if ($courseSection->sequence) {
                $ids = explode(',', $courseSection->sequence);
                foreach ($ids as $id) {
                    $courseModule = $courseModules->firstWhere('id', $id);
                    if (!is_null($courseModule)) {
                        $courseSection->data->push($courseModule);
                    }
                }
            }

            return $courseSection;
        });
    }

    public function loadDetailSectionModuleCms(Course &$course)
    {
        $courseModules = CourseModule::query()
            ->where(CourseModule::field('course'), $course->lms_id)
            ->where(CourseModule::field('visible'), 1)
            ->whereIn(CourseModule::field('section'), $course->lmsSections->pluck('id')->toArray())
            ->join(Module::getMoodleTableName(), function (JoinClause $clause) use ($course) {
                $clause->on(Module::field('id'), '=', CourseModule::field('module'));
            })
            ->where(Module::field('visible'), 1)
            ->whereNotIn(Module::field('name'), Module::hidden())
            ->select([
                CourseModule::field('id'),
                CourseModule::field('module'),
                CourseModule::field('instance'),
                CourseModule::field('section'),
                Module::field('name'),
            ])
            ->get();
            $moduleNames = $courseModules->pluck('name')->unique()->toArray();
        foreach ($moduleNames as $moduleName) {
            $ids = $courseModules->where('name', $moduleName)->pluck('instance')->toArray();
            $moduleData = DB::connection('moodle')
                ->table(moodle_table_name($moduleName))
                ->whereIn('id', $ids)
                ->get();
            foreach ($moduleData as $moduleDetail) {
                $courseModule = $courseModules
                    ->where('name', $moduleName)
                    ->where('instance', $moduleDetail->id)
                    ->first();
                if (!is_null($courseModule)) {
                    $courseModule->detail = $moduleDetail;
                }
            }
        }
        // dd($course->toArray());
        $course->lmsSections->each(function (CourseSection $courseSection) use ($courseModules) {
            $courseSection->data = collect();
            if ($courseSection->sequence) {
                $ids = explode(',', $courseSection->sequence);
                foreach ($ids as $id) {
                    $courseModule = $courseModules->firstWhere('id', $id);
                    if (!is_null($courseModule)) {
                        $courseSection->data->push($courseModule);
                    }
                }
            }
            unset($courseSection->data);
            return $courseSection;
        });
    }

    public function list()
    {
        $data = Course::where('is_public', 1)
            ->orderByDesc('id')
            ->get();
        foreach ($data as $course) {
            $courseCms = $this->loadDetailSectionModuleCms($course);
        }
        return CourseCmsResource::collection($data);
    }

    /**
     * @return bool
     */
    protected function hasUserLoggedin(): bool
    {
        if (!is_bool($this->hasUserLoggedin)) {
            if (request()->bearerToken()) {
                try {
                    $userData = (new UserService())->getUserInfo(request());
                    if ($userData) {
                        $this->hasUserLoggedin = true;
                    }
                } catch (\Exception $e) {

                }
            }
            $this->hasUserLoggedin = false;
        }

        return $this->hasUserLoggedin;
    }
}
