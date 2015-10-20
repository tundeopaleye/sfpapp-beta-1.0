@extends('layouts.master')

<title>Story - Pictolit</title>

<script>

  function ConfirmDelete()
  {
  var x = confirm("Are you sure you want to delete?");
  if (x)
    return true;
  else
    return false;
  }

</script>

@section('content')


<ul>
@foreach($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>

<div style="height:30em; width:auto; overflow: hidden; border:3px solid #f57f20; background-color: #efefff;" align="center">{!!HTML::image("https://sfpapp.s3.amazonaws.com/images/$story->thumbnail",'', array('width'=>'auto','height'=>'100%')) !!}</div>

<div class="form-group">
<h1>Story: <b>{{ $story->title }}</b></h1>
<h5 style="color: #f57f20;">Written by: <b>{{ $story->user->name }}</b></h5> <!--Isn't this auth for the current authenticated user? -->
</div>

<div class="form-group">
{!! $story->story !!}
</div>

<!--<div>
	@unless ($story->categories->isEmpty())

<h5>Categories</h5>

	@foreach ($story->categories as $category)
	   {{ $category->name }},
	@endforeach

@endunless
</div>-->

</div>
<div>
<ul>
@foreach($story->categories as $category)
<li><a href="/categories/{{$category->id}}">{{ $category->name }}</a></li>
@endforeach
</ul>
</div>
<!-- The like button -->
<div>
            Likes: {{ $story->likes()->count() }}
           
                   
</div>

<div style="float:left; width:10%;">          
@if(!Auth::check())
<!--<div>You need to be logged in to like a story</div>--> 
@else         
           @if(DB::table('likes')->whereLikeable_idAndUser_id($story->id, Auth::user()->id)->get())
           <!--Already Liked-->
           @foreach ($story->likes as $like)
          {!! Form::open(array('route' => array('likes.destroy', $like->id), 'method' => 'delete')) !!}
          @endforeach
          	<button type="submit" class="btn btn-primary">Unlike</button>
			{!! Form::close() !!}
			
           @else
            <!--Not yet Liked-->
            {!! Form::open(array('route' => 'likes.store', null, 'class' => 'form')) !!}
			<div class="form-group">{!! Form::hidden('story_id', $story->id) !!} {!! Form::hidden('likeable_type1', 'story') !!}</div>
			<div class="form-group">
			{!! Form::submit('Like', array('class'=>'btn btn-primary')) !!}
			{!! Form::close() !!}			
			</div>
           @endif
  @endif         
        </div>


<!-- Like button ends -->


<div>
<!-- Social Share -->

<ul class="socialcount socialcount-small" data-url="http://www.storiesfrompictures.com/stories/{{$story->id}}" data-facebook-action="recommend" data-counts="true" data-share-text="{{ str_limit($story->story, $limit = 100, $end = '...') }}">
	<li class="facebook"><a href="https://www.facebook.com/sharer/sharer.php?u=http://www.storiesfrompictures.com/stories/{{$story->id}}" title="Share on Facebook"><span class="social-icon icon-facebook"></span><span class="count">Recommend</span></a></li>
	<li class="twitter"><a href="https://twitter.com/intent/tweet?text=http://www.storiesfrompictures.com/stories/{{$story->id}}" title="Share on Twitter"><span class="social-icon icon-twitter"></span><span class="count">Tweet</span></a></li>
	<li class="googleplus"><a href="https://plus.google.com/share?url=http://www.storiesfrompictures.com/stories/{{$story->id}}" title="Share on Google Plus"><span class="social-icon icon-googleplus"></span><span class="count">+1</span></a></li>
</ul>

<!-- Social Share ends -->
</div>

<div style="float:left; width:10%;">
@if(!Auth::check())

<!--<div>You need to be logged in to update your story</div>-->
@elseif($story->user_id === Auth::user()->id)
<div style="float:left; width:10%;"><a href="/stories/{{$story->id}}/edit" class="btn btn-primary">Edit Story</a></div>
@else
@endif
</div>



<div style="float:left; width:10%;">
@if(Auth::check())
@if($story->user_id === Auth::user()->id)
<div>
	{!! Form::open(array('route' => array('stories.destroy', $story->id), 'method' => 'delete', 'onsubmit' => 'return ConfirmDelete()')) !!}
<button type="submit" class="btn btn-primary">Delete Story</button>
{!! Form::close() !!}
</div>
@else
@endif
@else
<!--<div>You need to be logged in to delete your story</div>-->
@endif
</div>
<br><hr />


<div style="background-color: #eeeeee; padding: 2em; ">
	<h3>Retell the Story</h3>
@if(!Auth::check())
<div>You need to be logged in to retell a story</div>
@else
{!! Form::open(array('route' => 'reposts.store', null, 'class' => 'form')) !!}
{!! Form::hidden('repostable_type1', 'story') !!}
<div class="form-group">
{!! Form::hidden('repostable_id', $story->id) !!}	
<!--{!! Form::textarea('body', null,
array('required', 'class'=>'form-control',
'placeholder'=>'Retell your own story here')) !!}

-->
<div class="form-group">
	Retell the Story (mentions)<br>
	{!! mention()->asTextArea('body', old('body'), 'users', 'name', 'form-control') !!} <!---->
</div>
<div class="form-group">
{!! Form::submit('Post Retell', array('class'=>'btn btn-primary')) !!}
</div>
{!! Form::close() !!}
@endif
</div>




 
 
 
 
 
 
 
 

<div style="background-color: #ffe2ca; padding: 2em; margin-top:2em;">
	
	<h3>Retold Stories</h3>
	@if($story->reposts()->count() === 0)
	<div> There are no retold stories yet</div>
	@else
<p>
@foreach ($story->reposts as $repost)



<h3 style="color: #f57f20;">	Re:{{ $story->title }} by {{ $repost->user->name }}</h3><!-- Temporarily dealing with user ID instead of name -->
<p>
	{!! preg_replace('/(^|\s)@([a-z0-9_]+)/i', '$1<a href="http://www.pictolit.com/users/$2">@$2</a>', $repost->body)  !!}
</p>

@endforeach
@endif
</div>



<div>	
	

	
	
</div>
</div>

<div><hr /></div>

<div style="background-color: #eeeeee; padding: 2em;">
	<h3>Post Comments</h3>
@if(!Auth::check())
<div>You need to be logged in to comment on a story</div>
@else
{!! Form::open(array('route' => 'comments.store', null, 'class' => 'form')) !!}

<div class="form-group">
{!! Form::hidden('commentable_id', $story->id) !!}	
{!! Form::label('Body') !!}
{!! Form::textarea('body', null,
array('required', 'class'=>'form-control',
'placeholder'=>'Write your comment here')) !!}
</div>
{!! Form::hidden('commentable_type1', 'story') !!}
<div class="form-group">
{!! Form::submit('Post Comment', array('class'=>'btn btn-primary')) !!}
</div>
{!! Form::close() !!}
</div>
@endif

<div>
	<h3>Comments:</h3>
	@if($story->comments()->count() === 0)
	<div> There are no comments yet </div>
	@else
@foreach ($story->comments as $comment)
<p>
<span style="color: #f57f20;"><b>{{ $comment->user->name }}</b> commented on {{ $comment->created_at }}</span>
</p>
<p>
{!! $comment->body !!}
</p>
@endforeach
@endif
</div>

<!--<script type="text/javascript">
            $(function() {
                $('.ajax-like').click(function(e) {
                    e.preventDefault();
                    var l = Ladda.create(this);
                    var id=$(this).attr("id");
                    l.start();
                    $.story("/like", {
                        "story_id" : $(this).attr("id")
                    }, function(response) {
                        if(response.result!=null&&response.result=="1"){
                            if(response.isunlike=="1"){
                                $("#"+id).removeClass("btn-success");
                                $("#"+id).addClass("btn-danger");
                                $("#"+id).html(response.text);
                            }else{
                                $("#"+id).removeClass('btn-danger');
                                $("#"+id).addClass("btn-success");
                                $("#"+id).html(response.text);
                            }
                        }else{
                            alert("Server Error");
                        }
                    }, "json").always(function() {
                        l.stop();
                    });
                    return false;
                });
            });
        </script>
-->
 @stop