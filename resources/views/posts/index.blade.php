@extends('layouts.app')

@section('content')
	<a href="posts/create" class="btn btn-default">Create Post</a>

	<hr>

	@if(count($posts) > 0)
		@foreach($posts as $post)
			<a href="/posts/{{$post->id}}">
			<div class="well">
				<h3>{{$post->title}}</h3>
				<small>Written on {{$post->created_at}} by {{$post->user->name}}</small>
			</div>
			</a>
		@endforeach

		{{$posts->links()}}
	@else
		<p>No posts found!</p>
	@endif
@endsection