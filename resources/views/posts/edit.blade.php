@extends('layouts.app')

@section('content')
	<h1>Edit Post</h1>

	{!! Form::open(['action' => ['PostsController@update', $post->id], 'method' => 'POST' , 'enctype' => 'multipart/form-data']) !!}
    	<div class="form-group">
    		{{Form::label('title', 'Title')}}
    		{{Form::text('title', $post->title, ['class' => 'form-control', 'placeholder' => 'Title'])}}
    	</div>
    	<div class="form-group">
    		{{Form::label('body', 'Body')}}
    		{{Form::textarea('body', $post->body, ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Body'])}}
    	</div>
        <div class="form-group">
            {{Form::label('cover-image', 'Cover Image')}}
            {!! Form::file('cover-image', array('class' => 'image')) !!}
            <div>
                Cover Image :- <img src="{{url('/cover-images')}}/{{$post->cover_image}}" class="cover-image" />
            </div>
        </div>
        {{Form::hidden('_method', 'PUT')}}
    	{{Form::submit('Save', ['class' => 'btn btn-primary'])}}
	{!! Form::close() !!}
@endsection