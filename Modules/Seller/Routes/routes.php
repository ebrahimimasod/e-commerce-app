<?php

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::group(['prefix' => 'seller'], function () {
        Route::get('/', 'SellerController@index');
        Route::post('/new', 'SellerController@store');
        Route::put('/update/{id}', 'SellerController@update');
        Route::delete('/delete/{id}', 'SellerController@destroy');
        Route::delete('/force-delete/{id}', 'SellerController@forceDestroy');
    });
});

Route::group(['prefix' => 'seller'], function () {
    Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {
        Route::post('/login', 'SellerAuthController@login');
        Route::post('/register', 'SellerAuthController@register');
        Route::post('/send-verification-code', 'SellerAuthController@sendVerificationCode');
        Route::post('/check-verification-code', 'SellerAuthController@checkVerificationCode');
        Route::post('/save-seller-data', 'SellerAuthController@saveSellerData');
        Route::post('/update-seller-data', 'SellerAuthController@updateSellerData');
        Route::post('/upload-seller-documents', 'SellerAuthController@uploadSellerDocuments');
    });

    Route::group(['middleware' => 'seller.auth'], function () {

        Route::group(['prefix' => 'product', 'namespace' => 'Product'], function () {
            Route::get('/', 'SellerProductController@index');
            Route::post('/new', 'SellerProductController@store');
            Route::get('/edit/{id}', 'SellerProductController@edit');
            Route::put('/update/{id}', 'SellerProductController@update');
        });

        Route::group(['prefix' => 'promotion', 'namespace' => 'Promotion'], function () {
            Route::get('/', 'SellerPromotionController@index');
            Route::post('/new', 'SellerPromotionController@store');
        });

    });

});


