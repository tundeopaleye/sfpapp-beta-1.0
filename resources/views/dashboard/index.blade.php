@extends('layouts.master')

@section('content')

<!--<h1>Latest Stories</h1>-->


	

			@if ($liststories->count() > 0)
			supposed to work since it reads liststories->count
			<ul>
			@foreach($liststories as $story)
			<li>{{ $story->title }} xx</li>
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
	Number of Retold Brand Stories: 
	<br><br>
	

			
	Recent Brand Stories Told	
 @stop