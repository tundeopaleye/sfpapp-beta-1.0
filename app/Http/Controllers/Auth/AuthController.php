<?php namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\Mailers\AppMailer;
use App\AuthenticateUser;

use App\Story;

use App\Category;

use App\User;

use App\Like;



use Illuminate\Http\Request;

//use App\Http\Requests\StoryFormRequest;

use Auth;

use Input;

use App\AuthenticateUserListener;



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

	//use AuthenticatesAndRegistersUsers;

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
	
	public function login(AuthenticateUser $authenticateUser, Request $request){
			
			
    	 $hasCode = $request->has('code');

        return $authenticateUser->execute($hasCode, $this);
	 
	 
    }

public function logintwitter(AuthenticateUser $authenticateUser, Request $request){
			
			
    	 $hasCode = $request->has('oauth_token');

        return $authenticateUser->executetwitter($hasCode, $this);
	 
	 
    }

public function loginfacebook(AuthenticateUser $authenticateUser, Request $request){
			
			
    	 $hasCode = $request->has('code');

        return $authenticateUser->executefacebook($hasCode, $this);
	 
	 
    }
	
	
	
	
	
	
	
	
	
	
	
	
	public function register()
    {
        return view('auth.register');
    }
	
	public function postRegister(Request $request, AppMailer $mailer)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);

        $user = User::create($request->all());

        $mailer->sendEmailConfirmationTo($user);

        flash('Please confirm your email address.');

        return redirect()->back();
    }
	
	public function postLogin(AuthenticateUser $authenticateUser, 
	Request $request, $provider = null) 
	{
       //return $authenticateUser->execute($request->all(), $this, $provider)->with('user', $user); //->signIn()//original code only
       
        $this->validate($request, ['email' => 'required|email', 'password' => 'required']);
       if ($this->signIn($request)) {
            flash('Welcome back!');

            return redirect()->intended('/captions');
        }

        flash('Could not sign you in.');
		//return $authenticateUser->execute($request->has('code'), $this); //additional login for socialite?
        return redirect()->back();
/**/	}
	
	public function logout()
    {
        Auth::logout();

        flash('You have now been signed out. See ya.');

        return redirect('login');
    }
	
	public function prelogin(AuthenticateUser $authenticateUser, 
	Request $request, $provider = null) 
	{
       return $authenticateUser->execute($request->all(), $this, $provider); //->signIn()//original code only
       
      
/**/	}
	

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
	
	public function loginsocial(AuthenticateUser $authenticateUser, Request $request){
    	
		return $authenticateUser->execute($request->has('code'), $this);
    	
	/*	Interacts with the twitter app for the unique token/code for tests
		return \Socialite::with('twitter')->redirect();
	 * 
	 */
	 
	 
    }
	
	public function userHasLoggedIn($user){
		
		return redirect('/');
	}
}
