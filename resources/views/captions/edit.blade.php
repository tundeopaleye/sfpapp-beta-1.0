@extends('layouts.master')

@section('content')

<h3>Update Story</h3>

<h5><a href="/captions/{{$caption->id}}">View Caption</a></h5>

<ul>
@foreach($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>

{!! Form::model($caption, array('method' => 'put', 'route' => ['captions.update', $caption->id], 'files' => true, 'class' => 'form')) !!}


<div style="height:30em; overflow: hidden;" align="center">{!!HTML::image("https://sfpapp.s3.amazonaws.com/images/$caption->thumbnail",'', array('width'=>'auto','height'=>'100%')) !!}</div>

<div class="form-group">
{!! Form::label('Title') !!}
{!! Form::text('title', null,
array('required', 'class'=>'form-control',
'placeholder'=>'San Juan Vacation')) !!}
</div>

{!! Form::hidden('user_id', $caption->user_id) !!}
{!! Form::hidden('thumbnail', $caption->thumbnail) !!}


<!--<div class="form-group">
{!! Form::label('thumbnail', 'Picture') !!}
{!! Form::file('thumbnail') !!}
</div>-->

<div class="form-group">
{!! Form::label('Caption') !!}
{!! Form::textarea('caption', null,
array('required', 'class'=>'form-control',
'placeholder'=>'Things to do before leaving for vacation')) !!}
</div>

<div>
{!! Form::label('Categories') !!}
{!! Form::select('categories', $categories, $caption->categories->lists('id'),
array('multiple'=>'multiple','name'=>'categories[]')) !!}
</div>

<div class="form-group">
{!! Form::submit('Update Caption', array('class'=>'btn btn-primary')) !!}
</div>

{!! Form::close() !!}

{!! Form::open(array('route' => array('captions.destroy', $caption->id), 'method' => 'delete')) !!}
<button type="submit">Delete Caption</button>
{!! Form::close() !!}

<script type="text/javascript">
  $('select').select2();
</script>

 @stop