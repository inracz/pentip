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
    @auth
        @can('like', $post)
            <p><likes :api="'{{ route('posts.toggleLike', $post->id) }}'" :default="{{ json_encode($post->isLikedBy(auth()->user())) }}" :likes="{{ $post->likers->count() }}" /></p>
        @else
            {{ $post->likers->count() }}
        @endcan
    @else
        {{ $post->likers->count() }}
    @endauth
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

    @foreach ($post->comments()->with('user')->get() as $comment)
        <div>
            <p><a href="{{ route('users.show', $comment->user->id) }}"><strong>{{ $comment->user->name }}</strong></a>: {{ $comment->comment }}</p>
            @auth
                @can('like', $comment)
                    <p><likes :api="'{{ route('comments.toggleLike', $comment->id) }}'" :default="{{ json_encode($comment->isLikedBy(auth()->user())) }}" :likes="{{ $comment->likers->count() }}" /></p>
                @else
                    <p>{{ $comment->likers->count() }}</p>
                @endcan
            @else
                <p>{{ $comment->likers->count() }}</p>
            @endauth
        </div>
    @endforeach
@endsection