<?php

Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function () {
    Route::group(['prefix' => 'user'], function () {
        Route::get('/', 'UserController@index');
        Route::post('/new', 'UserController@store');
        Route::put('/update/{id}', 'UserController@update');
        Route::delete('/forceDelete/{id}', 'UserController@forceDelete');
        Route::delete('/delete/{id}', 'UserController@destroy');
    });

    Route::group(['prefix' => 'manager'], function () {
        Route::get('/', 'ManagerController@index');
        Route::post('/new', 'ManagerController@store');
        Route::put('/update/{id}', 'ManagerController@update');
        Route::delete('/forceDelete/{id}', 'ManagerController@forceDelete');
        Route::delete('/delete/{id}', 'ManagerController@destroy');
    });
});
