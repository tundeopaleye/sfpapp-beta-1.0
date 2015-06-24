<?php namespace App\Http\Controllers;

use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class SessionsController extends Controller {

	
	public function login()
	{
		//
		return view('auth.login');
		 
	}
	
	public function postLogin(Request $request)
	{
		// validate
		$this->validate($request, ['email' => 'required|email', 'password' => 'required']);
		
		//attempt to login
		if (Auth::attempt($this->getCredentials($request))){
		\Session::flash('flash_message', 'Your are now logged in!');
			
			return redirect()->intended('/dashboard');	
		}
		
		\Session::flash('flash_message', 'Could not sign you in');
		return redirect()->back();
	}
	
	public function logout()
	{
		//
		Auth::logout();
		// Flash message?
		return redirect('login');
	}
	
	public function getCredentials(Request $request)
	{
		return[
			'email' => $request->input('email'),
			'password' => $request->input('password'),
			'active' => true
		];
	}
	

	

}
