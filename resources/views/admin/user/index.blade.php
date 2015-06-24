@extends('layouts.master')

@section('content')

<!--<h1>Latest Stories</h1>-->

<!--<div class="row">-->
	
	
	
	
	<div class="row clearfix">
		
		<h1>Registered Users</h1>

<ul>
@forelse ($users as $user)

<li>{{ $user->name }} ({{ $user->email }})</li>
@empty
<li>No registered users</li>
@endforelse
</ul>

				
				
			</div><!-- /.row -->
			
 @stop