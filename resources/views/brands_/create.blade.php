@extends('layouts.master')

@section('content')

<h1>Create a New Brand Story</h1>

<ul>
@foreach($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>

{!! Form::open(array('route' => 'brands.store', 'files' => true, 'class' => 'form')) !!}

<div class="form-group">
{!! Form::label('Title') !!}
{!! Form::text('title', null,
array('required', 'class'=>'form-control',
'placeholder'=>'San Juan Vacation')) !!}
</div>




<div class="form-group">
{!! Form::label('thumbnail', 'Picture') !!}
{!! Form::file('thumbnail') !!}
</div>

<div class="form-group">
{!! Form::label('Brand') !!}
{!! Form::textarea('brand', null,
array('required', 'class'=>'form-control',
'placeholder'=>'Brand Narratives')) !!}
</div>

<div class="form-group">
{!! Form::label('Categories') !!}
{!! Form::select('categories', $categories, null,
array('multiple'=>'multiple','name'=>'categories[]')) !!}
</div>

<div class="form-group">
{!! Form::submit('Create Brand Story', array('class'=>'btn btn-primary')) !!}
</div>
{!! Form::close() !!}

 @stop