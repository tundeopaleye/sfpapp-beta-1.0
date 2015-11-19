<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//use Requests;

use App\Story;

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

use Illuminate\Contracts\Filesystem\Filesystem;
use GrahamCampbell\Flysystem\Facades\Flysystem;
use Storage;
use App\Mailers\AppMailer;

//use \League\Flysystem\Filesystem;

class StoriesController extends Controller {	
	
	public function __construct(){
		
		$this->middleware('auth', ['only' => 'create', 'edit', 'update', 'delete', 'store']);
		
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		
        $categories = Category::lists('name','id');    
		return view('stories.index')->with('stories', Story::orderBy('id','DESC')->paginate(12)); //Temporary paginate 12
			
			
			

			
			
			
			
			
			
          
	}
	
	public function userindex()
	{
		
        $categories = Category::lists('name','id');    
		//return view('stories.index')->with('stories', Story::orderBy('id','DESC')->paginate(12)); //Temporary paginate 12 - former to revert
		//$stories = Story::all()->where('user_id', Auth::user()->id); 	
		
		// return view('users.index')->with('stories', Story::orderBy('id','DESC')->where('user_id', Auth::user()->id)->paginate(12)); // Works for "My Stories"
		
		return view('users.index')->with('stories', Story::orderBy('id','DESC')->where('user_id', Auth::user()->id)->paginate(12)); //Temporary edit
	
		}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		
		$categories = Category::lists('name','id');
		return view('stories.create')->with('categories', $categories);
		
		
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(StoryFormRequest $request)
	{
		//
		if (Input::hasFile('thumbnail'))
			{
			$image = Image::make(Input::file('thumbnail')->getRealPath());	
			$imaget = Image::make(Input::file('thumbnail')->getRealPath());	 // For thumbnail?
	    	$mime = $image->mime();  //edited due to updated to 2.x
			if ($mime == 'image/jpeg')
			    $ext = '.jpg';
			elseif ($mime == 'image/png')
			    $ext = '.png';
			elseif ($mime == 'image/gif')
			    $ext = '.gif';
			else
			    $ext = '';
			//$filet = rand(1000000000000,1000000000000000) . '-sfp'.$ext; // maybe add random too?
			$filet = time() . '-sfp'.$ext;
			//$filet2 = time() . '-sfpthumbnail';
			$path = public_path() .'/images/';
			$path2 = public_path() .'/thumbnails/';
			$pathb = 'images/';
			$path2b = 'thumbnails/';

            /*
			 * Image upload
			 * */


			$imager = $image->save($path . $filet);
			\Storage::disk('s3')->put($pathb.$filet , $imager->__toString());
			
			/*
			 * Thumbnail upload
			 * */
			 
			$thumb = $imaget->resize(300, null, function ($constraint) {
				    $constraint->aspectRatio();
				})
				->save($path2 . $filet);
			\Storage::disk('s3')->put($path2b.$filet , $thumb->__toString());
			}
		

		$story = new Story(array(
			'title' => $request->get('title'),
			'user_id' => Auth::user()->id,
			'story' => $request->get('story'),
			'thumbnail' => $filet
	));
	
	
	Auth::user()->stories()->save($story);
	
			if (count($request->get('categories')) > 0) {
			$story->categories()->sync($request->get('categories'));
			}
	
	\Session::flash('flash_message', 'Your story has been created!');
	
	
	// Send a mail to those whose usernames appear in the mentions
	
	//$user = User::create($request->all()); // temporary test for email sending
		$user = User::all();
        $mailer->sendEmailMentionNotificationTo(Auth::user()); // temporary test for email sending

	
	return redirect('stories/'.$story->id.'/edit');
		}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		
		$story = Story::find($id);
		$user = User::find($story->user_id);
		$story->story = nl2br($story->story);
		
		
		return view('stories.show')->with('story', $story)->with('user', $user);
		
		
		
		
	
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
		$categories = Category::lists('name','id');
		$story = Story::find($id);

		return view('stories.edit')->with('story', $story)->with('categories', $categories);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, StoryUpdateRequest $request)
	{
			$story = Story::find($id);
			
			$story->update([
			'title' => $request->get('title'),
			'user_id' => $request->get('user_id'),
			'thumbnail' => $request->get('thumbnail'),
			'story' => $request->get('story')
			]);
						
			if (count($request->get('categories')) > 0) {
			$story->categories()->sync($request->get('categories'));
			}
		//
		
		return \Redirect::route('stories.edit', array($story->id))->with('message', 'Your story has been updated!');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
		Story::destroy($id);

		return \Redirect::route('stories.index')
			->with('message', 'The story has been deleted!');
	}

}