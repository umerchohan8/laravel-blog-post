@extends('layouts.app')

@section('content')
	<h1>{{$title}}</h1>
	<p> {{$body}}</p>

	@if(count($skills) > 0)
		<ul class="list-group">
			@foreach($skills as $k)
				<li class="list-group-item">{{$k}}</li>
			@endforeach
		</ul>
	@endif
@endsection

