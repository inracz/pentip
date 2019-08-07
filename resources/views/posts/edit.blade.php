@extends('layouts.app')

@section('content')
<div class="card mx-auto" style="width: 50%;">
  <div class="card-body">
    <h5 class="card-title">
        @if (Route::currentRouteName() == 'posts.create')
            Create New Post
        @else
            Edit a Post
        @endif
    </h5>
    <div class="card-text">

        @if (Route::currentRouteName() == 'posts.create')
        <form method="post" enctype="multipart/form-data" action="{{ route('api.posts.store') }}">
        @else
        <form method="post" enctype="multipart/form-data" action="{{ route('api.posts.update', $post->id) }}">
            @method('patch')
        @endif

            @csrf

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ isset($post) ? $post->title : old('title') }}">

                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="thumbnail">Thumbnail</label>
                <input type="file" name="thumbnail" id="thumbnail" class="form-control" value="{{ old('thumbnail') }}">

                @error('thumbnail')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" class="form-control" name="description" id="description" required value="{{ isset($post) ? $post->description : old('description') }}">

                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="content">Content</label>
                <textarea name="content" id="content" class="form-control" required>{{ isset($post) ? $post->content : old('content') }}</textarea>

                @error('content')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
  </div>
</div>
@endsection