<?php namespace App;

use Laravel\Socialite\Contracts\Factory as Socialite;

use Auth;

use App\Repositories\UserRepository;

use Illuminate\Contracts\Auth\Guard;

use Illuminate\Http\Request;


use App\User;

    
    
   class AuthenticateUser{
    	
		
		 /**
     * @var UserRepository
     */
    private $users;

    /**
     * @var Socialite
     */
    private $socialite;

    /**
     * @var Guard
     */
    private $auth;

    /**
     * @param UserRepository $users
     * @param Socialite $socialite
     * @param Guard $auth
     */
		
		public function __construct(UserRepository $users, Socialite $socialite, Guard $auth){
			
			$this->users = $users;
        	$this->socialite = $socialite;
        	$this->auth = $auth;
		}
    	
		public function execute($hasCode, AuthenticateUserListener $listener){
			
			if ( ! $hasCode) return $this->getAuthorizationFirst();

			//$user = $this->socialite->driver('github')->user(); //addition - extract to it's function
			
			$user = $this->users->findByUsernameOrCreate($this->getGitHubUser()); // addition 
			
		$this->auth->login($user, true);
			
		return $listener->userHasLoggedIn($user);
			//dd($user);
		}
		
		public function executetwitter($hasCode, AuthenticateUserListener $listener){
			
			if ( ! $hasCode) return $this->getAuthorizationFirstTwitter();
			$user = $this->users->findByUsernameOrCreate($this->getTwitterUser()); // addition 
			$this->auth->login($user, true);
			return $listener->userHasLoggedIn($user);
			//dd($user);
		}
		
		
		public function executefacebook($hasCode, AuthenticateUserListener $listener){
			
			if ( ! $hasCode) return $this->getAuthorizationFirstFacebook();
			$user = $this->users->findByUsernameOrCreate($this->getFacebookUser()); // addition 
			$this->auth->login($user, true);
			return $listener->userHasLoggedIn($user);
			//dd($user);
		}
		
		
		private function getAuthorizationFirst()
		{
		
		return $this->socialite->driver('github')->redirect();
		
		}
		
		private function getAuthorizationFirstTwitter()
		{
		
		return $this->socialite->driver('twitter')->redirect();
		
		}
		
		private function getAuthorizationFirstFacebook()
		{
		
		return $this->socialite->driver('facebook')->redirect();
		
		}
		
		private function getGitHubUser(){
			return $this->socialite->driver('github')->user();
		}
		
		private function getTwitterUser(){
			return $this->socialite->driver('twitter')->user();
		}
		
		private function getFacebookUser(){
			return $this->socialite->driver('facebook')->user();
		}
		
		
		
		
		
		
		
    }
