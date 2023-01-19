<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use App\Models\Email;
use App\Models\User;

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

		return response()->json(['message'=>'User has been registered'], 200);
	}
}
