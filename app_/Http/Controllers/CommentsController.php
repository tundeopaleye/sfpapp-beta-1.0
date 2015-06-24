<?php namespace App\Http\Controllers;

use Auth;

use App\Http\Requests;

//use App\Http\Requests\Request;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Http\Requests\CommentFormRequest;


use App\Story;

//use App\Story;

//use App\Category;

use App\User;

use App\Comment;

//use Comment;
//use App\Category;

//use Illuminate\Http\Request;

//use App\Http\Requests\StoryFormRequest;



use Input;

class CommentsController extends Controller {

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
	
		public function store(CommentFormRequest $request)
	{
			
		$commentbody = $request->get('body');
		$commentbody = nl2br($commentbody); 
		
			$comment = new Comment(array(
			//'body' => $request->get('body'),
			'body' => $commentbody,
			//'user_id' => $request->get('user_id'),
			'user_id' => Auth::user()->id,
			'commentable_id' => $request->get('commentable_id'),
			//'commentable_id' => 'temporary value',
			//'commentable_id' => $story->id,
			'commentable_type' => 'App\Story' //temporary solution
			
	));
	
	//$story = new Story($request->all());
	
	//$comment = Comment::find($id);
		$user = User::find($comment->user_id);
		//return view('stories.show')->with('story', $story)->with('user', $user);

	Auth::user()->comments()->save($comment);
		
	\Session::flash('flash_message', 'Your Comment has been posted!');
	
	return redirect('stories/'.$comment->commentable_id.'/')->with('comment', $comment)->with('user', $user);
	
//	return redirect('stories/'.$story->id.'/edit');
	
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
		$comment = Comment::find($id);
		//$user = User::find($story->user_id);
		//$story->story = nl2br($story->story);
		
		//$comment->body = nl2br($comment->body);
		
		$comment->body = $request->get('body');
		$comment->body = nl2br($comment->body);
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
