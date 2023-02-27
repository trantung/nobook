<?php

namespace App\Observers;

use App\Libs\Traits\HandleUpload;
use App\Models\Course;

class CourseObserver
{
    use HandleUpload;
    /**
     * Handle the course "created" event.
     *
     * @param  \App\Models\Course  $course
     * @return void
     */
    public function created(Course $course)
    {
        //
    }

    /**
     * Handle the course "updated" event.
     *
     * @param  \App\Models\Course  $course
     * @return void
     */
    public function updated(Course $course)
    {
        //
    }

    /**
     * Handle the course "deleted" event.
     *
     * @param  \App\Models\Course  $course
     * @return void
     */
    public function deleted(Course $course)
    {
        //
    }

    /**
     * Handle the course "deleting" event.
     *
     * @param  \App\Models\Course  $course
     * @return void
     */
    public function deleting(Course $course)
    {
        $course->classes()->detach();
        $course->subjects()->detach();
        foreach (['desktop_avatar', 'mobile_avatar'] as $key) {
            if ($course->{$key}) {
                $this->removeImage(storage_path('app/public/'.Course::AVATAR_DIR).'/'.$course->{$key});
            }
        }
    }

    /**
     * Handle the course "restored" event.
     *
     * @param  \App\Models\Course  $course
     * @return void
     */
    public function restored(Course $course)
    {
        //
    }

    /**
     * Handle the course "force deleted" event.
     *
     * @param  \App\Models\Course  $course
     * @return void
     */
    public function forceDeleted(Course $course)
    {
        //
    }
}
