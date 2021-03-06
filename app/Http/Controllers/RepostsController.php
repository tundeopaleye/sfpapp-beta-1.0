<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Auth;

use App\Http\Requests\RepostFormRequest; //Create a new form request for Repost instead

use App\Mailers\AppMailer;

use App\Story;

use App\User;

use App\Repost;

use App\Brand;

use App\Caption;

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
	public function store(RepostFormRequest $request, AppMailer $mailer)
	{
		
		
		
		$repostable_type1 = $request->get('repostable_type1');
			
			if($repostable_type1 == 'caption')
			{
				$repostableType = 'App\Caption';
			}
			
			if($repostable_type1 == 'story')
			{
				$repostableType = 'App\Story';
			}
			
			if($repostable_type1 == 'brand')
			{
				$repostableType = 'App\Brand';
			}
			
			
			
		$repostbody = $request->get('body');
		$repostbody = nl2br($repostbody); 
		
			$repost = new Repost(array(
			//'body' => $request->get('body'),
			'body' => $repostbody,
			//'user_id' => $request->get('user_id'),
			'user_id' => Auth::user()->id,
			'repostable_id' => $request->get('repostable_id'),
			
			'repostable_type' => $repostableType // Seems important to work right
			
		));
	
	
		$user = User::find($repost->user_id);
		
		Auth::user()->reposts()->save($repost);
		
		// Mailing based on user mentions
		
		// A list of users in the db
		
		$usermail = User::all();
		
	//	$usermail = "@".User::all(); //Attach "@" to it from here?
		
		foreach ($usermail as $userm) {
  if (preg_match("/\s+$userm\s+/i", $repostbody)) {
    //Mail script to user user->email();
    $mailer->sendEmailMentionNotificationTo($userm);
  }
}
	

			
		\Session::flash('flash_message', 'Your Retold Story has been posted!');
		

		if($repostable_type1 == 'story')
			{
				return redirect('stories/'.$repost->repostable_id.'/')->with('repost', $repost)->with('user', $user);
			}
			
		if($repostable_type1 == 'caption')
			{
				return redirect('captions/'.$repost->repostable_id.'/')->with('repost', $repost)->with('user', $user);
			}	
			
		if($repostable_type1 == 'brand')
			{
				return redirect('brands/'.$repost->repostable_id.'/')->with('repost', $repost)->with('user', $user);
			}	
	
		
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
		
		$repost = Repost::find($id);
		$story = Story::find($repost->repostable_id);
		$brand = Brand::find($repost->repostable_id);
		$user = User::find($repost->user_id);
		$repost->body = nl2br($repost->body);		
		
		return view('reposts.show')->with('repost', $repost)->with('user', $user)->with('story', $story)->with('brand', $brand); //body or repost?
		
		
		
		
	
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
