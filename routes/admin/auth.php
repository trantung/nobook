<?php

use Illuminate\Support\Facades\Route;


Route::group(['namespace' => 'Auth'], function () {
    Route::get('login', [
        'as' => 'admin.auth.login',
        'uses' => 'LoginController@showLoginForm'
    ]);
    Route::post('login', [
        'as' => 'admin.auth.login',
        'uses' => 'LoginController@login'
    ]);

    Route::group(['middleware' => 'auth:admin'], function () {
        Route::get('logout', [
            'as' => 'admin.auth.logout',
            'uses' => 'LoginController@logout'
        ]);
    });
});
