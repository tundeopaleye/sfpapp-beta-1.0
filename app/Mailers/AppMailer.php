<?php

namespace App\Mailers;

use Illuminate\Contracts\Mail\Mailer;

use App\User;

class AppMailer {
		
	protected $mailer;	
	
	protected $from = 'admin@sfpapp.com';
	
	protected $to;
	
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
			$message->from($this->from, 'SFP Admin')
					->to($this->to);
		});
		
	}
}
