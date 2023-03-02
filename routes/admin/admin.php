<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
require 'auth.php';

Route::redirect('', 'admin/dashboard');
Route::group(['middleware' => 'auth:admin'], function () {
    Route::get('dashboard', [
        'as' => 'dashboard',
        'uses' => 'DashboardController@index'
    ]);

    // class routes
    Route::resource('classes', 'ClassController');
    Route::group(['prefix' => 'classes', 'as' => 'classes.'], function () {
        Route::post('action/reorder', [
            'as' => 'reorder',
            'uses' => 'ClassController@reorder'
        ]);
        Route::post('{class}/change-status', [
            'as' => 'change_status',
            'uses' => 'ClassController@updateStatus'
        ]);
    });

    // teacher routes
    Route::resource('teachers', 'TeacherController');
    Route::group(['prefix' => 'teachers', 'as' => 'teachers.'], function () {
        Route::post('{id}/change-status', [
            'as' => 'change_status',
            'uses' => 'TeacherController@updateStatus'
        ]);
        Route::post('{id}/add-subjects', [
            'as' => 'add_subjects',
            'uses' => 'TeacherController@addSubjects'
        ]);
        Route::post('{id}/reorder-subjects', [
            'as' => 'reorder_subjects',
            'uses' => 'TeacherController@reorderSubjects'
        ]);
        Route::delete('{id}/destroy-subject/{subject}', [
            'as' => 'destroy_subject',
            'uses' => 'TeacherController@destroySubject'
        ]);
    });

    // subject routes
    Route::resource('subjects', 'SubjectController');
    Route::group(['prefix' => 'subjects', 'as' => 'subjects.'], function () {
        Route::post('action/reorder', [
            'as' => 'reorder',
            'uses' => 'SubjectController@reorder'
        ]);
        Route::post('{subject}/change-status', [
            'as' => 'change_status',
            'uses' => 'SubjectController@updateStatus'
        ]);
    });

    // course routes
    Route::resource('courses', 'CourseController');
    Route::group(['prefix' => 'courses', 'as' => 'courses.'], function () {
        Route::get('lms/list', [
            'as' => 'lms_list',
            'uses' => 'CourseController@lmsList'
        ]);
        Route::post('{course}/change-status', [
            'as' => 'change_status',
            'uses' => 'CourseController@updateStatus'
        ]);
        Route::post('{id}/add-teachers', [
            'as' => 'add_teachers',
            'uses' => 'CourseController@addTeachers'
        ]);
        Route::post('{id}/reorder-teachers', [
            'as' => 'reorder_teachers',
            'uses' => 'CourseController@reorderTeachers'
        ]);
        Route::delete('{id}/destroy-teacher/{teacher}', [
            'as' => 'destroy_teacher',
            'uses' => 'CourseController@destroyTeacher'
        ]);
        Route::get('teachers/paginate', [
            'as' => 'teachers_list',
            'uses' => 'CourseController@getTeachersPaginate'
        ]);
    });
});
