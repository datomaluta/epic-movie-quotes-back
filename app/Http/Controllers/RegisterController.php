<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use App\Models\User;

class RegisterController extends Controller
{
	public function register(RegisterUserRequest $request)
	{
		$attributes = $request->validated();

		{
			$user = new User([
				'name'    => $attributes['name'],
				'email'   => $attributes['email'],
				'password'=> $attributes['password'],
			]);
		}

		$user->save();
		return response()->json(['message'=>'User has been registered'], 200);
	}
}
