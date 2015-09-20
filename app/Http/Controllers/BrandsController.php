<?php namespace App\Http\Controllers;

use App\Http\Requests;

//use Requests;

use App\Http\Controllers\Controller;

use App\Brand;

use App\Category;

use App\User;

use App\Like;


use Illuminate\Http\Request;

use App\Http\Requests\BrandFormRequest;

use App\Http\Requests\BrandUpdateRequest;

use Auth;

use Input;



use Intervention\Image\ImageManager;

use Image;

use Illuminate\Contracts\Filesystem\Filesystem;
use GrahamCampbell\Flysystem\Facades\Flysystem;
use Storage;
//use Busayo\Mention\MentionServiceProvider;



class BrandsController extends Controller {
	
	
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
           
		return view('brands.index')->with('brands', Brand::orderBy('id','DESC')->paginate(8)); //Temporary paginate 4
			
		          
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		
		$categories = Category::lists('name','id');
		return view('brands.create')->with('categories', $categories);
		
		
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(BrandFormRequest $request)
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
		

		$brand = new Brand(array(
			'title' => $request->get('title'),
			'user_id' => Auth::user()->id,
			'brand' => $request->get('brand'),
			'thumbnail' => $filet //$name prev
	));
	
	
	Auth::user()->brands()->save($brand);
	
			if (count($request->get('categories')) > 0) {
			$brand->categories()->attach($request->get('categories'));
			}
	
	\Session::flash('flash_message', 'Your Brand Story has been created!');

	
	return redirect('brands/'.$brand->id.'/edit');
		}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		
		$brand = Brand::find($id);
		$user = User::find($brand->user_id);
		$brand->brand = nl2br($brand->brand);
		
		
		return view('brands.show')->with('brand', $brand)->with('user', $user);
		
		
		
		
	
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$categories = Category::lists('name','id');
		//$categories = Category::all('name','id');
		$brand = Brand::find($id);

		return view('brands.edit')->with('brand', $brand)->with('categories', $categories);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, BrandUpdateRequest $request)
	{
			$brand = Brand::find($id);
			
			$brand->update([
			'title' => $request->get('title'),
			'user_id' => $request->get('user_id'),
			'thumbnail' => $request->get('thumbnail'),
			'brand' => $request->get('brand')
			]);
						
			if (count($request->get('categories')) > 0) {
			$brand->categories()->sync($request->get('categories'));
			}
		//
		
		return \Redirect::route('brands.edit', array($brand->id))->with('message', 'Your brand story has been updated!');
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

		return \Redirect::route('brands.index')
			->with('message', 'The brand story has been deleted!');
	}

}
