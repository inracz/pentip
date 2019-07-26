@extends('layouts.app')

@section('content')
    <h2>{{ $post->title }}</h2>
    <p><em>{{ $post->description }}</em></p>

    <hr>
    
    {!! $post->content !!}

    <hr>
    
    <h3>Comments</h3>

    <form method="post" action="{{ route('comments.store', $post->id) }}">
        @csrf

        <div>
            <label for="body">Comment</label>
            <textarea name="body" id="body"></textarea>
        </div>

        <div>
            <button type="submit">Send</button>
        </div>
    </form>

    @if ($post->comments->count() === 0)
        <p>No comments yet</p>
    @endif

    @foreach ($post->comments as $comment)
        <p><strong>{{ $comment->user->name}}</strong>: {{ $comment->body }}</p>
    @endforeach
@endsection