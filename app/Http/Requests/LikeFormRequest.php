<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

use Auth;

class LikeFormRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return Auth::check();
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		
		
		return [
			'likeable_type1' => 'required',		
		];
		
		/*if($likeableType == 'App\Story')
		{
			return [
			'story_id' => 'required',		
		];
		
		}
		
		
		if($likeableType == 'App\Caption')
		{
			return [
			'caption_id' => 'required',		
		];
		
		}
		 * 
		 */
	}

}
