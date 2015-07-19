<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {

	//
	
	protected $fillable = ['name','id'];
	
	public function stories()
		{
		//return $this->belongsToMany('App\Story')->withTimestamps();
		return $this->belongsToMany('App\Story');
		}
		
		public function captions()
		{
		return $this->belongsToMany('App\Caption');
		}

		public function brands()
		{
		return $this->belongsToMany('App\Brand');
		}
}
