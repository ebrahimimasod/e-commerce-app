<?php

Route::group(['prefix'=>"admin",'namespace'=>'Admin'],function(){
    Route::group(['prefix'=>'order'],function(){
        Route::get('/','OrderController@index');
        Route::put('/update/{id}','OrderController@update');
        Route::delete('/delete/{id}','OrderController@delete');
    });
});