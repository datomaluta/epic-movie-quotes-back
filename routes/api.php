<?php

use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('localization')->group(
	function () {
		Route::post('/register', [RegisterController::class, 'register']);
		Route::post('/login', [LoginController::class, 'login']);
		Route::get('account/verify/{user_id}/{email_id}', [RegisterController::class, 'verifyMail'])->name('user.verify');
		Route::post('/forget-password', [PasswordController::class, 'sendPasswordResetEmail']);
		Route::post('/reset-password/{token}', [PasswordController::class, 'setNewPassword']);
	}
);

Route::middleware('auth:sanctum')->group(
	function () {
		Route::get('/userdata', [UserController::class, 'getUserData']);
		Route::get('/logout', [LoginController::class, 'logout']);
		Route::post('/user-data/update', [UserController::class, 'updateUserData']);
		Route::post('/add-email', [UserController::class, 'addNewEmail']);
		Route::get('/make-primary/{id}', [UserController::class, 'makeEmailPrimary']);
		Route::get('/delete-email/{id}', [UserController::class, 'deleteEmail']);
	}
);

Route::get('auth/google', [GoogleAuthController::class, 'getRedirectUrl']);
Route::get('auth/google/call-back', [GoogleAuthController::class, 'callbackGoogle']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
	return $request->user();
});
