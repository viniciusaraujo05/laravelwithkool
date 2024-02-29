<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'auth'], function () {
    Route::post('/login', [App\Http\Controllers\Api\AuthController::class, 'loginUser']);
    Route::post('/id', [App\Http\Controllers\Api\AuthController::class, 'CheckId']);
    Route::middleware(['auth:sanctum'])->group(function () {
        Route::post('/register', [App\Http\Controllers\Api\AuthController::class, 'store']);
    });
});

Route::group(['prefix' => 'customer'], function () {
    Route::post('/create', [App\Http\Controllers\Api\CustomerController::class, 'store']);
});