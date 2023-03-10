<?php

namespace App\Services\Api;

use App\Http\Resources\ClassResource;
use App\Http\Resources\CourseResource;
use App\Models\ClassModel;
use App\Models\Course;
use App\Models\LMS\CourseModule;
use App\Models\LMS\CourseSection;
use App\Models\LMS\Module;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourseService
{
    public function homeList()
    {
        $data = ClassModel::public()
            ->with(['courses' => function ($builder) {
                $builder->where([
                    ['is_public', 1],
                    ['is_highlight', 1]
                ])
                    ->orderByDesc('id');
            }])
            ->orderByDesc('order')
            ->get();

        return ClassResource::collection($data);
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
}
