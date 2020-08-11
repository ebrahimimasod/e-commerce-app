<?php
//
Route::group(['prefix'=>'admin','namespace'=>'Admin'],function(){
    Route::group(['prefix'=>'question'],function(){
        Route::get('/','QuestionController@index');
        Route::put('/update/{id}','QuestionController@update');
        Route::delete('/delete/{id}','QuestionController@destroy');
    }); 
});

Route::group(['prefix'=>'question'],function(){
        Route::get('/{product}','QuestionController@index');
        Route::post('/create/{product}','QuestionController@store')->middleware('auth:api');
});