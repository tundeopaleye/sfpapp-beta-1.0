@extends('layouts.master')

@section('content')

<!--<h1>Latest Stories</h1>-->

<!--<div class="row">-->
	
	
	
	
	<div class="row clearfix">

				
				<!--<div class="col-md-3 col-sm-6">-->	
				@foreach(array_chunk($stories->all(), 4) as $row)

				<div class="row">

				@foreach($row as $story)	
				
				<div id="grid" class="col-md-3 col-sm-6"padding-bottom: 3em;"> 
  				<br><br>
	            <p class="orange"><h3>{{ $story->title }}</h3></p>
	           <h5 style="color: #f57f20;">Written by: {{ $story->user->name }}<b></b></h5>
	            <p><div style="height:10em; overflow: hidden; border:3px solid #f57f20; "><a href="/stories/{{$story->id}}">{!!HTML::image("thumbnails/$story->thumbnail",'', array('width'=>'100%','height'=>'auto')) !!}</a></div></p>
	            <p>{{ str_limit($story->story, $limit = 250, $end = '...') }}</p>
	
	            <span style="color:#f57f20;"> {{ $story->reposts->count() }} Retells</span> | <span style="color:#f57f20;">{{ $story->comments->count() }} Comment(s)</span> | {{ $story->likes->count() }} likes<br>
	            <a href="/stories/{{$story->id}}">Read Full Story</a> 
	            </div>
	        	
	        @endforeach

	</div>

@endforeach
	        
	        {!! $stories->render() !!}
			</div><!-- /.row -->
			
 @stop