<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Mailers\AppMailer;

use Illuminate\Http\Request;

use App\Story;

use App\Category;

use App\User;

use App\Like;


use App\Http\Requests\StoryFormRequest;

use App\Http\Requests\StoryUpdateRequest;

use Auth;

use Input;

class RegistrationController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}
	
	
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function confirmEmail($activation_code)
	{
		// $users = User::orderBy('created_at', 'desc')->get();
		$user = User::whereActivation_code($activation_code)->firstOrFail()->confirmEmail(); // Adding new method - confirmEmail
		
		\Session::flash('flash_message', 'Your Email is Confirmed');
		
		return redirect('login');
		//return 'Confirmed';
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function register()
	{
		return view('auth.register');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postRegister(Request $request, AppMailer $mailer)
	{
		//return view('home');
		
		//validate the request
		$this->validate($request, [
			'name' => 'required | unique:users',
			'email' => 'required | email | unique:users',
			'password' => 'required'
		]);/**/
		
		//create the user
		$user = User::create($request->all());
		
		//email them a confirmation link
		$mailer->sendEmailConfirmationTo($user);
		
		//flash message
		\Session::flash('flash_message', 'Confirm your email address');
		
		//redirect back
		return redirect()->back();
	}

	

}
