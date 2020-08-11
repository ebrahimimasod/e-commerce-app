<?php

Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function () {
    Route::group(['prefix' => 'variant'], function () {
        Route::get('/', 'VariantController@index');
        Route::get('/value/{variant_id}', 'VariantController@getVariantValues');
        Route::post('/value/new', 'VariantController@store');
        Route::put('/value/update/{id}', 'VariantController@update');
        Route::delete('/value/delete/{id}', 'VariantController@destroy');
    });
});
