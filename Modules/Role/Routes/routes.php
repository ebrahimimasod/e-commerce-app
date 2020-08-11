<?php

Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function () {
    Route::group(['prefix' => 'role'], function () {
        Route::get('/', 'RoleController@index');
        Route::get('/permissions', 'RoleController@getPermissions');
        Route::post('/new', 'RoleController@store');
        Route::put('/update/{id}', 'RoleController@update');
        Route::delete('/delete/{id}', 'RoleController@destroy');
    });
});
