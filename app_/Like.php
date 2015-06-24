<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model {

	protected $fillable = ['user_id', 'likeable_id', 'likeable_type', 'story_id'];
    protected $table = 'likes';

    public function user()
    {
        return $this->belongsTo('App\User');
    }
	
	/* public function story()
    {
        return $this->belongsTo('App\Story');
    }*/
	
	public function likeable()
	{
		return $this->morphTo();
	}
	

}
