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


<div style="height:30em; overflow: hidden;" align="center">{!!HTML::image("https://sfpapp.s3.amazonaws.com/images/$story->thumbnail",'', array('width'=>'auto','height'=>'100%')) !!}</div>

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
</div>
For Mentions
<div class="form-group">
{!! Form::label('Story') !!}
{!! Form::textarea('story', null,
array('required', 'class'=>'form-control',
'placeholder'=>'Story, story? Story! Once upon a time...')) !!}
</div>
-->
<div class="form-group" class="form-group">
	Story<br>
	{!! mention()->asTextArea('story', $story->story, 'users', 'name', 'form-control') !!} <!---->
</div>

<div class="form-group">

<div>
{!! Form::label('Categories') !!}
{!! Form::select('categories', $categories, $story->categories->lists('id')->all(),
array('multiple'=>'multiple','name'=>'categories[]')) !!}
</div>

<div><?php //print_r($story->categories->lists('id')); ?></div>


</div>


<div class="form-group">
{!! Form::submit('Update Story', array('class'=>'btn btn-primary')) !!}
</div>
{!! Form::close() !!}

{!! Form::open(array('route' => array('stories.destroy', $story->id), 'method' => 'delete')) !!}
<button type="submit">Delete Story</button>
{!! Form::close() !!}

<script type="text/javascript">
  $('select').select2();
</script>


 @stop