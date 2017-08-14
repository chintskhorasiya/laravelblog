@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <span class="pull-right">You are logged in!</span>
                    <a href="posts/create" class="btn btn-default">Create Post</a>
                    @if(count($posts) > 0)
                        <h3>Your Blog Posts</h3>
                        <table class="table table-striped">
                            <tr>
                                <th>Title</th>
                                <th></th>
                                <th></th>
                            </tr>
                            @foreach($posts as $post)
                            <tr>
                                <td>{{$post->title}}</td>
                                <td><a href="/posts/{{$post->id}}/edit" class="btn btn-default">Edit</a></td>
                                <td></td>
                            </tr>
                            @endforeach
                        </table>

                    @else
                        <p>You have not any post!</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
