@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Home</div>

				<div class="panel-body">
					You are logged in!
					<div align="center"><a href="/" class="btn btn-warning">HOME</a>  <a href="/stories/" class="btn btn-warning">STORIES</a>  <a href="/stories/create"  class="btn btn-warning">CREATE STORY</a> <a href="/captions/" class="btn btn-warning">CAPTIONS</a>  <a href="/captions/create"  class="btn btn-warning">CREATE CAPTION</a> <a href="/brands"  class="btn btn-warning">BRAND STORIES</a>  <a href="/brands/create"  class="btn btn-warning">CREATE BRAND STORY</a> <a href="/logout"  class="btn btn-warning">LOG OUT</a>  </div>

				</div>
			</div>
		</div>
	</div>
</div>
@endsection
