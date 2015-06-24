<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model {

	//
	
	protected $fillable = ['commentable_id', 'body', 'commentable_type', 'commentable_type1'];
	
	public function commentable()
	{
		return $this->morphTo();
	}
	 
	

	public function user()
	{
		return $this->belongsTo('App\User');
	}

}
