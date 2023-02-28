<?php

namespace App\Models;

use App\Observers\TeacherObserver;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class Teacher
 * @package App\Models
 */

/**
 * [auto-gen-property]
 * @property int $id
 * @property string $name
 * @property string $label
 * @property string $avatar
 * @property int $is_public
 * @property string $description
 * @property string $created_at
 * @property string $updated_at
 * [/auto-gen-property]
 *
 */
class Teacher extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string $table
     */
    protected $table = 'teachers';

    /**
     * The primary key for the model.
     *
     * @var string $primaryKey
     */
    protected $primaryKey = 'id';

    const AVATAR_DIR = 'media/images/users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        # [auto-gen-attribute]
        'name',
		'label',
		'avatar',
		'is_public',
		'description',
        # [/auto-gen-attribute]
    ];

    public static function boot()
    {
        parent::boot();
        self::observe(TeacherObserver::class);
    }

    public function scopePublic(Builder $query)
    {
        $query->where('is_public', 1);
    }

    public function getAvatar()
    {
        return $this->avatar
            ? implode('/', [url('storage'), self::AVATAR_DIR, $this->avatar])
            : '';
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'teacher_subject');
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_teacher');
    }
}
