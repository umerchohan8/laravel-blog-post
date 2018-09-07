@extends('layouts.app')

@section('content')

	<h1>Edit Post</h1>

	{!! Form::open(['action' => ['PostsController@update', $post->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}

    	<div class="form-group">
    		{{Form::label('title', 'Title')}}
    		{{Form::text('title', $post->title, ['class' => 'form-control'])}}
    	</div>

    	<div class="form-group">
    		{{Form::label('body', 'Body')}}
    		{{Form::textarea('body', $post->body, ['class' => 'form-control', 'id' => 'article-ckeditor'])}}
    	</div>

        <div class="form-group">
            {{Form::file('image')}}
        </div>

        {{Form::hidden('_method', 'PUT')}}
    	{{Form::submit('Publish', ['class' => 'btn btn-success'])}} 

{!! Form::close() !!}

@endsection