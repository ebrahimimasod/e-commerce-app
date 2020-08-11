<?php


Route::middleware('auth:api')->get('/coupon', function (Request $request) {
    return $request->user();
});
