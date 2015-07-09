@extends('layouts.master')

@section('content')

<!--<h1>Latest Stories</h1>-->

<h1>Dashboard</h1>
<br>
	Stories Told: {{ $story->where('user_id', Auth::user()->id)->count() }}
	<br><br>
	Number of Story Retells: 
 {{App\Repost::where('repostable_type', 'App\Story')->where('user_id', Auth::user()->id)->count()}} 
 <br><br>
	Pictures Captioned: {{ $caption->where('user_id', Auth::user()->id)->count() }}
	<br><br>
	
	Number of ReCaptions: {{App\Repost::where('repostable_type', 'App\Caption')->where('user_id', Auth::user()->id)->count()}} 
	<br><br>
	Brand Stories Told: {{ $brand->where('user_id', Auth::user()->id)->count() }}	
	<br><br><br>
	Recent Stories Told	
	<br><br>
	

			@if ($liststories->count() > 0)
			<ul>
			@foreach($liststories as $story)
			<li>{{ $story->title }}</li>
			@endforeach
			</ul>
			@endif
	       
	        
	Recent Captions Told<br>
	@if ($listcaptions->count() > 0)
			<ul>
			@foreach($listcaptions as $caption)
			<li>{{ $caption->title }}</li>
			@endforeach
			</ul>
			@endif
	<br><br>
	Number of Retold Brand Stories: {{App\Repost::where('repostable_type', 'App\Brand')->where('user_id', Auth::user()->id)->count()}} 
	
	<br><br>
	

			
	Recent Brand Stories Told	
 @stop