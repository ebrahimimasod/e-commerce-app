<?php

Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function () {
    Route::group(['prefix' => 'property'], function () {
        Route::get('/', 'PropertyController@index');
        Route::post('/new', 'PropertyController@store');
        Route::put('/update/{id}', 'PropertyController@update');
        Route::delete('/delete/{id}', 'PropertyController@destroy');
    });
});
