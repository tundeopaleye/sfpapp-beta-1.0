@extends('layouts.master')

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

<div style="height:30em; width:auto; overflow: hidden; border:3px solid #f57f20; background-color: #efefff;" align="center">{!!HTML::image("https://sfpapp.s3.amazonaws.com/images/$brand->thumbnail",'', array('width'=>'auto','height'=>'100%')) !!}</div>

<div class="form-group">
<h1>Brand Story: <b>{{ $brand->title }}</b></h1>
<h5 style="color: #f57f20;">Written by: <b>{{ $brand->user->name }}</b></h5> <!--Isn't this auth for the current authenticated user? -->
</div>

<div class="form-group">
{!! $brand->brand !!}
</div>

</div>

<!-- The like button -->
<div>
            Likes: {{ $brand->likes()->count() }}
           
           <br>           
          
@if(!Auth::check())
<!--<div>You need to be logged in to like a story</div>--> 
@else         
           @if(DB::table('likes')->whereLikeable_idAndUser_id($brand->id, Auth::user()->id)->get())
           <!--Already Liked-->
           @foreach ($brand->likes as $like)
          {!! Form::open(array('route' => array('likes.destroy', $like->id), 'method' => 'delete')) !!}
          @endforeach
          	<button type="submit" class="btn btn-primary">Unlike</button>
			{!! Form::close() !!}
			
           @else
            <!--Not yet Liked-->
            {!! Form::open(array('route' => 'likes.store', null, 'class' => 'form')) !!}
			<div class="form-group">{!! Form::hidden('brand_id', $brand->id) !!} {!! Form::hidden('likeable_type1', 'brand') !!}</div>
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

<ul class="socialcount socialcount-small" data-url="http://www.storiesfrompictures.com/brands/{{$brand->id}}" data-facebook-action="recommend" data-counts="true" data-share-text="{{ str_limit($brand->brand, $limit = 100, $end = '...') }}">
	<li class="facebook"><a href="https://www.facebook.com/sharer/sharer.php?u=http://www.storiesfrompictures.com/brands/{{$brand->id}}" title="Share on Facebook"><span class="social-icon icon-facebook"></span><span class="count">Recommend</span></a></li>
	<li class="twitter"><a href="https://twitter.com/intent/tweet?text=http://www.storiesfrompictures.com/brands/{{$brand->id}}" title="Share on Twitter"><span class="social-icon icon-twitter"></span><span class="count">Tweet</span></a></li>
	<li class="googleplus"><a href="https://plus.google.com/share?url=http://www.storiesfrompictures.com/brands/{{$brand->id}}" title="Share on Google Plus"><span class="social-icon icon-googleplus"></span><span class="count">+1</span></a></li>
</ul>

<!-- Social Share ends -->
</div>



@if(!Auth::check())

<!--<div>You need to be logged in to update your story</div>-->
@elseif($brand->user_id === Auth::user()->id)
<div><a href="/brands/{{$brand->id}}/edit" class="btn btn-primary">Edit Brand Story</a></div>
@else
@endif





@if(Auth::check())
@if($brand->user_id === Auth::user()->id)
<div>
	{!! Form::open(array('route' => array('brands.destroy', $brand->id), 'method' => 'delete', 'onsubmit' => 'return ConfirmDelete()')) !!}
<button type="submit" class="btn btn-primary">Delete Brand Story</button>
{!! Form::close() !!}
</div>
@else
@endif
@else
<!--<div>You need to be logged in to delete your story</div>-->
@endif

<div><hr /></div>

<div style="background-color: #eeeeee; padding: 2em; ">
	<h3>Retell the Story</h3>
@if(!Auth::check())
<div>You need to be logged in to retell a story</div>
@else
{!! Form::open(array('route' => 'reposts.store', null, 'class' => 'form')) !!}
{!! Form::hidden('repostable_type1', 'brand') !!}
<div class="form-group">
{!! Form::hidden('repostable_id', $brand->id) !!}	
{!! Form::textarea('body', null,
array('required', 'class'=>'form-control',
'placeholder'=>'Retell your own story here')) !!}
</div>
<div class="form-group">
{!! Form::submit('Post Retell', array('class'=>'btn btn-primary')) !!}
</div>
{!! Form::close() !!}
@endif
</div>




 
 
 
 
 
 
 
 

<div style="background-color: #ffe2ca; padding: 2em; margin-top:2em;">
	
	<h3>Retold Brand Stories</h3>
	@if($brand->reposts()->count() === 0)
	<div> There are no retold brand stories yet</div>
	@else
<p>
@foreach ($brand->reposts as $repost)



<h3 style="color: #f57f20;">	Re:{{ $brand->title }} by {{ $repost->user->name }}</h3><!-- Temporarily dealing with user ID instead of name -->
<p>
	{!! $repost->body !!}
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
<div>You need to be logged in to comment on a story</div>
@else
{!! Form::open(array('route' => 'comments.store', null, 'class' => 'form')) !!}

<div class="form-group">
{!! Form::hidden('commentable_id', $brand->id) !!}	
{!! Form::label('Body') !!}
{!! Form::textarea('body', null,
array('required', 'class'=>'form-control',
'placeholder'=>'Write your comment here')) !!}
</div>
{!! Form::hidden('commentable_type1', 'brand') !!}
<div class="form-group">
{!! Form::submit('Post Comment', array('class'=>'btn btn-primary')) !!}
</div>
{!! Form::close() !!}
</div>
@endif

<div>
	<h3>Comments:</h3>
	@if($brand->comments()->count() === 0)
	<div> There are no comments yet </div>
	@else
@foreach ($brand->comments as $comment)
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