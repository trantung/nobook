<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CMS\UserController;
use App\Http\Controllers\Api\CMS\CourseCMSController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('home/courses', [
    'as' => 'home.courses',
    'uses' => 'CourseController@homeList'
]);
Route::post('course/{id}/detail', [
    'as' => 'courses.detail',
    'uses' => 'CourseController@detail'
]);
Route::get('home/class/list', [
    'as' => 'home.class_list',
    'uses' => 'CourseController@classList'
]);
Route::get('home/subject/list', [
    'as' => 'home.subject_list',
    'uses' => 'CourseController@subjectList'
]);
//api for cms
Route::group(['prefix' => 'cms'], function () {
    Route::post('course/list', [CourseCMSController::class, 'list']);
    Route::post('login', [UserController::class, 'login']);
    Route::get('user-info', [UserController::class, 'userInfo']);
});


