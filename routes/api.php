<?php

use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [RegisterController::class, 'register']);

Route::get('account/verify/{id}', [RegisterController::class, 'verifyMail'])->name('user.verify');

Route::post('/login', [LoginController::class, 'login']);

Route::get('/logout', [LoginController::class, 'logout']);

Route::post('/forget-password', [PasswordController::class, 'sendPasswordResetEmail']);

Route::post('/reset-password/{token}', [PasswordController::class, 'setNewPassword']);

Route::get('auth/google', [GoogleAuthController::class, 'redirect']);
Route::get('auth/google/call-back', [GoogleAuthController::class, 'callbackGoogle']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
	return $request->user();
});
