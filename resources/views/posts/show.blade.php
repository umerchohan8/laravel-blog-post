@extends('layouts.app')

@section('content')
	<a href="/posts"><button class="btn btn-default">Go Back</button></a>
	<h1>{{$post->title}}</h1>
	<img style="width: 50%; height: 50%;" src="/storage/images/{{$post->image}}">
	<hr>
	<div class="well">
		<p>{!!$post->body!!}</p>
	</div>
	<hr>
	<small>{{$post->created_at}} by {{$post->user->name}}</small>

	@if(!Auth::guest())
		@if(Auth::user()->id == $post->user_id)
			<hr>
			<a href="/posts/{{$post->id}}/edit" class="btn btn-primary">Edit</a>
			<br>
			<br>
			{!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST'])!!}
				{{Form::hidden('_method', 'DELETE')}}
				{{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
			{!!Form::close()!!}
		@endif
	@endif
@endsection