<?php

namespace App\Http\Controllers;

use App\Models\Email;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
	public function redirect()
	{
		// info(Socialite::driver('google')->stateless()->redirect()->getTargetUrl());
		return Socialite::driver('google')->stateless()->redirect()->getTargetUrl();
	}

	public function callbackGoogle()
	{
		try
		{
			$google_user = Socialite::driver('google')->stateless()->user();

			$user = User::where('google_id', $google_user->getId())->first();

			if (!$user)
			{
				$new_user = new User([
					'name'              => $google_user->getName(),
					'google_id'         => $google_user->getId(),
					'has_verified_email'=> 1,
				]);

				$new_user->save();

				$email = new Email([
					'email'     => $google_user->getEmail(),
					'is_primary'=> 1,
					'user_id'   => $new_user->id,
				]);

				$email->save();

				Auth::login($new_user);
				request()->session()->regenerate();
				return redirect(env('APP_FRONTEND_URL') . '/news-feed')->withCookie(cookie('isLoggedIn', '1'));
			}
			else
			{
				Auth::login($user);
				request()->session()->regenerate();
				return redirect(env('APP_FRONTEND_URL') . '/news-feed')->withCookie(cookie('isLoggedIn', '1'));
			}
		}
		catch(\Throwable $th)
		{
			return $th;
		}
	}
}
