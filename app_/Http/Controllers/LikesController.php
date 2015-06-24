<?php namespace App\Http\Controllers;

use Auth;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Http\Requests\LikeFormRequest;

use App\Story;

use App\Category;

use App\User;

use App\Like;

use Input;

use Redirect;



class LikesController extends Controller {
	
	//use CommanderTrait;

/**
 * Like a comment
 * @return Response
 */
public function store(LikeFormRequest $request)
{
// using a command bus. Basically making a post to the likes table assigning user_id and comment_id then redirect back
   // extract(Input::only('user_id', 'story_id'));
   // $this->execute(new StoryLikeCommand($user_id, $story_id));
   
  
		
			$like = new Like(array(
			'user_id' => Auth::user()->id, 
			'likeable_id' => $request->get('story_id'),
			'likeable_type' => 'App\Story' //temporary solution
			
	));
	
	
		$user = User::find($like->user_id);
		
	Auth::user()->likes()->save($like);
	
		
	\Session::flash('flash_message', 'You just liked this story!');
	
	//return redirect('stories/'.$like->story_id.'/')->with('like', $like)->with('user', $user);

    return Redirect::back();
}
public function update($id)
{
    
	$like = new Like;
    $user = Auth::user();
    $id = Input::only('story_id');
    $like->where('user_id', Auth::id)->where('story_id', $id)->first()->delete();
    return Redirect::back();
	 
}


public function destroy($id)
	{
		//
		
		//$like = Like::find($id);
		
	//	$user = User::find($like->user_id);
		
		
		Like::destroy($id);

		return Redirect::back();
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	/*
	public function __construct() {
        //We will implement Filters later
        //$this -> beforeFilter('csrf', array('on' => 'post'));
        //I will not implement login system here since its already covered
        //in our secure login system series you can download the code from there
  
    }
  
    public function index(){
        return View::make('index');
    }
  
    public function like(){
  
        if(Input::has("story_id")){
  
            $story_id=explode("_",Input::get("story_id"));
  
            //Find if user already liked the post
            if(Likes::where("story_id",$story_id[1])->where("user_id","1")->count()>0){
                Likes::where("story_id",$storyt_id[1])->where("user_id","1")->delete();
                return Response::json(array("result"=>"1","isunlike"=>"0","text"=>"Like"));
            }else{
                $like=new Likes();
                //We are using hardcoded user id for now , in production change
                //it to Sentry::getId() if using Sentry for authentication
                $like->user_id="1";
                $like->story=$story_id[1];
                $like->save();
  
                return Response::json(array("result"=>"1","isunlike"=>"1","text"=>"unlike"));
            }
  
            return Response::json(array("result"=>"1","isunlike"=>"1","text"=>"unlike"));
        }else{
            //No post id no access sorry
            return Response::json(array("result"=>"0"));
        }
  
    }
	 * 
	 */

}
