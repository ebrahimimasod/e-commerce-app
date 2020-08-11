<?php

Route::group(['prefix'=>'media'],function (){
    Route::post('upload-image','MediaController@uploadImage');
    Route::delete('delete/{id}','MediaController@destroy');
});
