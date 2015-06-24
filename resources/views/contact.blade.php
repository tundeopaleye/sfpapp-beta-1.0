<html>
	<head>
		<title>Laravel</title>
		
		<link href='//fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>

		<style>
			body {
				margin: 0;
				padding: 0;
				width: 100%;
				height: 100%;
				color: #B0BEC5;
				display: table;
				font-weight: 100;
				font-family: 'Lato';
			}

			.container {
				text-align: center;
				display: table-cell;
				vertical-align: middle;
			}

			.content {
				text-align: center;
				display: inline-block;
			}

			.title {
				font-size: 96px;
				margin-bottom: 40px;
			}

			.quote {
				font-size: 24px;
			}
		</style>
	</head>
	<body>
		<div class="container">
			<div class="content">
@if(Session::has('message'))
<div class="alert alert-info">
{{ Session::get('message') }}
</div>
@endif
				<div class="title">Contact</div>
				




<h1>Contact TODOParrot</h1>

<ul>
@foreach($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>

{!! Form::open(array('route' => 'contact_store', 'class' => 'form')) !!}				
				<div class="form-group">
{!! Form::label('Your Name') !!}
{!! Form::text('name', null, array('required', 'class'=>'form-control', 'placeholder'=>'Your name')) !!}
</div>

<div class="form-group">
{!! Form::label('Your E-mail Address') !!}
{!! Form::text('email', null, array('required', 'class'=>'form-control', 'placeholder'=>'Your e-mail address')) !!}
</div>

<div class="form-group">
{!! Form::label('Your Message') !!}
{!! Form::textarea('message', null, array('required', 'class'=>'form-control', 'placeholder'=>'Your message')) !!}
</div>

<div class="form-group">
{!! Form::submit('Contact Us!', array('class'=>'btn btn-primary')) !!}
</div>
Chapter 5. Forms Integration 144
{!! Form::close() !!}
</p>
			</div>
		</div>
	</body>
</html>
