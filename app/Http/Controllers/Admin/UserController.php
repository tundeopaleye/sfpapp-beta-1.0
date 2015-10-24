<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Story;

use App\Category;

use App\User;

use App\Like;


use App\Http\Requests\StoryFormRequest;

use App\Http\Requests\StoryUpdateRequest;

use Auth;

use Input;

use Imagine;

use Intervention\Image\ImageManager;

use Image;

class UserController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function indexname($name)
	{
		
		$user = User::find($name);
	   $brands = $user->brands;
		$stories = $user->stories;
		
		
		
        return view('users.index')->with('brands', $brands)->with('stories', Story::orderBy('id','DESC')->paginate(12))->with('user', $user);			
		
	}
	
	
	public function index($id_or_name)
    {
        $user = User::where('id' , '=', $id_or_name)->orWhere('name', $id_or_name)->firstOrFail();
		$brands = $user->brands;
		$stories = $user->stories;
         return view('users.index')->with('brands', $brands)->with('stories', Story::orderBy('id','DESC')->paginate(12))->with('user', $user);			
		
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
