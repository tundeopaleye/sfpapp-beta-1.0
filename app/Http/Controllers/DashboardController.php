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

use App\Repost;

use App\Http\Requests\StoryFormRequest;

use App\Http\Requests\StoryUpdateRequest;

use Auth;

use Input;

use Imagine;

use Image;

use Imagine\Image\Box;
use Imagine\Image\ImageInterface;

class DashboardController extends Controller {
	
	
	public function __construct(){
		
		$this->middleware('auth', ['only' => 'index']);
		
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
		$categories = Category::lists('name','id'); 
		$brands = Brand::all()->where('user_id', Auth::user()->id);  
		$captions = Caption::all()->where('user_id', Auth::user()->id); 
		$stories = Story::all()->where('user_id', Auth::user()->id); 
		return view('dashboard.index')->with('captions', $captions)->with('stories', $stories)->with('brands', $brands);	
		
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource. // not in use...only index
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show()
	{
		//
		$user = User::all();
		$stories = Story::all();
		return view('dashboard.index')->with('user', $user)->with('stories', $stories);
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
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
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
	}

}
