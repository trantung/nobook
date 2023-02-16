<?php

use Illuminate\Support\Facades\Route;


Route::group(['namespace' => 'Auth'], function () {
    Route::get('login', [
        'as' => 'admin.auth.login',
        'uses' => 'LoginController@index'
    ]);
    Route::post('login', [
        'as' => 'admin.auth.login',
        'uses' => 'LoginController@login'
    ]);
});
