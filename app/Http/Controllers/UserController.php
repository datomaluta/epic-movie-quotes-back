<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewEmailRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Mail\VerifyMail;
use App\Models\Email;
use Illuminate\Support\Facades\Mail as FacadesMail;

class UserController extends Controller
{
	public function getUserData()
	{
		$user = auth()->user();
		$user->emails;

		return response()->json(['user'=>$user]);
	}

	public function updateUserData(UserUpdateRequest $request)
	{
		$validatedData = $request->validated();
		$user = auth()->user();
		$user->update($validatedData);
		if ($request->hasFile('image'))
		{
			$image = $request->file('image')->store('avatars', 'public');
			$user->profile_image = $image;
		}

		$user->save();
		return response()->json(['message'=>'data updated successfully']);
	}

	public function addNewEmail(NewEmailRequest $request)
	{
		$attributes = $request->validated();
		$user = auth()->user();
		$email = new Email([
			'email'     => $attributes['email'],
			'is_primary'=> 0,
			'user_id'   => $user->id,
		]);
		$email->save();

		FacadesMail::to($email->email)->send(new VerifyMail($user->id, $email->id, $user->name));

		return response()->json(['message'=>'email added successfully']);
	}

	public function makeEmailPrimary($id)
	{
		$user = auth()->user();
		$emails = $user->emails;
		foreach ($emails as $email)
		{
			if ($email->is_primary = 1)
			{
				$email->is_primary = 0;
				$email->save();
			}
		}
		$newPrimaryEmail = Email::where('id', $id)->first();
		$newPrimaryEmail->is_primary = 1;
		$newPrimaryEmail->save();
		return response()->json(['message'=>'primary email changed successfully'], 200);
	}

	public function deleteEmail($id)
	{
		$email = Email::where('id', $id)->first();
		$email->delete();

		return response()->json(['message'=>'Email deleted successfully'], 200);
	}
}
