@extends('layouts.app')

@section('content')

	<h1>Create Posts</h1>

	{!! Form::open(['action' => 'PostsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}

    	<div class="form-group">
    		{{Form::label('title', 'Title')}}
    		{{Form::text('title', '', ['class' => 'form-control'])}}
    	</div>

    	<div class="form-group">
    		{{Form::label('body', 'Body')}}
    		{{Form::textarea('body', '', ['class' => 'form-control', 'id' => 'article-ckeditor'])}}
    	</div>

        <div class="form-group">
            {{Form::file('image')}}
        </div>

    	{{Form::submit('Publish', ['class' => 'btn btn-success'])}} 

{!! Form::close() !!}

@endsection