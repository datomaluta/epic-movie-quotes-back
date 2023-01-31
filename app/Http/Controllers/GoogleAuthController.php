<?php

namespace App\Http\Controllers;

use App\Models\Email;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
	public function getRedirectUrl()
	{
		return Socialite::driver('google')->stateless()->redirect()->getTargetUrl();
	}

	public function callbackGoogle()
	{
		try
		{
			$googleUser = Socialite::driver('google')->stateless()->user();

			$user = User::where('google_id', $googleUser->getId())->first();

			if (!$user)
			{
				$newUser = new User([
					'name'              => $googleUser->getName(),
					'google_id'         => $googleUser->getId(),
					'has_verified_email'=> 1,
				]);

				$newUser->save();

				$email = new Email([
					'email'     => $googleUser->getEmail(),
					'is_primary'=> 1,
					'user_id'   => $newUser->id,
				]);

				$email->save();

				Auth::login($newUser);
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
