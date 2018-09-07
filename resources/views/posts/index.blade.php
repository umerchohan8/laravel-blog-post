@extends('layouts.app')

@section('content')
	<h1>Posts</h1>
	<br>

	@if(count($posts) > 0 )
		@foreach($posts as $post)
			<div class="well">
				<div class="row">
					<div class="col-md-4 col-sm-4">
						<img style="width: 100%" src="/storage/images/{{$post->image}}">
					</div>
					<div class="col-md-8 col-sm-8">
						<ul class="list-group">
							<li class="list-group-item">
								<h3><a href="/posts/{{$post->id}}">{{$post->title}}</a></h3>
								<small>Published On : -{{$post->created_at}} by {{$post->user->name}}</small>
							</li>
						</ul>					
					</div>
				</div>
			</div>
			<br>
		@endforeach
			{{$posts->links()}}
	@else
		<p>No post found..!</p>
	@endif

@endsection