<body>
	<head>
	<!--<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
<script src="http://code.jquery.com/jquery.js"></script>

<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>-->

<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
        <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
  
        <!-- Optional theme -->
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">
  
        <!-- Latest compiled and minified JavaScript -->
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
  
        <link href="/assets/styles.css" rel="stylesheet"/>
  
        <link rel="stylesheet" href="/assets/ladda/dist/ladda-themeless.min.css">
        <script src="/assets/ladda/dist/spin.min.js"></script>
        <script src="/assets/ladda/dist/ladda.min.js"></script>
        
        <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
		<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>

<style type="text/css" >
.col-1-4 {
    float: left;
    width: 25%;
   
  }
  
  .imgwidth{
  	height: 15em;
  }
 

  
  </style>
  
  <link rel="stylesheet" href="dist/ladda.min.css">
  
</head>

<div style="background:#f57f20; padding:1em; margin-bottom: 1.5em;">
	<div align="right">
		@if (Auth::check())
			Welcome, <b>{{ Auth::user()->name }}!</b>
			@else
			Hello, stranger! <a href="/login">Login</a> or <a href="/register">
				Register</a> | <a href="/social/login/twitter">Login in with Twitter</a> <a href="/social/login/facebook">Login in with Facebook</a>
		@endif
		
	</div>
	
</div>

<div class="container">
		
	<div align="center">{!!HTML::image("images/logo1.png",'', array('width'=>'auto','height'=>'auto')) !!}</div>
	
	<hr>
	
	@include('layouts.partials.mainnav')
	
	<hr>
	
	@if (Session::has('flash_message'))
	<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;<button>	
		{{ Session::get('flash_message') }}
	</div>
	@endif
	
<ul>
@foreach($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>

<div class="col-md-12">
@yield('content')
</div>

<div class="col-md-12" style="background-color: #000; color: #fff; padding:1em; font-size: 10px;" align="center">
	&copy; 2015 Stories From Pictures - All Rights Reserved 

</div>
<!--<div class="col-md-3">
@section('advertisement')
<p>
Jamz and Sun Lotion Special $29!
</p>
@show
</div>-->


<!--<div style="background:#333333; padding:8em; margin-top: 1.5em; margin-bottom: 5em;"></div>-->
</div>

<script>
	$('div.alert').not('.alert-important').delay(3000).slideUp
</script>
</body>