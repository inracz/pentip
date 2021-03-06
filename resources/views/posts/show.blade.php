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
                    <delete-post api="{{ route('api.posts.destroy', $post->id) }}" redirect="{{ route('users.show', auth()->user()->id) }}"></delete-post>
                    <a class="btn btn-light ml-2 mr-2" href="{{ route('posts.edit', $post->id) }}">Edit this post</a>
                @endcan
            @endauth
            <a class="btn btn-light ml-2 mr-2" href="{{ route('api.posts.pdf', $post->id) }}">Download as PDF</a>

            @auth
                <bookmark api="{{ route('api.posts.toggleBookmark', $post->id) }}" :default="{{ json_encode(auth()->user()->hasBookmarked($post)) }}"></bookmark>
            @endauth
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <div class="card-text" id="content">
                {!! $post->content !!}
            </div>
        </div>

        <div class="card-footer text-muted">
            @auth
                @can('like', $post)
                    <p><likes :api="'{{ route('api.posts.toggleLike', $post->id) }}'" :default="{{ json_encode($post->isLikedBy(auth()->user())) }}" :likes="{{ $post->likers->count() }}" /></p>
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
            <form class="form-inline d-flex justify-content-between" method="post" action="{{ route('api.comments.store', $post->id) }}">
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
                        <p><likes :api="'{{ route('api.comments.toggleLike', $comment->id) }}'" :default="{{ json_encode($comment->isLikedBy(auth()->user())) }}" :likes="{{ $comment->likers->count() }}" /></p>
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