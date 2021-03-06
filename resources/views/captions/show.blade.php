@extends('layouts.master')

<title>Caption - Stories from Pictures</title>

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

<div style="height:30em; width:auto; overflow: hidden; border:3px solid #f57f20; background-color: #efefff;" align="center">{!!HTML::image("https://sfpapp.s3.amazonaws.com/images/$caption->thumbnail",'', array('width'=>'auto','height'=>'100%')) !!}</div>

<div class="form-group">

<h5 style="color: #f57f20;">Captioned by: <b>{{ $caption->user->name }}</b></h5> <!--Isn't this auth for the current authenticated user? -->
</div>

<div class="form-group" style="background-color:#000000; padding: 2em; color:#ffffff; font-size:2.5em;">
{!! $caption->caption !!}
</div>

</div>
<div>
<ul>
@foreach($caption->categories as $category)
<li><a href="/categories/{{$category->id}}">{{ $category->name }}</a></li>
@endforeach
</ul>
</div>

<!-- The like button -->
<div>
            Likes: {{ $caption->likes()->count() }}
           
           <br>           
          
@if(!Auth::check())
<!--<div>You need to be logged in to like a story</div>--> 
@else         
           @if(DB::table('likes')->whereLikeable_idAndUser_id($caption->id, Auth::user()->id)->get())
           <!--Already Liked-->
           @foreach ($caption->likes as $like)
          {!! Form::open(array('route' => array('likes.destroy', $like->id), 'method' => 'delete')) !!}
          @endforeach
          	<button type="submit" class="btn btn-primary">Unlike</button>
			{!! Form::close() !!}
			
           @else
            <!--Not yet Liked-->
            {!! Form::open(array('route' => 'likes.store', null, 'class' => 'form')) !!}
			<div class="form-group">{!! Form::hidden('caption_id', $caption->id) !!} {!! Form::hidden('likeable_type1', 'caption') !!}</div>
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

<ul class="socialcount socialcount-small" data-url="http://www.storiesfrompictures.com/captions/{{$caption->id}}" data-facebook-action="recommend" data-counts="true" data-share-text="{{ str_limit($caption->caption, $limit = 100, $end = '...') }}">
	<li class="facebook"><a href="https://www.facebook.com/sharer/sharer.php?u=http://www.storiesfrompictures.com/captions/{{$caption->id}}" title="Share on Facebook"><span class="social-icon icon-facebook"></span><span class="count">Recommend</span></a></li>
	<li class="twitter"><a href="https://twitter.com/intent/tweet?text=http://www.storiesfrompictures.com/captions/{{$caption->id}}" title="Share on Twitter"><span class="social-icon icon-twitter"></span><span class="count">Tweet</span></a></li>
	<li class="googleplus"><a href="https://plus.google.com/share?url=http://www.storiesfrompictures.com/captions/{{$caption->id}}" title="Share on Google Plus"><span class="social-icon icon-googleplus"></span><span class="count">+1</span></a></li>
</ul>

<!-- Social Share ends -->
</div>


@if(!Auth::check())

<!--<div>You need to be logged in to update your story</div>-->
@elseif($caption->user_id === Auth::user()->id)
<div><a href="/captions/{{$caption->id}}/edit" class="btn btn-primary">Edit Caption</a></div>
@else
@endif





@if(Auth::check())
@if($caption->user_id === Auth::user()->id)
<div>
	{!! Form::open(array('route' => array('captions.destroy', $caption->id), 'method' => 'delete', 'onsubmit' => 'return ConfirmDelete()')) !!}
<button type="submit" class="btn btn-primary">Delete Caption</button>
{!! Form::close() !!}
</div>
@else
@endif
@else
<!--<div>You need to be logged in to delete your story</div>-->
@endif

<div><hr /></div>

<div style="background-color: #eeeeee; padding: 2em; ">
	<h3>Retell Caption</h3>
@if(!Auth::check())
<div>You need to be logged in to retell a caption</div>
@else
{!! Form::open(array('route' => 'reposts.store', null, 'class' => 'form')) !!}
{!! Form::hidden('repostable_type1', 'caption') !!}
<div class="form-group">
{!! Form::hidden('repostable_id', $caption->id) !!}	
{!! Form::textarea('body', null,
array('required', 'class'=>'form-control',
'placeholder'=>'Retell your own caption here')) !!}
</div>
<div class="form-group">
{!! Form::submit('Post Retell', array('class'=>'btn btn-primary')) !!}
</div>
{!! Form::close() !!}
@endif
</div>




 
 
 
 
 
 
 
 

<div style="background-color: #ffe2ca; padding: 2em; margin-top:2em;">
	
	<h3>Retold caption</h3>
	@if($caption->reposts()->count() === 0)
	<div> There are no retold captions yet</div>
	@else
<p>
@foreach ($caption->reposts as $repost)



<h3 style="color: #f57f20;">	Re:{{ $caption->title }} by {{ $repost->user->name }}</h3><!-- Temporarily dealing with user ID instead of name -->
<p>
	<div style="background-color: #000000; color: #ffffff; font-size: 1.25em; padding:1.2em;">{!! $repost->body !!}</div>
</p>

@endforeach
@endif
</div>



<div>	
	

	
	
</div>


<div><hr /></div>

<div style="background-color: #eeeeee; padding: 2em;">
	<h3>Post Comments</h3>
@if(!Auth::check())
<div>You need to be logged in to comment on a caption</div>
@else
{!! Form::open(array('route' => 'comments.store', null, 'class' => 'form')) !!}

<div class="form-group">
{!! Form::hidden('commentable_id', $caption->id) !!}	
{!! Form::label('Body') !!}
{!! Form::textarea('body', null,
array('required', 'class'=>'form-control',
'placeholder'=>'Write your comment here')) !!}
</div>
{!! Form::hidden('commentable_type1', 'caption') !!}
<div class="form-group">
{!! Form::submit('Post Comment', array('class'=>'btn btn-primary')) !!}
</div>
{!! Form::close() !!}
</div>
@endif

<div>
	<h3>Comments:</h3>
	@if($caption->comments()->count() === 0)
	<div> There are no comments yet </div>
	@else
@foreach ($caption->comments as $comment)
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