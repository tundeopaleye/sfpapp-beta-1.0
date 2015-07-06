<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//use Requests;

use App\Story;

use App\Caption;

use App\Brand;

use App\Category;

use App\User;

use App\Like;

use App\Http\Requests\StoryFormRequest;

use App\Http\Requests\StoryUpdateRequest;

use Auth;

use Input;

use Imagine;

use Image;

use Imagine\Image\Box;
use Imagine\Image\ImageInterface;

class WelcomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('guest');
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		
		$categories = Category::lists('name','id'); 
		$story = Story::lists('title','id');
		$brand = Brand::all()->random(1);  
		$caption = Caption::all()->random(1); 
		$story = Story::all()->random(1); 
		return view('welcome')->with('caption', $caption)->with('story', $story)->with('brand', $brand);	
			
	}
	
	
	
	public function show($id)
	{
		//
		$story = Story::find($id);
		$user = User::find($story->user_id);
		$story->story = nl2br($story->story);
		
		
		return view('stories.show')->with('story', $story)->with('user', $user);
		
		
	}

}
