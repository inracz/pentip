@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>New posts from your subscriptions</h3>

        <div class="row">
            <post-list api="{{ route('api.posts.feed', request()->all()) }}" titleredirect="{{ url('/posts/') }}" userredirect="{{ url('/users/') }}"></post-list>
        </div>
    </div>
@endsection