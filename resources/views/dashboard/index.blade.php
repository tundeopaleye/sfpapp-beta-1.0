@extends('layouts.master')

@section('content')

<!--<h1>Latest Stories</h1>-->

<h1>Dashboard</h1>
<br>

<div class="col-md-4 col-sm-12">
	@if ($stories->count() > 0)
	Number of Brand Stories: {{$stories->count()}}
	@foreach ($stories as $story)
	<ul>
	<li><b>{{ $story->title }}</b> [edit | view | delete]</li>
 </ul>
 @endforeach
 @else
 <p>
 You haven't created any brand stories.
 
 </p>
 @endif
</div>	

<div class="col-md-4 col-sm-12">
	@if ($captions->count() > 0)
	Number of Brand Stories: {{$captions->count()}}
	@foreach ($captions as $caption)
	<ul>
	<li><b>{{ $caption->title }}</b> [edit | view | delete]</li>
 </ul>
 @endforeach
 @else
 <p>
 You haven't created any brand stories.
 
 </p>
 @endif
</div>	

<div class="col-md-4 col-sm-12">
	@if ($brands->count() > 0)
	Number of Brand Stories: {{$brands->count()}}
	@foreach ($brands as $brand)
	<ul>
	<li><b>{{ $brand->title }}</b> [edit | view | delete]</li>
 </ul>
 @endforeach
 @else
 <p>
 You haven't created any brand stories.
 
 </p>
 @endif
</div>		

			
 @stop