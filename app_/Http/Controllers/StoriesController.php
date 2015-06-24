<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Story;
use App\Category;
use App\User;
use App\Like;
use Illuminate\Http\Request;
use App\Http\Requests\StoryFormRequest;
use Auth;
use Input;
use Image;

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
    // return view('stories.index')->with('stories', Story::all());
		//$story->story = nl2br($story->story); //Line break for index?
		return view('stories.index')->with('stories', Story::orderBy('id','DESC')->paginate(8)); //Temporary paginate 4
		//return view('stories.index')->with('stories', Story::orderBy('id','DESC')->get());

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//

		//$categories = \App\Category::all();
		$categories = Category::lists('name','id');
		return view('stories.create')->with('categories', $categories);

		///stories/{{$story->id}}/edit
		/*
		$categories = \App\Category::stories('name', 'id');
		return view('stories.create')->with('categories', $categories);
		 * */
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
				$file = Input::file('thumbnail');
				//$name = time() . '-' . $file->getClientOriginalName();
				$name = time() . '-sfp';
				$file = $file->move(public_path().'/images/', $name);
				//$story->thumbnail = $name;
				//$request['thumbnail'] = $name;
				//$request->get('thumbnail') = $name;
			}



		$story = new Story(array(
			'title' => $request->get('title'),
			//'user_id' => $request->get('user_id'),
			'user_id' => Auth::user()->id,
			'story' => $request->get('story'),
			//'story' => $storyform,
			'thumbnail' => $name
	));

	//$story = new Story($request->all());

	Auth::user()->stories()->save($story);

			if (count($request->get('categories')) > 0) {
			$story->categories()->attach($request->get('categories'));
			}

	\Session::flash('flash_message', 'Your Story has been created!');

	//return \Redirect::route('stories.create')->with('message', 'Your story has been created!');

	//return redirect('stories');
	return redirect('stories/'.$story->id.'/edit');
	//return view('stories/'.$story->id.'/edit')->with('categories', $categories);
	}

public function postcreate($id)
	{
		//

		//$categories = \App\Category::all();
		//$categories = Category::lists('name','id');
		//return view('stories.show')->with('categories', $categories);

		//return view('stories.show')->with('story', $story)->with('user', $user);
		//return view('stories.show');

		///stories/{{$story->id}}/edit
		/*
		$categories = \App\Category::stories('name', 'id');
		return view('stories.create')->with('categories', $categories);
		 * */
	}



	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
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

		$story = Story::find($id);

		return view('stories.edit')->with('story', $story);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, StoryFormRequest $request)
	{
			$story = Story::find($id);

			$story->update([
			'title' => $request->get('title'),
			'user_id' => $request->get('user_id'),
			'thumbnail' => $request->get('thumbnail'),
			'story' => $request->get('story')
			]);


		//

		return \Redirect::route('stories.edit', array($story->id))->with('message', 'Your list has been updated!');
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


	public function imagetest()
	{
		//
		$image = Image::make(file_get_contents('http://localhost:8000/images/1427902331-sfp'));

		return Response::make($image, 200, ['Content-Type' => 'image/jpg']);

	}



}
