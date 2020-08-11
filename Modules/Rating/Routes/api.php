<?php


Route::middleware('auth:api')->get('/rating', function (Request $request) {
    return $request->user();
});
