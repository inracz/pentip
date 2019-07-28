@extends('layouts.app')

@section('content')
    <h2>{{ $post->title }}</h2>
    <p><a href="{{ route('users.show', $post->user->id) }}"><strong>{{ $post->user->name }}</strong></a>: <em>{{ $post->description }}</em></p>

    <hr>

    @auth
        @if ($post->user->id == auth()->user()->id)
            <p><a  href="#"
                    onclick="event.preventDefault();
                                    document.getElementById('delete-form').submit();">
                    Delete this post
                </a>

                <form id="delete-form" action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display: none;">
                    @csrf
                    @method("delete")
                </form></p>
        @endif
    @endauth
    
    {!! $post->content !!}

    <hr>
        <p><likes :post="{{ $post->id }}" :default="{{ json_encode($post->isLikedBy(auth()->user())) }}" :likes="{{ $post->likers->count() }}" /></p>
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

    @if ($post->totalCommentsCount() === 0)
        <p>No comments yet</p>
    @endif

    @foreach ($post->comments as $comment)
        <p><a href="{{ route('users.show', $comment->user->id) }}"><strong>{{ $comment->user->name }}</strong></a>: {{ $comment->comment }}</p>
    @endforeach
@endsection