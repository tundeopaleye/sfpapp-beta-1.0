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

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

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
|--------------------------------------------------------------------------
| Comments Routes
|--------------------------------------------------------------------------
|
| We define the routes that have to do with comments here
|
*/
Route::resource('comments', 'CommentsController');

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
Route::get('login/{provider?}', 'Auth\AuthController@login');


Route::get('imagetest', 'StoriesController@imagetest');


