@extends('layouts.master')

@section('content')

<!--<h1>Latest Stories</h1>-->
<title>Captions - Stories from Pictures</title>
<!--<div class="row">-->
	
	
	
	
	<div class="row clearfix">

				@foreach(array_chunk($captions->all(), 4) as $row)

				<div class="row">

				@foreach($row as $caption)	
				
				<div id="grid" class="col-md-3 col-sm-6"padding-bottom: 3em;"> 
  				<br><br>
	            
	           <h5 style="color: #f57f20;">Captioned by: {{ $caption->user->name }}</h5>
	            <p><div style="height:10em; overflow: hidden; border:3px solid #f57f20; "><a href="/captions/{{$caption->id}}">{!!HTML::image("https://sfpapp.s3.amazonaws.com/thumbnails/$caption->thumbnail",'', array('width'=>'100%','height'=>'auto')) !!}</a></div></p>
	            <p style="background-color:#000; color:#fff; font-weight: bold; padding:1em; margin-top:-0.7em; font-size: 2em;">{{ str_limit($caption->caption, $limit = 250, $end = '...') }}</p>
	
	            <span style="color:#f57f20;"> {{ $caption->reposts->count() }} Retells</span> | <span style="color:#f57f20;">{{ $caption->comments->count() }} Comment(s)</span> | {{ $caption->likes->count() }} likes<br>
	            <a href="/captions/{{$caption->id}}">See Individual Caption</a> 
	            </div>
	        	
	        @endforeach

	</div>

@endforeach
	        
	        {!! $captions->render() !!}
			</div><!-- /.row -->
			
 @stop