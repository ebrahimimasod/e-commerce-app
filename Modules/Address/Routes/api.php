<?php


Route::middleware('auth:api')->get('/address', function (Request $request) {
    return $request->user();
});
