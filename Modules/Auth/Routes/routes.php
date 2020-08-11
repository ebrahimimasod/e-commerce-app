<?php

Route::group(['prefix'=>'admin','namespace'=>'Admin'],function (){
    Route::post('/login','AuthController@login');
    Route::post('/logout','AuthController@logout');
});



Route::group(['prefix'=>'auth'],function (){
    Route::post('/sendVerificationCode','AuthController@sendVerificationCode');
    Route::post('/login','AuthController@login');
    Route::post('/logout','AuthController@logout');
});
