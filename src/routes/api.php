<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestController;

/*Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');*/
Route::apiResource('/v1/rest', RestController::class);
Route::get('/hello', function() {
    return response()->json(['message' => 'Hello'], 200);
});
