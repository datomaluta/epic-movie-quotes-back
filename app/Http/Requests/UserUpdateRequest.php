<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
	public function rules()
	{
		return [
			'name'            => ['min:3', 'max:15', Rule::unique('users', 'name')],
			'password'        => 'min:8|max:15',
			'image',
		];
	}
}
