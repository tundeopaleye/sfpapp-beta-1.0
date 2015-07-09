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

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
		$liststories = Story::orderBy('id','DESC');
		$listcaptions = Caption::orderBy('id','DESC');
		$listbrands = Brand::orderBy('id','DESC');
		
		$categories = Category::lists('name','id'); 
		$user = User::all(); 
		$story = Story::lists('title','id');
		$brand = Brand::all();  
		$caption = Caption::all(); 
		$story = Story::all(); 
		$repost = Repost::all(); 
		return view('dashboard.index')->with('caption', $caption)->with('story', $story)->with('brand', $brand)->with('user',$user)->with('repost', $repost)->with('listcaptions', $listcaptions)->with('liststories', $liststories);	
			
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
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
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
