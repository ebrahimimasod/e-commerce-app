<?php


Route::group(['prefix'=>'favorite'],function (){
    Route::get('/','FavoriteController@getUserFavorites');
    Route::post('/add/{product_id}','FavoriteController@addProductToFavorite');
});
