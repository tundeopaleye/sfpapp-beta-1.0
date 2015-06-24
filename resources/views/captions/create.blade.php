@extends('layouts.master')

@section('content')

<h1>Create a New Caption</h1>

<ul>
@foreach($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>

{!! Form::open(array('route' => 'captions.store', 'files' => true, 'class' => 'form')) !!}

<div class="form-group">
{!! Form::label('Title') !!}
{!! Form::text('title', null,
array('required', 'class'=>'form-control',
'placeholder'=>'Caption Title')) !!}
</div>




<div class="form-group">
{!! Form::label('thumbnail', 'Picture') !!}
{!! Form::file('thumbnail') !!}
</div>

<div class="form-group">
{!! Form::label('Caption') !!}
{!! Form::textarea('caption', null,
array('required', 'class'=>'form-control',
'placeholder'=>'Creatively Captioned!')) !!}
</div>

<div class="form-group">
{!! Form::label('Categories') !!}
{!! Form::select('categories', $categories, null,
array('multiple'=>'multiple','name'=>'categories[]')) !!}
</div>

<div class="form-group">
{!! Form::submit('Create Caption', array('class'=>'btn btn-primary')) !!}
</div>
{!! Form::close() !!}

<script type="text/javascript">
  $('select').select2();
</script>

 @stop