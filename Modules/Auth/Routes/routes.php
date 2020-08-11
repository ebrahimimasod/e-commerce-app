<?php

Route::group(['prefix'=>'auth'],function (){
    Route::post('/sendVerificationCode','AuthController@sendVerificationCode');
    Route::post('/login','AuthController@login');
    Route::post('/logout','AuthController@logout');
});
