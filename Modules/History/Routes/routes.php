<?php


Route::group(['prefix'=>'history'],function (){
    Route::get('/','HistoryeController@getUserHistories');
    Route::post('/add/{product_id}','HistoryeController@addProductToHistorye');
});
