<?php

namespace App\Models;

use App\Observers\ClassObserver;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class Class
 * @package App\Models
 */

/**
 * [auto-gen-property]
 * @property int $id
 * @property string $name
 * @property string $code
 * @property int $order
 * @property int $level
 * @property int $is_public
 * @property string $created_at
 * @property string $updated_at
 * [/auto-gen-property]
 *
 * @method static Builder public
 *
 */
class ClassModel extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string $table
     */
    protected $table = 'classes';

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
		'level',
		'is_public',
        # [/auto-gen-attribute]
    ];

    public static function boot()
    {
        parent::boot();
        self::observe(ClassObserver::class);
    }

    const LEVELS = [
        'Cấp 1' => 1,
        'Cấp 2' => 2,
        'Cấp 3' => 3,
    ];

    public function scopePublic(Builder $query)
    {
        $query->where('is_public', 1);
    }

    /**
     * @return string
     */
    public function getDisplayLevel(): string
    {
        return array_flip(self::LEVELS)[$this->level] ?? '';
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_class', 'course_class', 'class_id');
    }
}
