<?php

namespace App\Models\LMS;

use App\Models\BaseModel;

class CourseModule extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string $table
     */
    protected $table = 'course_modules';
    protected static $moodleTableName = 'course_modules';

    protected $connection = 'moodle';

    /**
     * The primary key for the model.
     *
     * @var string $primaryKey
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * @return mixed|string
     */
    public function getName()
    {
        if (!$this->name) {
            return "Chủ đề $this->section";
        }

        return $this->name;
    }
}
