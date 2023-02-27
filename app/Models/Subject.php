<?php

namespace App\Models;

use App\Observers\SubjectObserver;

/**
 * Class Subject
 * @package App\Models
 */

/**
 * [auto-gen-property]
 * @property int $id
 * @property string $name
 * @property string $code
 * @property int $order
 * @property int $is_public
 * @property string $created_at
 * @property string $updated_at
 * [/auto-gen-property]
 *
 */
class Subject extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string $table
     */
    protected $table = 'subjects';

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
        'name',
		'code',
		'order',
		'is_public',
        # [/auto-gen-attribute]
    ];

    public static function boot()
    {
        parent::boot();
        self::observe(SubjectObserver::class);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_subject');
    }
}
