@extends('layouts.master')

@section('content')

<h1>Delete Story</h1>

<ul>
@foreach($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>


{!! Form::open(array('route' => array('stories.destroy', $story->id), 'method' => 'delete')) !!}
<button type="submit">Delete Story</button>
{!! Form::close() !!}

 @stop
