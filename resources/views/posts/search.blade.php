@extends('layouts.app')

@section('content')
    <h1>Search results</h1>

    <post-list api="{{ route('posts.index', request()->all()) }}" titleredirect="{{ url('/posts/') }}" userredirect="{{ url('/users/') }}"></post-list>
@endsection
