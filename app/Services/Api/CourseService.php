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
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourseService
{
    public function homeList($filter = array())
    {
        $listCourseIds = $listCourseClassIds = $listCourseSubjectIds = [];
        //sap xep theo lop
        if (!empty($filter['group_by_class'])) {
            $dataClassGroup = ClassModel::public()
                ->with(['courses' => function ($builder){
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
        //sap xep theo mon
        if (!empty($filter['group_by_subject'])) {
            $dataSubjectGroup = Subject::with(['courses' => function ($builder){
                    $builder->where([
                        ['is_public', 1]
                    ])
                    ->orderByDesc('id');
            }])
            ->orderByDesc('order')
            ->get();
            return SubjectResource::collection($dataSubjectGroup);
        }

        //filter lop va mon
        if (!empty($filter['class_id'])) {
            $classId = $filter['class_id'];
            $listCourseClassIds = CourseClass::where('class_id', $classId)
                ->pluck('course_id')->toArray();
        }
        if (!empty($filter['subject_id'])) {
            $subjectId = $filter['subject_id'];
            $listCourseSubjectIds = CourseSubject::where('subject_id', $subjectId)
                ->pluck('course_id')->toArray();
        }
        $listCourseIds = array_intersect($listCourseClassIds, $listCourseSubjectIds);
        $data = Course::where('is_public', 1)->where('is_highlight', 1);
        if (!empty($listCourseIds)) {
            $data = $data->whereIn('id', $listCourseIds);
        }
        $data = $data->orderByDesc('id')->get();
        return CourseResource::collection($data);

    }

    /**
     * @param int $id
     * @return CourseResource
     */
    public function detail(int $id)
    {
        /** @var Course $course */
        $course = Course::query()->findOrFail($id)->load('classes');
        $course->load(['lmsSections' => function ($query) {
            $query->where('visible', 1)
                ->where('section', '<>', 0)
                ->orderBy('section');
        }]);
        $this->loadDetailSectionModule($course);

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
}
