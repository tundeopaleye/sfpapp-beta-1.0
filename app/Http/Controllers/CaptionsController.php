<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//use Requests;

use App\Caption;

use App\Category;

use App\User;

use App\Like;

use App\Http\Requests\CaptionFormRequest;

use App\Http\Requests\CaptionUpdateRequest;

use Auth;

use Input;

use Imagine;

use Image;

use Imagine\Image\Box;
use Imagine\Image\ImageInterface;

use Illuminate\Contracts\Filesystem\Filesystem;
use GrahamCampbell\Flysystem\Facades\Flysystem;
use Storage;

//use \League\Flysystem\Filesystem;

class CaptionsController extends Controller {	
	
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
		//$imagepath = \Storage::disk('s3')->get(public_path());
           
		return view('captions.index')->with('captions', Caption::orderBy('id','DESC')->paginate(12)); //Temporary paginate 4
			
			
			

			
			
			
			
			
			
          
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		
		$categories = Category::lists('name','id');
		return view('captions.create')->with('categories', $categories);
		
		
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CaptionFormRequest $request)
	{
		//
		if (Input::hasFile('thumbnail'))
			{
			$image = Image::make(Input::file('thumbnail')->getRealPath());	
				
	    	$mime = $image->mime();  //edited due to updated to 2.x
			if ($mime == 'image/jpeg')
			    $ext = '.jpg';
			elseif ($mime == 'image/png')
			    $ext = '.png';
			elseif ($mime == 'image/gif')
			    $ext = '.gif';
			else
			    $ext = '';
			//$filet = rand(1000000000000,1000000000000000) . '-sfp'.$ext;
			$filet = time() . '-sfp'.$ext;
			//$filet2 = time() . '-sfpthumbnail';
			$path = public_path() .'/images/';
			$path2 = public_path() .'/thumbnails/';

                        //$path = public_path() .'/images/';
			//$path2 = public_path() .'/thumbnails/';


			$image->save($path . $filet)
				->resize(300, null, function ($constraint) {
				    $constraint->aspectRatio();
				})
				->save($path2 . $filet);
			$thumb = $image->resize(300, null);
				
			//Flysystem::put('hi.txt', 'foo');	
			//Flysystem::connection('s3')->put('hi.txt', 'foo');
			//Flysystem::put('hi.txt', 'foo');
			//Storage::disk('s3')->put('file.txt', 'Contents');
			
			//$content = $filesystem->disk('local')->get('test.txt');
			//$content = $filesystem->disk('local')->get('test.txt');
			//$filesystem->disk('s3')->put('test.txt', $image);
			//Storage::disk('local')->put('file.txt', 'Contents');
			\Storage::disk('s3')->put($path.$filet , $image->__toString());
			\Storage::disk('s3')->put($path2.$filet , $thumb->__toString());
			}
		

		$caption = new Caption(array(
			'title' => $request->get('title'),
			'user_id' => Auth::user()->id,
			'caption' => $request->get('caption'),
			'thumbnail' => $filet
	));
	
	
	Auth::user()->captions()->save($caption);
	
			if (count($request->get('categories')) > 0) {
			$caption->categories()->sync($request->get('categories'));
			}
	
	\Session::flash('flash_message', 'Your caption has been created!');

	
	return redirect('captions/'.$caption->id.'/edit');
		}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		
		$caption = Caption::find($id);
		$user = User::find($caption->user_id);
		$caption->caption = nl2br($caption->caption);
		
		
		return view('captions.show')->with('caption', $caption)->with('user', $user);
		
		
		
		
	
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
		$caption = Caption::find($id);

		return view('captions.edit')->with('caption', $caption)->with('categories', $categories);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, CaptionUpdateRequest $request)
	{
			$caption = Caption::find($id);
			
			$caption->update([
			'title' => $request->get('title'),
			'user_id' => $request->get('user_id'),
			'thumbnail' => $request->get('thumbnail'),
			'caption' => $request->get('caption')
			]);
						
			if (count($request->get('categories')) > 0) {
			$caption->categories()->sync($request->get('categories'));
			}
		//
		
		return \Redirect::route('captions.edit', array($caption->id))->with('message', 'Your caption has been updated!');
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
		Brand::destroy($id);

		return \Redirect::route('captions.index')
			->with('message', 'The caption has been deleted!');
	}

}