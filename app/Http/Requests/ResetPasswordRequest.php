<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
{
	public function rules()
	{
		return [
			'password'        => 'required|min:8|max:15|required_with:confirm_password|same:confirm_password',
			'confirm_password'=> 'required|min:8',
		];
	}
}
