@extends('layouts.app')

@section('content')
    <h1>Feed</h1>

    <post-list api="{{ route('posts.feed', request()->all()) }}" titleredirect="{{ url('/posts/') }}" userredirect="{{ url('/users/') }}"></post-list>
@endsection
