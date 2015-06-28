<?php namespace App\Repositories;

use App\User;

class UserRepository {

    /**
     * @param $userData
     * @return static
     */
   public function findByUsernameOrCreate($userData){
		
		return User::firstOrCreate([
		'name' => $userData->nickname,
		'uname' => $userData->nickname,
		'email' => $userData->email,
		'username' => $userData->nickname,
		'avatar' => $userData->avatar,
		'active' => 1,
		]);
	}
} 