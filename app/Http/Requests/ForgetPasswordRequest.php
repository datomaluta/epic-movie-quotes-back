<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ForgetPasswordRequest extends FormRequest
{
	public function rules()
	{
		return [
			'email' => 'required|email|exists:emails',
		];
	}
}
