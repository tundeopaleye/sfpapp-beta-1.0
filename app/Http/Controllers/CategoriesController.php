<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;


use App\Story;

use App\Caption;

use App\Brand;

use App\Category;

use App\User;

use App\Like;

use App\Repost;

/*use App\Http\Requests\StoryFormRequest;

use App\Http\Requests\StoryUpdateRequest;
*/

use Auth;

use Input;

use Imagine;

use Image;

use Imagine\Image\Box;
use Imagine\Image\ImageInterface;


class CategoriesController extends Controller
{
    //
    
   

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($id)
	{
		
		$category = Category::find($id);
	    $captions = $category->captions;
		$brands = $category->brands;
		$stories = $category->stories;
		
        return view('categories.index')->with('captions', $captions)->with('brands', $brands)->with('stories', $stories)->with('category', $category);			
		
	}
}
