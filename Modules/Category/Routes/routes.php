<?php
Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function () {
    Route::group(['prefix' => 'category'], function () {
        Route::get('/', 'CategoryController@index');
        Route::post('/new', 'CategoryController@store');
        Route::put('/update/{id}', 'CategoryController@update');
        Route::delete('/delete/{id}', 'CategoryController@destroy');
    });
});


Route::get('/getCategories', 'CategoryController@getCategories');

