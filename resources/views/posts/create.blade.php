@extends('layouts.app')

@section('content')
	<h1>Create Post</h1>

	{!! Form::open(['action' => 'PostsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
    	<div class="form-group">
    		{{Form::label('title', 'Title')}}
    		{{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title'])}}
    	</div>
    	<div class="form-group">
    		{{Form::label('body', 'Body')}}
    		{{Form::textarea('body', '', ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Body'])}}
    	</div>
        <div class="form-group">
            {{Form::label('cover-image', 'Cover Image')}}
            {!! Form::file('cover-image', array('class' => 'image')) !!}
        </div>
    	{{Form::submit('Save', ['class' => 'btn btn-primary'])}}
	{!! Form::close() !!}
@endsection