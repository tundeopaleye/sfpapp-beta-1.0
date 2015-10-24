@extends('layouts.master')

@section('content')

<!--<h1>Latest Stories</h1>-->

<title>Stories - Pictolit</title>
	
	<div class="row clearfix">

	<title>Users - Pictlit</title>

<h1>{{$user->name}}</h1>
<br>

	<h4>Stories</h4>
	@if($user->stories->count() > 0)
	
	
	<div class="row clearfix">

				@foreach(array_chunk($user->stories->all(), 4) as $row)

				<div class="row">

				@foreach($row as $story)	
				
				<div id="grid" class="col-md-3 col-sm-6"padding-bottom: 3em;"> 
  				<br><br>
	            <p class="orange"><h3>{{ $story->title }}</h3></p>
	            <h5 style="color: #ff8a00;">Written by: <a href="/users/{{ $story->user->name }}">{{ $story->user->name }}</a><b></b></h5>
	            <p><div style="height:10em; overflow: hidden; border:3px solid #ff8a00; "><a href="/stories/{{$story->id}}">{!!HTML::image("https://sfpapp.s3.amazonaws.com/thumbnails/$story->thumbnail",'', array('width'=>'100%','height'=>'auto')) !!}</a></div></p>
	            <p>{{ str_limit($story->story, $limit = 250, $end = '...') }}</p>
	
	            <span style="color:#ff8a00;"> {{ $story->reposts->count() }} Retells</span> | <span style="color:#ff8a00;">{{ $story->comments->count() }} Comment(s)</span> | {{ $story->likes->count() }} likes<br>
	            <a href="/stories/{{$story->id}}">Read Full Story</a> 
	            </div>
	        	
	        @endforeach

	</div>
	
	test working

@endforeach
	        
	        
	       
	@else
	There are no stories for this user yet
	@endif
</div>	
			</div><!-- /.row -->
			
 @stop