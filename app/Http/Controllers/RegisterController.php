<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use App\Mail\VerifyMail;
use App\Models\Email;
use App\Models\User;
use Illuminate\Support\Facades\Mail as FacadesMail;

class RegisterController extends Controller
{
	public function register(RegisterUserRequest $request)
	{
		$attributes = $request->validated();

		$user = new User([
			'name'    => $attributes['name'],
			'password'=> $attributes['password'],
		]);
		$user->save();

		$email = new Email([
			'email'     => $attributes['email'],
			'is_primary'=> 1,
			'user_id'   => $user->id,
		]);
		$email->save();

		FacadesMail::to($email->email)->send(new VerifyMail($user->id, $email->id, $user->name));

		return response()->json(['message'=>'User has been registered'], 200);
	}

	public function verifyMail($userId, $emailId)
	{
		$verifyUser = User::where('id', $userId)->first();
		if (!is_null($verifyUser))
		{
			$email = Email::where('id', $emailId)->first();
			if (!$email->email_verified_at)
			{
				$email->email_verified_at = now();
				$email->save();
				$verifyUser->has_verified_email = 1;
				$verifyUser->save();
				return response()->json(['message'=>'Email has been verified successfully'], 200);
			}
			else
			{
				return response()->json(['message'=>'Email is already verified'], 409);
			}
		}
		else
		{
			return response()->json(['message'=>'User does not exist'], 404);
		}
	}
}
