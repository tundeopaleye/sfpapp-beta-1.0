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
	protected $fillable = ['name', 'email', 'password', 'active', 'avatar', 'username'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];
	
	
	/*
	 * including activation code
	 * */
	public static function boot()
	{
		parent::boot();
		
		static::creating(function($user) {
		
		$user->activation_code = str_random(30);
		
	});
	}
	
	public function setPasswordAttribute($password)
	{
		$this->attributes['password'] = bcrypt($password);
	}
	
	public function confirmEmail()
	{
		$this->active = 1;
		$this->activation_code = null;
		
		$this->save();
	}
	
	public function confirmEmailSoc()
	{
		$this->active = 1;
		$this->activation_code = null;
		
		$this->save();
	}
			
public function captions()
	{
		return $this->hasMany('App\Caption');
	}
		
	public function brands()
	{
		return $this->hasMany('App\Brand');
	}	
	
	public function stories()
	{
		return $this->hasMany('App\Story');
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
		