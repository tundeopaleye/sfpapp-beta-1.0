@extends('layouts.master')

@section('content')

<h3>Update Story</h3>

<h5><a href="/stories/{{$story->id}}">View Story</a></h5>

<ul>
@foreach($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>

{!! Form::model($story, array('method' => 'put', 'route' => ['stories.update', $story->id], 'files' => true, 'class' => 'form')) !!}


<div style="height:30em; overflow: hidden;" align="center">{!!HTML::image("images/$story->thumbnail",'', array('width'=>'auto','height'=>'100%')) !!}</div>

<div class="form-group">
{!! Form::label('Title') !!}
{!! Form::text('title', null,
array('required', 'class'=>'form-control',
'placeholder'=>'San Juan Vacation')) !!}
</div>

{!! Form::hidden('user_id', $story->user_id) !!}

{!! Form::hidden('thumbnail', $story->thumbnail) !!}


<!--<div class="form-group">
{!! Form::label('thumbnail', 'Picture') !!}
{!! Form::file('thumbnail') !!}
</div>-->

<div class="form-group">
{!! Form::label('Story') !!}
{!! Form::textarea('story', null,
array('required', 'class'=>'form-control',
'placeholder'=>'Things to do before leaving for vacation')) !!}
</div>


<div class="form-group">
{!! Form::submit('Update Story', array('class'=>'btn btn-primary')) !!}
</div>
{!! Form::close() !!}

{!! Form::open(array('route' => array('stories.destroy', $story->id), 'method' => 'delete')) !!}
<button type="submit">Delete Story</button>
{!! Form::close() !!}

 @stop