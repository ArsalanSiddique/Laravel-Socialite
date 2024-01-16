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

Route::middleware('auth:sanctum')->group(function () {
    Route::get('auth/google', [App\Http\Controllers\Auth\LoginController::class, 'redirectToGoogle']);
    Route::get('auth/google/callback', [App\Http\Controllers\Auth\LoginController::class, 'handleGoogleCallback']);

    Route::get('auth/facebook', [App\Http\Controllers\Auth\LoginController::class, 'redirectToFacebook']);
    Route::get('auth/facebook/callback', [App\Http\Controllers\Auth\LoginController::class, 'handleFacebookCallback']);
});
