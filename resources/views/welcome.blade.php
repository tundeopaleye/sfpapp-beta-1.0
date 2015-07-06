@extends('layouts.master2')



@section('content')

<title>Stories From Pictures Home</title>	
<div id="wrapper">
      
        <div class="slider-wrapper theme-default">
            <div id="slider" class="nivoSlider">
                <img src="images/sfpbanner1.jpg" data-thumb="images/sfpbanner1.jpg" alt="" data-transition="fade" />
                <img src="images/sfpbanner2.jpg" data-thumb="images/sfpbanner2.jpg" alt="" data-transition="fade" />
                <img src="images/sfpbanner3b.jpg" data-thumb="images/sfpbanner3b.jpg" alt="" data-transition="fade" />
            </div>
           <!-- <div id="htmlcaption" class="nivo-html-caption">
                <strong>This</strong> is an example of a <em>HTML</em> caption with <a href="#">a link</a>. 
           </div>-->
        </div>
        
        <div>
        	<div class="col-md-4 col-sm-12">
        		<div align="center"><h3>Register/Login</h3></div>
        		<div>
        			<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div align="center"><a href="../register">Register as a new user</a></div>
			<div class="panel panel-default">
				
				<div class="panel-heading">Login</div>
				<div class="panel-body">
					@if (Session::has('flash_message'))
						<div class="alert alert-success">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;<button>	
								{{ Session::get('flash_message') }}
						</div>
					@endif
					
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					<form class="form-horizontal" role="form" method="POST" action="{{ url('login') }}">
						
						<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
						<div class="form-group">
							<label class="col-md-4 control-label">E-Mail Address</label>
							<div class="col-md-6">
								<input type="email" class="form-control" name="email" value="{{ old('email') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Password</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<div class="checkbox">
									<label>
										<input type="checkbox" name="remember"> Remember Me
									</label>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">Login</button>

								<a class="btn btn-link" href="{{ url('/password/email') }}">Forgot Your Password?</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
        		</div>
        		</div>
        	
        	<div class="col-md-4 col-sm-12">
        		<div align="center"><h3>Featured Story and Caption</h3></div>
        		<div class="row clearfix">

				@foreach(array_chunk($stories->all(), 1) as $row)

				<div class="row">

				@foreach($row as $story)	
				
				<div id="grid" class="col-md-3 col-sm-6"padding-bottom: 3em;"> 
  				<br><br>
	            
	           <h5 style="color: #f57f20;">Captioned by: {{ $story->user->name }}</h5>
	            <p><div style="height:10em; overflow: hidden; border:3px solid #f57f20; "><a href="/stories/{{$story->id}}">{!!HTML::image("thumbnails/$story->thumbnail",'', array('width'=>'100%','height'=>'auto')) !!}</a></div></p>
	            <p style="background-color:#000; color:#fff; font-weight: bold; padding:1em; margin-top:-0.7em; font-size: 2em;">{{ str_limit($story->story, $limit = 50, $end = '...') }}</p>
	
	            <span style="color:#f57f20;"> {{ $story->reposts->count() }} Retells</span> | <span style="color:#f57f20;">{{ $story->comments->count() }} Comment(s)</span> | {{ $story->likes->count() }} likes<br>
	            <a href="/stories/{{$story->id}}">See Individual Story</a> 
	            </div>
	        	
	        @endforeach

	</div>

@endforeach
	        
	        {!! $stories->render() !!}
        		</div>
        	</div>
        	
        	<div class="col-md-4 col-sm-12"><div align="center"><h3>Featured Brand Story</h3></div></div>
        	
        	
        	
        </div>
        <!--<div class="col-md-12" style="background-color: #000; color: #fff; padding:1em; font-size: 10px;" align="center">
	&copy; 2015 Stories From Pictures - All Rights Reserved 

</div>-->

    </div>
    <script type="text/javascript" src="../js/jquery-1.9.0.min.js"></script>
    <script type="text/javascript" src="../js/jquery.nivo.slider.js"></script>
    <script type="text/javascript">
    $(window).load(function() {
        $('#slider').nivoSlider();
    });
    </script>	
	
	
	
			
			
 @stop