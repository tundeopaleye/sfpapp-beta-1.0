@extends('layouts.master')

@section('content')


	
<!--<title>Brand Stories - Stories from Pictures</title>-->	
	
	
	<div class="row clearfix">

	<title>Categories - Stories from Pictures</title>

<h1>Category: {{$category->name}}</h1>
<br>
<div class="col-md-4 col-sm-12">
	<h4>Stories</h4>
	@if($category->stories->count() > 0)
	@foreach($stories as $story)
	<ul>
	
	<li><a href="/stories/{{$story->id}}">{{$story->title}}</a></li>
	
	</ul>
	@endforeach
	@else
	There are no captions in this category yet
	@endif
</div>	

<div class="col-md-4 col-sm-12">
	<h4>Captions</h4>
	@if($category->captions->count() > 0)
	@foreach($captions as $caption)
	<ul>
	
	<li><a href="/captions/{{$caption->id}}">{{$caption->title}}</a></li>
	
	</ul>
	@endforeach
	@else
	There are no captions in this category yet
	@endif
</div>		

<div class="col-md-4 col-sm-12">
	<h4>Brand Stories</h4>
	@if($category->brands->count() > 0)
	@foreach($brands as $brand)
	<ul>
	
	<li><a href="/brands/{{$brand->id}}">{{$brand->title}}</a></li>
	
	</ul>
	@endforeach
	@else
	There are no captions in this category yet
	@endif
</div>	


	
	</div><!-- /.row -->
			
 @stop