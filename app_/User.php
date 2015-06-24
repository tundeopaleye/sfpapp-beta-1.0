<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'email', 'password'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];
	
	public function stories()
		{
		return $this->hasMany('App\Story');
	//	return $this->hasMany('App\Stories')->withTimestamps();
		
		//return $this->belongsToMany('App\Stories')->withTimestamps(); //With Timestamps?
		}


public function comments()
		{
		return $this->hasMany('App\Comment');
			}
		
		public function reposts()
		{
		return $this->hasMany('App\Repost');
			}
		
		public function likes()
		{
		return $this->hasMany('App\Like');
			}

}
