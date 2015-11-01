@extends('layouts.master')

<title>Repost - Pictolit</title>

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

<div>
@if($repost->repostable_type == 'App\Story')
Content for Stories
@elseif($repost->repostable_type == 'App\Brand')
Content for Brnds
@else
No relevant content to display
@endif
</div>

<div style="height:30em; width:auto; overflow: hidden; border:3px solid #f57f20; background-color: #efefff;" align="center"><!--{!!HTML::image("https://sfpapp.s3.amazonaws.com/images/",'', array('width'=>'auto','height'=>'100%')) !!}--></div>

<div class="form-group">
<h1>Story: <b></b></h1>
<h5 style="color: #f57f20;">Repost by: <b>[{{ $repost->user_id }}] {{ $user->name }}</b></h5> <!--Isn't this auth for the current authenticated user? -->
</div>

<div class="form-group">
{!! $repost->body !!}
</div>

<div class="form-group">
<a href="/stories/{{ $repost->repostable_id }}">Original Story - {{ $brand->title }}</a>
</div>








<!-- Like button ends -->


<div>
<!-- Social Share -->

<ul class="socialcount socialcount-small" data-url="http://www.pictolit.com/reposts/{{$repost->id}}" data-facebook-action="recommend" data-counts="true" data-share-text="{{ str_limit($repost->body, $limit = 100, $end = '...') }}">
	<li class="facebook"><a href="https://www.facebook.com/sharer/sharer.php?u=http://www.pictolit.com/stories/{{$repost->id}}" title="Share on Facebook"><span class="social-icon icon-facebook"></span><span class="count">Recommend</span></a></li>
	<li class="twitter"><a href="https://twitter.com/intent/tweet?text=http://www.pictolit.com/stories/{{$repost->id}}" title="Share on Twitter"><span class="social-icon icon-twitter"></span><span class="count">Tweet</span></a></li>
	<li class="googleplus"><a href="https://plus.google.com/share?url=http://www.pictolit.com/stories/{{$repost->id}}" title="Share on Google Plus"><span class="social-icon icon-googleplus"></span><span class="count">+1</span></a></li>
</ul>

<!-- Social Share ends -->
</div>




 @stop