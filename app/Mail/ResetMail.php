<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ResetMail extends Mailable
{
	use Queueable, SerializesModels;

	public $token;

	public function __construct($token)
	{
		$this->token = $token;
	}

	public function envelope()
	{
		return new Envelope(
			subject: 'Password Reset',
		);
	}

	public function content()
	{
		return new Content(
			view: 'email.password-reset',
			with:[
				['token'=>$this->token],
			]
		);
	}
}
