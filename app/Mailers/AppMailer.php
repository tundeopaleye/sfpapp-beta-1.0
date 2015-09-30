<?php

namespace App\Mailers;

use Illuminate\Contracts\Mail\Mailer;

use App\User;

class AppMailer {
		
	protected $mailer;	
	
	protected $from = 'info@pictolitmails.com';
	
	protected $to;
	
	protected $subject;
	
	protected $view;
	
	protected $data = [];
	
	public function __construct(Mailer $mailer)
	{
		$this->mailer = $mailer;
		
	}
	
	public function sendEmailConfirmationTo(User $user)
	{
		$this->to = $user->email;
		$this->view = 'emails.confirm';
		$this->data = compact('user');
		
		$this->deliver();
		
	}
	
	public function deliver()
	{
		$this->mailer->send($this->view, $this->data, function($message) {
			$message->from($this->from, 'Pictolit Admin')
					->to($this->to)
					->subject($this->subject, 'Verify your Account');
		});
		
	}
}
