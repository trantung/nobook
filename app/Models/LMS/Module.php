<?php

namespace App\Models\LMS;

use App\Models\BaseModel;

/**
 * Class Module
 * @package App\Models
 */

/**
 * [/auto-gen-property]
 *
 */
class Module extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string $table
     */
    protected $table = 'modules';
    protected static $moodleTableName = 'modules';

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
     * @return string[]
     */
    public static function hidden(): array
    {
        return [
            'forum' => 'forum',
        ];
    }
}
