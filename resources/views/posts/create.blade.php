@extends('layouts.app')

@section('content')
<h2>Create New Post</h2>

<form method="post" enctype="multipart/form-data" action="{{ route('posts.store') }}">
    @csrf

    <div>
        <label for="title">Title</label>
        <input type="text" name="title" id="title" required>

        @error('title')
            <div>{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label for="thumbnail">Thumbnail</label>
        <input type="file" name="thumbnail" id="thumbnail" required>

        @error('thumbnail')
            <div>{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label for="description">Description</label>
        <input type="text" name="description" id="description" required>

        @error('description')
            <div>{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label for="content">Content</label>
        <textarea name="content" id="content" required></textarea>

        @error('content')
            <div>{{ $message }}</div>
        @enderror
    </div>

    <button type="submit">
        Store
    </button>
</form>
@endsection