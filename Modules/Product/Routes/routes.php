<?php
Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function () {
    Route::group(['prefix' => 'product'], function () {
        Route::get('/', 'ProductController@index');
        Route::post('/new', 'ProductController@store');
        Route::get('/edit/{id}', 'ProductController@edit');
        Route::put('/update/{id}', 'ProductController@update');
        Route::delete('/delete/{id}', 'ProductController@destroy');
        Route::delete('/force-delete/{id}', 'ProductController@forceDelete');
    });
});


Route::get('/search/{category?}', 'ProductController@productSearch');


