@extends('layouts.master')

@section('content')

<!--<h1>Latest Stories</h1>-->

<h1>Dashboard</h1>
<br>
	Stories Told: {{ $story->where('user_id', Auth::user()->id)->count() }}
	<br><br>
	Number of Retold Stories: {{ $repost->where('user_id', Auth::user()->id)->where('repostable_type', 'App\Story')->count() }}
	<br><br>
	Pictures Captioned: {{ $caption->where('user_id', Auth::user()->id)->count() }}
	<br><br>
	Brand Stories Told: {{ $brand->where('user_id', Auth::user()->id)->count() }}	
	<br><br><br>
	Recent Stories Told	
	<br><br>
	Recent Captions Told
	<br><br>
	Recent Brand Stories Told	
 @stop