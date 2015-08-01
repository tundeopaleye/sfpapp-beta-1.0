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

use App\Http\Requests\StoryFormRequest;

use App\Http\Requests\StoryUpdateRequest;

use Auth;

use Input;

use Imagine;

use Image;

use Imagine\Image\Box;
use Imagine\Image\ImageInterface;

class SuperAdminController extends Controller
{
    //
    
    public function index()
	{
		//
		$categories = Category::lists('name','id'); 
		$brands = Brand::all()->where('user_id', Auth::user()->id);  
		$captions = Caption::all()->where('user_id', Auth::user()->id); 
		$stories = Story::all()->where('user_id', Auth::user()->id); 
		return view('dashboard.index')->with('captions', $captions)->with('stories', $stories)->with('brands', $brands);	
		
	}
    
    
    
}
