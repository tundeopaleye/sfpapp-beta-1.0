@extends('layouts.master')

@section('content')

<!--<h1>Latest Stories</h1>-->

<!--<div class="row">-->
	
<title>Brand Stories - Pictolit</title>	
	
	
	<div class="row clearfix">

				
				<!--<div class="col-md-3 col-sm-6">-->	
				@foreach(array_chunk($brands->all(), 4) as $row)

				<div class="row">

				@foreach($row as $brand)	
				
				<div id="grid" class="col-md-3 col-sm-6"padding-bottom: 3em;"> 
  				<br><br>
	            <p class="orange"><h3>{{ $brand->title }}</h3></p>
	           <h5 style="color: #ff8a00;">Written by: <a href="/users/{{ $brand->user->name }}">{{ $brand->user->name }}</a></h5>
	           
	           
	            <p><div style="height:10em; overflow: hidden; border:3px solid #ff8a00; "><a href="/brands/{{$brand->id}}">{!!HTML::image("https://sfpapp.s3.amazonaws.com/thumbnails/$brand->thumbnail",'', array('width'=>'100%','height'=>'auto')) !!}</a></div></p>
	            <p>{{ str_limit($brand->brand, $limit = 250, $end = '...') }}</p>
	
	            <span style="color:#ff8a00;"> {{ $brand->reposts->count() }} Retells</span> | <span style="color:#ff8a00;">{{ $brand->comments->count() }} Comment(s)</span> | {{ $brand->likes->count() }} likes<br>
	            <a href="/brands/{{$brand->id}}">Read Full Brand Story</a> 
	            </div>
	        	
	        @endforeach

	</div>

@endforeach
	        
	        {!! $brands->render() !!}
			</div><!-- /.row -->
			
 @stop