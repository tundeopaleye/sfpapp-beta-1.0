@extends('layouts.master')

@section('content')

<!--<h1>Latest Stories</h1>-->

<title>Dashboard - Stories from Pictures</title>

<h1>Dashboard</h1>
<br>

<div class="col-md-4 col-sm-12">
	@if ($stories->count() > 0)
	<h2>{{$stories->count()}} </h2>Stories
	<br><br>
	@foreach ($stories as $story)
	<ul>
	<li><b>{{ $story->title }}</b> [<a href="/stories/{{$story->id}}/edit">edit</a> | <a href="/stories/{{$story->id}}">view</a> | delete]</li>
 </ul>
 @endforeach
 @else
 <p>
 You haven't created any stories.
 
 </p>
 @endif
</div>	

<div class="col-md-4 col-sm-12">
	@if ($captions->count() > 0)
	<h1>{{$captions->count()}}</h1><h3 style="margin-top:-10px;">Captions</h3>
	<br><br>
	@foreach ($captions as $caption)
	<ul>
	<li><b>{{ $caption->title }}</b> [<a href="/captions/{{$caption->id}}/edit">edit</a> | <a href="/captions/{{$caption->id}}">view</a> | delete]</li>
 </ul>
 @endforeach
 @else
 <p>
 You haven't created any captions.
 
 </p>
 @endif
</div>	

<div class="col-md-4 col-sm-12">
	@if ($brands->count() > 0)
	<h2>{{$brands->count()}} </h2>Brand Stories
	<br><br>
	@foreach ($brands as $brand)
	<ul>
	<li><b>{{ $brand->title }}</b> [<a href="/brands/{{$brand->id}}/edit">edit</a> | <a href="/brands/{{$brand->id}}">view</a> | delete]</li>
 </ul>
 @endforeach
 @else
 <p>
 You haven't created any brand stories.
 
 </p>
 @endif
</div>		

			
 @stop