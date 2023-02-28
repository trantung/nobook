<?php

namespace App\Observers;

use App\Models\Subject;

class SubjectObserver
{
    /**
     * Handle the subject model "created" event.
     *
     * @param  \App\Models\Subject  $subject
     * @return void
     */
    public function created(Subject $subject)
    {
        //
    }

    /**
     * Handle the subject model "updated" event.
     *
     * @param  \App\Models\Subject  $subject
     * @return void
     */
    public function updated(Subject $subject)
    {
        //
    }

    /**
     * Handle the subject model "deleted" event.
     *
     * @param  \App\Models\Subject  $subject
     * @return void
     */
    public function deleted(Subject $subject)
    {
        //
    }

    /**
     * Handle the subject model "deleting" event.
     *
     * @param  \App\Models\Subject  $subject
     * @return void
     */
    public function deleting(Subject $subject)
    {
        $subject->courses()->detach();
        $subject->teachers()->detach();
    }

    /**
     * Handle the subject model "restored" event.
     *
     * @param  \App\Models\Subject  $subject
     * @return void
     */
    public function restored(Subject $subject)
    {
        //
    }

    /**
     * Handle the subject model "force deleted" event.
     *
     * @param  \App\Models\Subject  $subject
     * @return void
     */
    public function forceDeleted(Subject $subject)
    {
        //
    }
}
