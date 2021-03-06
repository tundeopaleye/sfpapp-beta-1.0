@extends('layouts.master2')



@section('content')

<title>Pictolit Home</title>	
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
        	<!--	<div class="col-sm-12"> </div>-->
				<h3><span style="color:#ff8a00;" >It's Fiction on Fleek!</span></h3>
				<h4><span style=" line-height:1.5em; font-weight:bold;">Just Upload a Picture, Add a Title and tell your Story or Caption it! Brands too can let their Customers tell their story.</span></h4>
			
        	<!--	<div align="center"><h3>Register/Login</h3></div> -->
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
								<div><a href="http://localhost:8000/social/login/twitter">Twitter Login</a> | <a href="http://localhost:8000/social/login/facebook">Facebook Login</a></div>
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
        	</div>
        	<div class="col-md-4 col-sm-12">
        		<div align="center"><h3>Featured Story</h3></div>
        		
<!--	<div id="grid" class="col-md-12 col-sm-12"> -->
  			
	           <h3 style="color: #ff8a00;">{{$story->title}}</h3>
	           <h5 style="color: #000;">Told by: {{ $story->user->name }}</h5>
	            <p><div style="height:12em; overflow: hidden; border:3px solid #eee; "><a href="/stories/{{$story->id}}">{!!HTML::image("https://sfpapp.s3.amazonaws.com/thumbnails/$story->thumbnail",'', array('width'=>'100%','height'=>'auto')) !!}</a></div></p>
	            <p style="background-color:#eee; color:#000; font-weight: bold; padding:1em; margin-top:-0.7em; font-size: 1em;">{{ str_limit($story->story, $limit = 250, $end = '...') }}</p>
				<a href="/captions/{{$caption->id}}">See Full Story</a>
				<br><br>
				<!-- </div> -->
	            
	            





        	</div>
        	
        	<div class="col-md-4 col-sm-12">
        		<div align="center"><h3>Featured Brand Story</h3></div>
        		
        		<div id="grid" class="col-md-12 col-sm-12"padding-bottom: 3em;"> 
				<h3 style="color: #ff8a00;">{{$brand->title}}</h3>
				<h5 style="color: #000;">Told by: {{ $brand->user->name }}</h5>
				<p><div style="height:12em; overflow: hidden; border:3px solid #ff8a00; "><a href="/brands/{{$brand->id}}">{!!HTML::image("https://sfpapp.s3.amazonaws.com/thumbnails/$brand->thumbnail",'', array('width'=>'100%','height'=>'auto')) !!}</a></div></p>
				<p style="background-color:#ff8a00; color:#fff; padding:1em; margin-top:-0.7em; font-size: 1em;">{{ str_limit($brand->brand, $limit = 250, $end = '...') }}</p>
				<a href="/brands/{{$brand->id}}">See Full Brand Story</a> 
				</div>	
        		
        		</div>
        	
        	
        	
        </div>
        

    
    <script type="text/javascript" src="../js/jquery-1.9.0.min.js"></script>
    <script type="text/javascript" src="../js/jquery.nivo.slider.js"></script>
    <script type="text/javascript">
    $(window).load(function() {
        $('#slider').nivoSlider(
        	{   
    prevText: '<img src="https://sfpapp.s3.amazonaws.com/images/left-arrow2.png">',                 // Prev directionNav text
    nextText: '<img src="https://sfpapp.s3.amazonaws.com/images/right-arrow2.png">',                 // Next directionNav text    
}
        );
    });
    
    
   
    </script>	
	
	
	
			
			
 @stop