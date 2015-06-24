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


class BrandsController extends Controller {

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
				
	    	$mime = $image->mime();  //edited due to updated to 2.x
			if ($mime == 'image/jpeg')
			    $ext = '.jpg';
			elseif ($mime == 'image/png')
			    $ext = '.png';
			elseif ($mime == 'image/gif')
			    $ext = '.gif';
			else
			    $ext = '';
			$filet = time() . '-sfp'.$ext;
			//$filet2 = time() . '-sfpthumbnail';
			
            // $path = '../public_html/images/';
			// $path2 = '../public_html/thumbnails/';

            $path = public_path() .'/images/';
			$path2 = public_path() .'/thumbnails/';


			$image->save($path . $filet)
				->resize(300, null, function ($constraint) {
				    $constraint->aspectRatio();
				})
				->save($path2 . $filet);
				
				
				
				
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
		//
		$categories = Category::lists('name','id');
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
