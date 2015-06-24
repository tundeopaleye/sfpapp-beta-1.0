<?php namespace App\Http\Controllers;


use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;


use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\AuthenticateUser;
use App\AuthenticateUserListener;



//use App\AuthenticateUser;

use App\Repositories\UserRepository; 


use App\Story;

use App\Category;

use App\User;

use App\Like;



//use Illuminate\Http\Request;

//use App\Http\Requests\StoryFormRequest;

use Auth;

use Input;







class AuthController extends Controller implements AuthenticateUserListener{

	/*
	|--------------------------------------------------------------------------
	| Registration & Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users, as well as the
	| authentication of existing users. By default, this controller uses
	| a simple trait to add these behaviors. Why don't you explore it?
	|
	*/

	

	/**
	 * Create a new authentication controller instance.
	 *
	 * @param  \Illuminate\Contracts\Auth\Guard  $auth
	 * @param  \Illuminate\Contracts\Auth\Registrar  $registrar
	 * @return void
	 */
	public function __construct(Guard $auth, Registrar $registrar)
	{
		$this->auth = $auth;
		$this->registrar = $registrar;

		$this->middleware('guest', ['except' => 'getLogout']);
	}
	
	public function login(AuthenticateUser $authenticateUser, 
	Request $request, $provider = null) 
	{
       //return $authenticateUser->execute($request->all(), $this, $provider)->with('user', $user); //->signIn()//original code only
       
        $this->validate($request, ['email' => 'required|email', 'password' => 'required']);
       if ($this->signIn($request)) {
            flash('Welcome back!');

            return redirect()->intended('/dashboard');
        }

        flash('Could not sign you in.');

        return redirect()->back();
/**/	}

		 public function loginsocial(AuthenticateUser $authenticateUser, Request $request){
    	
		return $authenticateUser->execute($request->has('code'), $this);
    	
	/*	Interacts with the twitter app for the unique token/code for tests
		return \Socialite::with('twitter')->redirect();
	 * 
	 */
	 
	 
    }

/*
public function loginsocial(AuthenticateUser $authenticateUser, Request $request)
    {
        $hasCode = $request->has('code');

        return $authenticateUser->execute($hasCode, $this);
    }
*/

 
public function confirmEmail($activation_code)
	{
	  $user = User::whereActivation_code($activation_code)->first()->confirmEmail();
	return view('auth.login');
	
	}
	
	
	 /**
     * Attempt to sign in the user.
     *
     * @param  Request $request
     * @return boolean
     */
    protected function signIn(Request $request)
    {
        return Auth::attempt($this->getCredentials($request), $request->has('remember'));
    }

    /**
     * Get the login credentials and requirements.
     *
     * @param  Request $request
     * @return array
     */
    protected function getCredentials(Request $request)
    {
        return [
            'email'    => $request->input('email'),
            'password' => $request->input('password'),
            'active' => 1
        ];
    }
	
	public function userHasLoggedIn($user) {
    \Session::flash('message', 'Welcome, ' . $user->username . 'and' . $user->name);
    return redirect('/stories')->with('user', $user);
	// return $user->name;
}
}
