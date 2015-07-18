@extends('layouts.master')

@section('content')

<h3>Update Brand Story</h3>

<h5><a href="/brands/{{$brand->id}}">View Story</a></h5>

<ul>
@foreach($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>

{!! Form::model($brand, array('method' => 'put', 'route' => ['brands.update', $brand->id], 'files' => true, 'class' => 'form')) !!}


<div style="height:30em; overflow: hidden;" align="center">{!!HTML::image("https://sfpapp.s3.amazonaws.com/images/$brand->thumbnail",'', array('width'=>'auto','height'=>'100%')) !!}</div>

<div class="form-group">
{!! Form::label('Title') !!}
{!! Form::text('title', null,
array('required', 'class'=>'form-control',
'placeholder'=>'San Juan Vacation')) !!}
</div>

{!! Form::hidden('user_id', $brand->user_id) !!}

{!! Form::hidden('thumbnail', $brand->thumbnail) !!}


<!--<div class="form-group">
{!! Form::label('thumbnail', 'Picture') !!}
{!! Form::file('thumbnail') !!}
</div>-->

<div class="form-group">
{!! Form::label('Brand') !!}
{!! Form::textarea('brand', null,
array('required', 'class'=>'form-control',
'placeholder'=>'Things to do before leaving for vacation')) !!}
</div>


<div>
{!! Form::label('Categories') !!}
{!! Form::select('categories', $categories, $brand->categories->lists('id'),
array('multiple'=>'multiple','name'=>'categories[]')) !!}
</div>


<div class="form-group">
{!! Form::submit('Update Brand', array('class'=>'btn btn-primary')) !!}
</div>
{!! Form::close() !!}

{!! Form::open(array('route' => array('brands.destroy', $brand->id), 'method' => 'delete')) !!}
<button type="submit">Delete Brand Story</button>
{!! Form::close() !!}

<script type="text/javascript">
  $('select').select2();
</script>

 @stop