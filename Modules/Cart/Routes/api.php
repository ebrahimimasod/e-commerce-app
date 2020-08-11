<?php


Route::middleware('auth:api')->get('/cart', function (Request $request) {
    return $request->user();
});
