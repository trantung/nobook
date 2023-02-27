<?php

namespace App\Models;

/**
 * Class Course
 * @package App\Models
 */

/**
 * [auto-gen-property]
 * @property int $id
 * @property int $lms_id
 * @property string $name
 * @property string $slug
 * @property int $type
 * @property string $desktop_avatar
 * @property string $mobile_avatar
 * @property string $intro_link
 * @property int $method
 * @property int $is_public
 * @property int $is_highlight
 * @property string $description
 * @property string $detail
 * @property string $result_content
 * @property string $object_content
 * @property string $include_content
 * @property string $created_at
 * @property string $updated_at
 * [/auto-gen-property]
 *
 */
class CourseLMS extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string $table
     */
    protected $table = 'course';

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
}
