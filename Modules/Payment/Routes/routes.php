<?php


Route::group(['prefix'=>'admin','namespace'=>'Admin'],function(){
    Route::group(['prefix'=>'payment'],function(){
        Route::get('/','PaymentController@index');
        Route::post('/update/{id}','PaymentController@update');
        Route::delete('/delete/{id}','PaymentController@destroy');
    });
});