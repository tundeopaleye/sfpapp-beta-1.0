@extends('layouts.master')

@section('content')

<h1>Create a New Story</h1>

<ul>
@foreach($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>

{!! Form::open(array('route' => 'stories.store', 'files' => true, 'class' => 'form')) !!}

<div class="form-group">
{!! Form::label('Title') !!}
{!! Form::text('title', null,
array('required', 'class'=>'form-control',
'placeholder'=>'Story Story')) !!}
</div>




<div class="form-group">
{!! Form::label('thumbnail', 'Picture') !!}
{!! Form::file('thumbnail') !!}
</div>

<!--<div class="form-group">
{!! Form::label('Story') !!}
{!! Form::textarea('story', null,
array('required', 'class'=>'form-control',
'placeholder'=>'Once Upon a Time')) !!}
</div>
-->
<div class="form-group" class="form-group">
	Story<br>
	{!! mention()->asTextArea('story', old('story'), 'users', 'name', 'form-control') !!} <!---->
</div>

<div class="form-group">
{!! Form::label('Categories') !!}
{!! Form::select('categories', $categories, null,
array('multiple'=>'multiple','name'=>'categories[]')) !!}
</div>

<div class="form-group">
{!! Form::submit('Create Story', array('class'=>'btn btn-primary')) !!}
</div>
{!! Form::close() !!}

<script type="text/javascript">
  $('select').select2();
</script>

 @stop