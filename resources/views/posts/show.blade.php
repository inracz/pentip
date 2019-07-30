@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card mb-4">
        <div class="card-body">
            <h2 class="card-title">{{ $post->title }}</h2>
            <h6 class="card-subtitle mb-2 text-muted">Written by <a href="{{ route('users.show', $post->user->id) }}">&commat;{{ $post->user->name }}</a></h6>
            <p class="card-text pb-4 pt-4"><em>{{ $post->description }}</em></p>

            @auth
                @can('update', $post)
                    <a class="card-link" href="#"
                            onclick="event.preventDefault();
                                            document.getElementById('delete-form').submit();">
                            Delete this post

                        <form id="delete-form" action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display: none;">
                            @csrf
                            @method("delete")
                        </form>
                    </a>
                    <a class="card-link" href="{{ route('posts.edit', $post->id) }}">Edit this post</a>
                @endcan
            @endauth
            <a class="card-link" href="{{ route('posts.pdf', $post->id) }}">Download as PDF</a>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <div class="card-text">
                {!! $post->content !!}
            </div>
        </div>

        <div class="card-footer text-muted">
            @auth
                @can('like', $post)
                    <p><likes :api="'{{ route('posts.toggleLike', $post->id) }}'" :default="{{ json_encode($post->isLikedBy(auth()->user())) }}" :likes="{{ $post->likers->count() }}" /></p>
                @else
                    {{ $post->likers->count() }} likes
                @endcan
            @else
                {{ $post->likers->count() }} likes
            @endauth
        </div>
    </div>

    <hr class="mt-4 mb-4">

    <div class="card">
        <div class="card-body">
            <form class="form-inline d-flex justify-content-between" method="post" action="{{ route('comments.store', $post->id) }}">
                @csrf

                <div class="form-group flex-grow-1">
                    <textarea name="body" id="body" class="form-control w-100"></textarea>
                </div>

                <button type="submit" class="btn btn-primary ml-4">Send</button>
            </form>
        </div>
    </div>

    <hr class="mt-4 mb-4">

    @if ($post->totalCommentsCount() === 0)
        <p>No comments yet</p>
    @endif

    @foreach ($post->comments()->with('user')->get() as $comment)
        <div class="card mb-3">
            <div class="card-header">
                <a href="{{ route('users.show', $comment->user->id) }}">&commat;{{ $comment->user->name }}</a>
            </div>
            <div class="card-body">
                <p class="card-text">{{ $comment->comment }}</p>
                <p class="card-text"><small class="text-muted">
                @auth
                    @can('like', $comment)
                        <p><likes :api="'{{ route('comments.toggleLike', $comment->id) }}'" :default="{{ json_encode($comment->isLikedBy(auth()->user())) }}" :likes="{{ $comment->likers->count() }}" /></p>
                    @else
                        <p>{{ $comment->likers->count() }} likes</p>
                    @endcan
                @else
                    <p>{{ $comment->likers->count() }} likes</p>
                @endauth
                </small></p>
            </div>
        </div>
    @endforeach

</div>
@endsection