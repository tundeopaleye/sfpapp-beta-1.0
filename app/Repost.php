<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Repost extends Model {

	//
	
	
	protected $fillable = ['repostable_id', 'body', 'repostable_type', 'repostable_type1'];
	
	public function repostable()
	{
		return $this->morphTo();
	}
	
	
	public function user()
	{
		return $this->belongsTo('App\User');
	}

}
