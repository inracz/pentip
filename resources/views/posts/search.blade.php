@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Search results</h3>

        <div class="row">
            <post-list api="{{ route('api.posts.index', request()->all()) }}" titleredirect="{{ url('/posts/') }}" userredirect="{{ url('/users/') }}"></post-list>
        </div>
    </div>
@endsection