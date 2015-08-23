<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

//get('register', 'Auth\AuthController@register');
get('register', 'RegistrationController@register');
post('register', 'RegistrationController@postRegister');

get('register/confirm/{activation_code}', 'RegistrationController@confirmEmail');

//Route::post('auth/login', 'Auth\AuthController@login'); // Wondering why the group routes below didn't pick it
//Route::get('auth/login', 'Auth\AuthController@login'); // Wondering why the group routes below didn't pick it

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);/**/


get('login', 'SessionsController@login');
post('login', 'SessionsController@postLogin');
get('logout', 'SessionsController@logout');

get('dashboard', 'DashboardController@index');

get('admin/dashboard', 'SuperAdminController@index');

//get('categories/{category}', 'CategoriesController@index');
get('categories/{id}', 'CategoriesController@index');


get('social/login', 'Auth\AuthController@login');

get('social/login/twitter', 'Auth\AuthController@logintwitter');
get('social/login/facebook', 'Auth\AuthController@loginfacebook');
//get('logout', 'Auth\AuthController@logout');


//get('login', 'Auth\AuthController@loginsocial');

//get('auth/login', 'Auth\AuthController@prelogin');

Route::get('contact', ['as' => 'contact', 'uses' => 'AboutController@create']);
Route::post('contact', ['as' => 'contact_store', 'uses' => 'AboutController@store']);


/*
|--------------------------------------------------------------------------
| Stories Routes
|--------------------------------------------------------------------------
|
| We define the routes that have to do with stories here
|
*/

Route::resource('stories', 'StoriesController');


/*
|--------------------------------------------------------------------------
| Captions Routes
|--------------------------------------------------------------------------
|
| We define the routes that have to do with captions here
|
*/
Route::resource('captions', 'CaptionsController');

/*
 * 
 * 
 * /*
|--------------------------------------------------------------------------
| Brands Routes
|--------------------------------------------------------------------------
|
| We define the routes that have to do with captions here
|
*/
Route::resource('brands', 'BrandsController');

/*
|--------------------------------------------------------------------------
| Comments Routes
|--------------------------------------------------------------------------
|
| We define the routes that have to do with comments here
|
*/
Route::resource('comments', 'CommentsController');

//Route::get('captions/{$id}', 'CommentsController@storecapt');
//Route::post('captions/{$id}', 'CommentsController@storecapt');

/*
|--------------------------------------------------------------------------
| Reposts Routes
|--------------------------------------------------------------------------
|
| We define the routes that have to do with reposts here
|
*/
Route::resource('reposts', 'RepostsController');

//Route::get('stories/{$id}', 'RepostsController@store');

//Route::get('/stories/$story->id/edit', 'StoriesController@postcreate');


/*
|--------------------------------------------------------------------------
| Likes Routes
|--------------------------------------------------------------------------
|
| We define the routes that have to do with reposts here
| 
Route::get('/', 'LikesController@index');
Route::post('like', 'LikesController@like');
Route::post('unlike', 'LikesController@unlike');
* */
Route::resource('likes', 'LikesController');


/*
|--------------------------------------------------------------------------
| Socialite Routes
|--------------------------------------------------------------------------
|
| We define the routes that have to do with socialite here
| 

* */
//Route::get('login/{provider?}', 'Auth\AuthController@login');




//Route::get('imagetest', 'StoriesController@imagetest');

Route::get('verify/{activation_code}', 'Auth\AuthController@confirmEmail');
//Route::get('verify/{activation_code}', 'RegistrationController@confirmEmail');
//Route::post('auth/login', 'Auth\AuthController@login');
//Route::get('verify/{activation_code}', 'Registrar@confirmEmail');

//Route::get('verify', 'Auth\AuthController@login');
/*
|--------------------------------------------------------------------------
| Mail Test
|--------------------------------------------------------------------------
|
| We define the routes that have to do with mandrill mails here
| 

* */
Route::get('mailing', function()
	{
		
		Mail::send('emails.test', [], function($message)
			{
				$message->to('olatundeopaleye@gmail.com')->subject('Laracasts Email');
			});
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| We define the routes that have to do with mandrill mails here
| 

* */

Route::group(['prefix' => 'admin', 'namespace' => 'admin'], function()
{
Route::resource('user', 'UserController');
});

Route::group(['prefix' => 'admin', 'namespace' => 'admin'], function()
{
	Route::resource('Category', 'CategoryController');
	Route::resource('user', 'UserController');
});

