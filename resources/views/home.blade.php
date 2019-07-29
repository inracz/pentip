@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <post-list api="{{ route('posts.index', request()->all()) }}" titleredirect="{{ url('/posts/') }}" userredirect="{{ url('/users/') }}"></post-list>
        </div>
    </div>
@endsection
