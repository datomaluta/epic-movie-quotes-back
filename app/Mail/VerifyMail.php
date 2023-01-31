<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VerifyMail extends Mailable
{
	use Queueable, SerializesModels;

	public $id;

	public $name;

	public function __construct($id, $name)
	{
		$this->id = $id;
		$this->name = $name;
	}

	public function envelope()
	{
		return new Envelope(
			subject: 'Verify Mail',
		);
	}

	public function content()
	{
		return new Content(
			view: 'email.email-verification',
			with:[
				['id'=>$this->id, 'name'=>$this->name],
			]
		);
	}
}
