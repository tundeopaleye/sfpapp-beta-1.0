<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\ContactFormRequest;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class AboutController extends Controller {

	//
	
	public function create()
		{

			return view('contact');
				

}
	public function store(ContactFormRequest $request)
		{

			return \Redirect::route('contact')
				->with('message', 'Thanks for contacting us!');

}



}
