<?php namespace App\Services;

use App\User;
use Mail;
use Validator;
use Illuminate\Contracts\Auth\Registrar as RegistrarContract;

class Registrar implements RegistrarContract {

	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	public function validator(array $data)
	{
		return Validator::make($data, [
			'name' => 'required|max:255|unique:users',
			'email' => 'required|email|max:255|unique:users',
			'password' => 'required|confirmed|min:6',
		//	'password_confirmation' => 'required|min:6',
		]);
	}

	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array  $data
	 * @return User
	 */

        public function create(array $data)
        {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password'])
               
            ]);

//do your role stuffs here

            //send verification mail to user
            //---------------------------------------------------------------------------------------
            $data['activation_code']  = $user->activation_code;
			
            Mail::send('emails.welcome', $data, function($message) use ($data)
            {
                $message->from('no-reply@sfpapp.com', "SFP");
                $message->subject("Welcome to SFP");
                $message->to($data['email']);
            });


            return $user;
        }
}