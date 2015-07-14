@extends('app')

@section('content')
<div class="container">
	
	<div class="row">
		@include('layouts.partials.mainnav')
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Home</div>

				<div class="panel-body">
					You are logged in!
					
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
