<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

use Auth;

class CaptionUpdateRequest extends Request {

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
			//
			'title' => 'required | min:2 | max:100',
			'caption' => 'required | min:10 | max:150'
			
		];
	}

}
