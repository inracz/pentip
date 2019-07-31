@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Bookmarks</h3>

        <div class="row">
            <post-list api="{{ route('api.posts.bookmarks', request()->all()) }}" titleredirect="{{ url('/posts/') }}" userredirect="{{ url('/users/') }}"></post-list>
        </div>
    </div>
@endsection