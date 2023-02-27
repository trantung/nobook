<?php

namespace App\Observers;

use App\Models\ClassModel;

class ClassObserver
{
    /**
     * Handle the class model "created" event.
     *
     * @param  \App\Models\ClassModel  $classModel
     * @return void
     */
    public function created(ClassModel $classModel)
    {
        //
    }

    /**
     * Handle the class model "updated" event.
     *
     * @param  \App\Models\ClassModel  $classModel
     * @return void
     */
    public function updated(ClassModel $classModel)
    {
        //
    }

    /**
     * Handle the class model "deleted" event.
     *
     * @param  \App\Models\ClassModel  $classModel
     * @return void
     */
    public function deleted(ClassModel $classModel)
    {
        //
    }

    /**
     * Handle the class model "deleting" event.
     *
     * @param  \App\Models\ClassModel  $class
     * @return void
     */
    public function deleting(ClassModel $class)
    {
        $class->courses()->detach();
    }

    /**
     * Handle the class model "restored" event.
     *
     * @param  \App\Models\ClassModel  $classModel
     * @return void
     */
    public function restored(ClassModel $classModel)
    {
        //
    }

    /**
     * Handle the class model "force deleted" event.
     *
     * @param  \App\Models\ClassModel  $classModel
     * @return void
     */
    public function forceDeleted(ClassModel $classModel)
    {
        //
    }
}
