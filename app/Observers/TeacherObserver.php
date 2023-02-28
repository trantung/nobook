<?php

namespace App\Observers;

use App\Libs\Traits\HandleUpload;
use App\Models\Teacher;

class TeacherObserver
{
    use HandleUpload;
    /**
     * Handle the teacher "created" event.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return void
     */
    public function created(Teacher $teacher)
    {
        //
    }

    /**
     * Handle the teacher "updated" event.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return void
     */
    public function updated(Teacher $teacher)
    {
        //
    }

    /**
     * Handle the teacher "deleted" event.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return void
     */
    public function deleted(Teacher $teacher)
    {
        //
    }

    /**
     * Handle the teacher "deleting" event.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return void
     */
    public function deleting(Teacher $teacher)
    {
        $this->removeImage(storage_path('app/public/'.Teacher::AVATAR_DIR).'/'.$teacher->avatar);
        $teacher->subjects()->detach();
    }

    /**
     * Handle the teacher "restored" event.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return void
     */
    public function restored(Teacher $teacher)
    {
        //
    }

    /**
     * Handle the teacher "force deleted" event.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return void
     */
    public function forceDeleted(Teacher $teacher)
    {
        //
    }
}
