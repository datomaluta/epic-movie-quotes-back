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

	public $userId;

	public $emailId;

	public $name;

	public function __construct($userId, $emailId, $name)
	{
		$this->userId = $userId;
		$this->emailId = $emailId;
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
				['userId'=>$this->userId, 'emailId'=>$this->emailId, 'name'=>$this->name],
			]
		);
	}
}
