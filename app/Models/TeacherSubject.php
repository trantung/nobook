<?php

namespace App\Models;

/**
 * Class TeacherSubject
 * @package App\Models
 */

/**
 * [auto-gen-property]
 * @property int $teacher_id
 * @property int $subject_id
 * @property int $order
 * [/auto-gen-property]
 *
 */
class TeacherSubject extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string $table
     */
    protected $table = 'teacher_subject';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        # [auto-gen-attribute]
        'teacher_id',
		'subject_id',
		'order',
        # [/auto-gen-attribute]
    ];

    public $timestamps = false;
}
