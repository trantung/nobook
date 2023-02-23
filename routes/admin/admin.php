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
    });
});
