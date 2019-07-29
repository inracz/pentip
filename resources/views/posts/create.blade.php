@extends('layouts.app')

@section('content')
<div class="card mx-auto" style="width: 50%;">
  <div class="card-body">
    <h5 class="card-title">Create New Post</h5>
    <div class="card-text">
        <form method="post" enctype="multipart/form-data" action="{{ route('posts.store') }}">
            @csrf

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title">

                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="thumbnail">Thumbnail</label>
                <input type="file" name="thumbnail" id="thumbnail" class="form-control">

                @error('thumbnail')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" class="form-control" name="description" id="description" required>

                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="content">Content</label>
                <textarea name="content" id="content" class="form-control" required></textarea>

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