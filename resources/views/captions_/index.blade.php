@extends('layouts.master')

@section('content')

<!--<h1>Latest Stories</h1>-->

<!--<div class="row">-->
	
	
	
	
	<div class="row clearfix">

				@foreach(array_chunk($captions->all(), 4) as $row)

				<div class="row">

				@foreach($row as $caption)	
				
				<div id="grid" class="col-md-3 col-sm-6"padding-bottom: 3em;"> 
  				<br><br>
	            <p class="orange"><h3>{{ $caption->title }}</h3></p>
	           <h5 style="color: #f57f20;">Written by: {{ $caption->user->name }}<b></b></h5>
	            <p><div style="height:10em; overflow: hidden; border:3px solid #f57f20; "><a href="/captions/{{$caption->id}}">{!!HTML::image("thumbnails/$caption->thumbnail",'', array('width'=>'100%','height'=>'auto')) !!}</a></div></p>
	            <p style="background-color:#000; color:#fff; font-weight: bold; padding:1em; margin-top:-0.7em;">{{ str_limit($caption->caption, $limit = 250, $end = '...') }}</p>
	
	            <span style="color:#f57f20;"> {{ $caption->reposts->count() }} Retells</span> | <span style="color:#f57f20;">{{ $caption->comments->count() }} Comment(s)</span> | {{ $caption->likes->count() }} likes<br>
	            <a href="/captions/{{$caption->id}}">Read Full Caption</a> 
	            </div>
	        	
	        @endforeach

	</div>

@endforeach
	        
	        {!! $captions->render() !!}
			</div><!-- /.row -->
			
 @stop