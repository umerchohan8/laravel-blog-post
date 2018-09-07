@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!<br><br>


                    <a class="btn btn-outline-default" href="/create">Create Post</a>
                    @if(count($posts) > 0 )
                    <table class="table table-striped">
                        <tr>
                            <th>Your Posts</th>
                            <th></th>
                            <th></th>
                        </tr>
                        @foreach($posts as $post)
                        <tr>
                            <td>{{$post->title}}</td>
                            <td><a href="/posts/{{$post->id}}/edit" class="btn btn-info">Edit</a></td>
                            <td>{!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST'])!!}
                                {{Form::hidden('_method', 'DELETE')}}
                                {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                            {!!Form::close()!!}</td>
                        </tr>
                        @endforeach
                    </table>
                    @else
                        <p>You have no post yet.</p>
                    @endif
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
