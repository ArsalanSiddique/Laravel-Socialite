<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('auth/google', [App\Http\Controllers\Auth\LoginController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [App\Http\Controllers\Auth\LoginController::class, 'handleGoogleCallback']);

Route::get('auth/facebook', [App\Http\Controllers\Auth\LoginController::class, 'redirectToFacebook']);
Route::get('auth/facebook/callback', [App\Http\Controllers\Auth\LoginController::class, 'handleFacebookCallback']);

Route::get('auth/github', [App\Http\Controllers\Auth\LoginController::class, 'redirectToGithub']);
Route::get('auth/github/callback', [App\Http\Controllers\Auth\LoginController::class, 'handleGithubCallback']);
