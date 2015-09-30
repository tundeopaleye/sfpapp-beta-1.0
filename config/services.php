<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Third Party Services
	|--------------------------------------------------------------------------
	|
	| This file is for storing the credentials for third party services such
	| as Stripe, Mailgun, Mandrill, and others. This file provides a sane
	| default location for this type of information, allowing packages
	| to have a conventional place to find your various credentials.
	|
	*/

	'mailgun' => [
		'domain' => '',
		'secret' => '',
	],

	/*'mandrill' => [
		'secret' => env('MAIL_PASSWORD'),
	],*/
	
	'mandrill' => [
		'secret' => 'MNri8RjEXwuuudwbmD5pjBnfTR5FHxZP',
	],

	'ses' => [
		'key' => '',
		'secret' => '',
		'region' => 'us-east-1',
	],

	'stripe' => [
		'model'  => 'User',
		'secret' => '',
	],
	
	
	'twitter' => [
	'client_id' => env('TWITTER_CLIENT_ID'),
	'client_secret' => env('TWITTER_CLIENT_SECRET'),
	'redirect' => 'http://pictolit.com/social/login/twitter', //revert to sfpapp.com?
	],
	
	'facebook' => [
	'client_id' => env('FACEBOOK_CLIENT_ID'),
	'client_secret' => env('FACEBOOK_CLIENT_SECRET'),
	'redirect' => 'http://pictolit.com/social/login/facebook',
	],
	
	'github' => [
	'client_id' => env('GITHUB_CLIENT_ID'),
	'client_secret' => env('GITHUB_CLIENT_SECRET'),
	'redirect' => 'http://sfpapp.com/social/login', //revert to sfpapp.com?GITHUB_CLIENT_SECRET
	],
	

];
