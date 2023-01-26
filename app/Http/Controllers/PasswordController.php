<?php

namespace App\Http\Controllers;

use App\Http\Requests\ForgetPasswordRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Mail\ResetMail;
use App\Models\Email;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail as FacadesMail;

class PasswordController extends Controller
{
	public function sendPasswordResetEmail(ForgetPasswordRequest $request)
	{
		$attributes = $request->validated();

		$token = Str::random(64);

		DB::table('password_resets')->insert([
			'email'      => $attributes['email'],
			'token'      => $token,
			'created_at' => Carbon::now(),
		]);

		FacadesMail::to($attributes['email'])->send(new ResetMail($token));

		return response()->json(['message'=>'Password Reset email sent successfully!']);
	}

	public function setNewPassword(ResetPasswordRequest $request, $token)
	{
		$request->validated();

		$resetData = DB::table('password_resets')
		->where([
			'token' => $token,
		])
		->first();

		$email = $resetData->email;

		$user = Email::where('email', $email)->first()->user;

		$user->update(['password' =>bcrypt($request->password)]);

		DB::table('password_resets')->where(['email'=> $email])->delete();

		return response()->json(['message'=>'Password Changed Successfully!']);
	}
}
