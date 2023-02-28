<?php

namespace App\Models;

/**
 * Class CourseTeacher
 * @package App\Models
 */

/**
 * [auto-gen-property]
 * @property int $course_id
 * @property int $teacher_id
 * @property int $order
 * [/auto-gen-property]
 *
 */
class CourseTeacher extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string $table
     */
    protected $table = 'course_teacher';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        # [auto-gen-attribute]
        'course_id',
		'teacher_id',
		'order',
        # [/auto-gen-attribute]
    ];

    public $timestamps = false;
}
