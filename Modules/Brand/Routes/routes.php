<?php

Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function () {
    Route::group(['prefix' => 'brand'], function () {
        Route::get('/', 'BrandController@index');
        Route::post('/new', 'BrandController@store');
        Route::put('/update/{id}', 'BrandController@update');
        Route::delete('/delete/{id}', 'BrandController@destroy');
    });
});
