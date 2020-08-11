<?php

Route::group(['prefix'=>'admin','namespace'=>'Admin'],function(){
    Route::group(['prefix'=>'comment'],function(){
        Route::get('/','CommentController@index');
        Route::put('/update/{id}','CommentController@update');
        Route::delete('/delete/{id}','CommentController@destroy');
    });

});


Route::group(['prefix'=>'comment'],function(){
    Route::get('/{product}','CommentController@index');
    Route::post('/create/{product}','CommentController@store')->middleware('auth:api');
});