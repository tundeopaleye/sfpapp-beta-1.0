@extends('layouts.master')

@section('content')

<!--<h1>Latest Stories</h1>-->

<!--<div class="row">-->
	
	
	
	
	<div class="row clearfix">

			@foreach ($stories as $story)	
				<!--<div class="col-md-3 col-sm-6">-->	
					
						<div id="grid" class="col-md-3 col-sm-6" style="height: 20em; padding-bottom: 3em; margin-bottom:15em;">
  
  

										
				<br><br>
	            <p class="orange"><h3>{{ $story->title }}</h3></p>
	           <h5 style="color: #f57f20;">Written by: {{ $story->user->name }}<b></b></h5>
	            <p><div style="height:10em; overflow: hidden; border:3px solid #f57f20; "><a href="/stories/{{$story->id}}">{!!HTML::image("images/$story->thumbnail",'', array('width'=>'100%','height'=>'auto')) !!}</a></div></p>
	            
	           
	             <p>{{ str_limit($story->story, $limit = 250, $end = '...') }}</p>
	<!--              <div class="btn-toolbar">
 <div class="btn-group">
      <a href="#" class="btn btn-inverse disabled"><i class="icon-white icon-thumbs-up"></i></a>
       <a href="#" id="like_3" class="btn btn-success btn-md ladda-button ajax-like" data-style="slide-right" data-size="l"><span class="ladda-label">Like2</span></a>-->
      <!--<a href="#" class="btn btn-inverse disabled"><i class="icon-white icon-heart"></i></a>
      <a href="#" class="btn btn-inverse disabled"><i class="icon-white icon-share-alt"></i></a>
  </div>
 
</div>-->
	              <span style="color:#f57f20;"> {{ $story->reposts->count() }} Retells</span> | <span style="color:#f57f20;">{{ $story->comments->count() }} Comment(s)</span> | {{ $story->likes->count() }} likes<br>
	            <a href="/stories/{{$story->id}}">Read Story</a> | <a href="#">Retell Story</a> | <a href="#">Comment</a> | <a href="#">Like</a> <br>
	            </div>
	        	
	        @endforeach
	        
	        {!! $stories->render() !!}
			</div><!-- /.row -->
			
 @stop