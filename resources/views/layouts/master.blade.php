<body>
	<head>
		<link href='http://fonts.googleapis.com/css?family=Lekton' rel='stylesheet' type='text/css'>
		<link rel="icon" href="https://sfpapp.s3.amazonaws.com/images/fav.png" type="image/png" sizes="16x16">
			
		<meta property="og:title" content="Stories From Pictures" />
		<meta property="og:description" content="Stories From Pictures" />
		<!--<meta property="og:image" content="thumbnail_image" />-->
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
        <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
  
        <!-- Optional theme -->
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">
  
        <!-- Latest compiled and minified JavaScript -->
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
  
        <link href="/assets/styles.css" rel="stylesheet"/>
        
        <link href="/css/socialcount.css" rel="stylesheet"/>
        <link href="/css/socialcount-with-icons.css" rel="stylesheet"/>
  
        <link rel="stylesheet" href="/assets/ladda/dist/ladda-themeless.min.css">
        <script src="/assets/ladda/dist/spin.min.js"></script>
        <script src="/assets/ladda/dist/ladda.min.js"></script>
        
        <script src="/js/socialcount.js"></script>
        
        <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
		<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
		
		<link href='http://fonts.googleapis.com/css?family=Special+Elite' rel='stylesheet' type='text/css'>
		
	 <link rel="stylesheet" type="text/css" href="/assets/css/jquery.atwho.min.css">
         <!-- Requirements -->
        
        <script src="/assets/js/jquery.atwho.min.js"></script>
        <script src="/assets/js/jquery.caret.min.js"></script>
        <!-- Laravel Mentions -->
        @include('mentions::assets')

<style type="text/css" >
.col-1-4 {
    float: left;
    width: 25%;
   
  }
  
  .imgwidth{
  	height: 15em;
  }
  
  .verdana{
  	font-family:Verdana, Geneva, Arial, Helvetica, sans-serif;
  }
  


.elitefont{
	font-family: 'Special Elite', cursive;
}

 
 
 body{ 
font-family: 'Special Elite', cursive;

background-color: #fbfcfc
} 


@media (min-width: 1900px){
   .collapse {
       display: none !important;
   }
}
  
  </style>
  
  <link rel="stylesheet" href="dist/ladda.min.css">
  
</head>

<div style="background:#eeeeee; padding:1em; margin-bottom: 1.5em;">
	<div align="right">
		@if (Auth::check())
			Welcome, <b>{{ Auth::user()->name }}!</b>
			@else
			Hello, stranger! <a href="/login">Login</a> or <a href="/register">
				Register</a> | <a href="/social/login/twitter">Login in with Twitter</a> | <a href="/social/login/facebook">Login in with Facebook</a>
		@endif
		
	</div>
	
</div>

<div class="container">
		
	<div align="center"><a href="/">{!!HTML::image("https://sfpapp.s3.amazonaws.com/images/pictolit4p.png",'', array('width'=>'auto','height'=>'auto')) !!}</a></div>
	
	<hr>
	
	@if (!Auth::check())
			
		@include('layouts.partials.mainnavout')
		
	@else
	
		@include('layouts.partials.mainnav')
			
	@endif	
	
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

<div class="col-md-12" style="background-color: #000; color: #fff; padding:1em; font-size: 10px; margin-top:1em;" align="center">
	&copy; 2015 Pictolit - All Rights Reserved 

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