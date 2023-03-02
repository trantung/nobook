<?php

namespace App\Models;

use App\Observers\CourseObserver;

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
class Course extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string $table
     */
    protected $table = 'courses';

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
        'lms_id',
		'name',
		'slug',
		'type',
		'desktop_avatar',
		'mobile_avatar',
		'intro_link',
		'method',
		'is_public',
		'is_highlight',
		'description',
		'detail',
		'result_content',
		'object_content',
		'include_content',
        # [/auto-gen-attribute]
    ];

    public static function boot()
    {
        parent::boot();
        self::observe(CourseObserver::class);
    }

    const AVATAR_DIR = 'media/images/courses';

    const TYPES = [
        'Khóa học lẻ' => 1,
        'Combo' => 2,
    ];

    const METHODS = [
        'Khóa video' => 1,
        'Khóa livestream' => 2,
    ];

    /**
     * @var array
     */
    protected $includeContent;

    public function getDesktopAvatar(): string
    {
        return $this->desktop_avatar
            ? implode('/', [url('storage'), self::AVATAR_DIR, $this->desktop_avatar])
            : '';
    }

    public function getMobileAvatar(): string
    {
        return $this->mobile_avatar
            ? implode('/', [url('storage'), self::AVATAR_DIR, $this->mobile_avatar])
            : '';
    }

    /**
     * @return array
     */
    public function getIncludeContent(): array
    {
        if (!$this->include_content) {
            return [];
        }

        if (empty($this->includeContent)) {
            $this->includeContent = json_decode($this->include_content, true);
        }

        return $this->includeContent;
    }

    public function classes()
    {
        return $this->belongsToMany(ClassModel::class, 'course_class', 'course_id', 'class_id');
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'course_subject');
    }

    public function courseSubjects()
    {
        return $this->hasMany(CourseSubject::class);
    }

    public function courseClasses()
    {
        return $this->hasMany(CourseClass::class);
    }

    /**
     * @param array $classIds
     * @return array
     */
    public function syncClasses(array $classIds)
    {
        return $this->classes()->sync($classIds);
    }

    /**
     * @param array $subjectIds
     * @return array
     */
    public function syncSubjects(array $subjectIds)
    {
        return $this->subjects()->sync($subjectIds);
    }

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'course_teacher');
    }

    public function courseTeachers()
    {
        return $this->hasMany(CourseTeacher::class);
    }
}
