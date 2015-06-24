<?php namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Story extends Model {

	//
	
		protected $fillable = ['title', 'thumbnail', 'story'];
		
		
		
		use SoftDeletes;	
		protected $dates = ['deleted_at'];
	/*	
		public function stories()
 		 {
    	return $this->has_many('Story')->order_by('id', 'asc');
  		}
		
	*/	
	
		public function user()
		{
		return $this->belongsTo('App\User');
		}
		
		
		
		public function comments()
		{
		return $this->morphMany('\App\Comment', 'commentable');
		}
		
		public function reposts()
		{
		return $this->morphMany('\App\Repost', 'repostable');
		}
		
		public function categories()
		{
		//return $this->belongsToMany('App\Category')->withTimestamps();
		return $this->belongsToMany('App\Category');
		}
	    /*
	    public function likes()
	    {
	        return $this->hasMany('App\Like');
	    }*/
	    
	    public function likes()
		{
		return $this->morphMany('\App\Like', 'likeable');
		}

}
