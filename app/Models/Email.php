<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Email extends Model 
{
	use HasFactory;

	protected $fillable = [
		'email',
		'user_id',
		'is_primary',
		'email_verified_at',
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
