<?php

Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function () {
    Route::group(['prefix' => 'province'], function () {
        Route::get('/', 'ProvinceController@index');
        Route::post('/new', 'ProvinceController@store');
        Route::put('/update/{id}', 'ProvinceController@update');
        Route::delete('/forceDelete/{id}', 'ProvinceController@forceDelete');
        Route::delete('/delete/{id}', 'ProvinceController@destroy');
        Route::get('/{id}/city', 'CityController@index');
        Route::post('/{id}/city/new', 'CityController@store');
        Route::put('/city/update/{id}', 'CityController@update');
        Route::delete('/city/delete/{id}', 'CityController@destroy');
    });
});
