<?php

namespace App\Models;

/**
 * Class CourseClass
 * @package App\Models
 */

/**
 * [auto-gen-property]
 * @property int $course_id
 * @property int $class_id
 * [/auto-gen-property]
 *
 */
class CourseClass extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string $table
     */
    protected $table = 'course_class';

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
    protected $fillable = [
        # [auto-gen-attribute]
        'course_id',
		'class_id',
        # [/auto-gen-attribute]
    ];
}