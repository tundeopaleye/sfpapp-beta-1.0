<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Auth;

use App\Http\Requests\RepostFormRequest; //Create a new form request for Repost instead


use App\Story;

use App\User;

use App\Repost;

use Input;


class RepostsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
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
	public function store(RepostFormRequest $request)
	{
		$repostbody = $request->get('body');
		$repostbody = nl2br($repostbody); 
		
			$repost = new Repost(array(
			//'body' => $request->get('body'),
			'body' => $repostbody,
			//'user_id' => $request->get('user_id'),
			'user_id' => Auth::user()->id,
			'repostable_id' => $request->get('repostable_id'),
			
			'repostable_type' => 'App\Story' // Seems important to work right
			
		));
	
	
		$user = User::find($repost->user_id);
		
		Auth::user()->reposts()->save($repost);
			
		\Session::flash('flash_message', 'Your Retold Story has been posted!');
		
		return redirect('stories/'.$repost->repostable_id.'/')->with('repost', $repost)->with('user', $user);
		//return view('stories.show')->with('repost', $repost)->with('user', $user)->with('story',$story);
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
