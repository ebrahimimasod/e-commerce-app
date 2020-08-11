<?php

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::group(['prefix' => 'promotion'], function () {
        Route::get('/', 'PromotionController@index');
        Route::post('/new', 'PromotionController@store');
        Route::put('/update/{id}', 'PromotionController@update');
        Route::delete('/delete/{id}', 'PromotionController@destroy');
    });
});
