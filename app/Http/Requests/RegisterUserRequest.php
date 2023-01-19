<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class RegisterUserRequest extends FormRequest
{
	public function rules()
	{
		return [
			'name'            => ['required', 'min:3', 'max:15', Rule::unique('users', 'name')],
			'email'           => ['required', 'email', Rule::unique('emails', 'email')],
			'password'        => 'required|min:8|max:15|required_with:confirm_password|same:confirm_password',
			'confirm_password'=> 'required|min:8',
		];
	}

	public function failedValidation(Validator $validator)
	{
		throw new HttpResponseException(response()->json([
			'success'=> false,
			'message'=> 'validation error',
			'errors' => $validator->errors(),
		], 422));
	}
}
