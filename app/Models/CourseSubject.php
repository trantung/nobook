<?php

namespace App\Models;

/**
 * Class CourseSubject
 * @package App\Models
 */

/**
 * [auto-gen-property]
 * @property int $course_id
 * @property int $subject_id
 * [/auto-gen-property]
 *
 */
class CourseSubject extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string $table
     */
    protected $table = 'course_subject';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        # [auto-gen-attribute]
        'course_id',
		'subject_id',
        # [/auto-gen-attribute]
    ];
}
