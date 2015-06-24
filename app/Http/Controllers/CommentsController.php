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
			
			$commentable_type1 = $request->get('commentable_type1');
			
			if($commentable_type1 == 'brand')
			{
				$commentableType = 'App\Brand';
			}
			
			if($commentable_type1 == 'caption')
			{
				$commentableType = 'App\Caption';
			}
			
			if($commentable_type1 == 'story')
			{
				$commentableType = 'App\Story';
			}
			
			
		$commentbody = $request->get('body');
		$commentbody = nl2br($commentbody); 
		
			$comment = new Comment(array(
			//'body' => $request->get('body'),
			'body' => $commentbody,
			'user_id' => Auth::user()->id,
			'commentable_id' => $request->get('commentable_id'),
			'commentable_type' => $commentableType //temporary solution?
			
	));
	
	
		$user = User::find($comment->user_id);
		

	Auth::user()->comments()->save($comment);
		
	\Session::flash('flash_message', 'Your Comment has been posted!');
	if($commentable_type1 == 'caption')
			{
				return redirect('captions/'.$comment->commentable_id.'/')->with('comment', $comment)->with('user', $user);
			}
			
	if($commentable_type1 == 'story')
			{
				return redirect('stories/'.$comment->commentable_id.'/')->with('comment', $comment)->with('user', $user);
			}
	
	if($commentable_type1 == 'brand')
			{
				return redirect('brands/'.$comment->commentable_id.'/')->with('comment', $comment)->with('user', $user);
			}

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
