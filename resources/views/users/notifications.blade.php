@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Notifications</h3>

        <div class="row">
        @if ($notifications->isEmpty())
            <div class="card w-100 mt-3">
                <div class="card-body">
                    <p class="card-text">
                        Nothing new!
                    </p>
                </div>
            </div>
        @else
            @foreach ($notifications as $n)
                @if ($n->data['type'] == 'newpost')
                    <p>New post by <a href="{{ route('users.show', $n->data['author']['id']) }}">{{ $n->data['author']['name'] }}</a>: <a href="{{ route('posts.show', $n->data['id']) }}"><strong>{{ $n->data['title'] }}</strong></a></p>
                @endif
            @endforeach
        @endif
        </div>
    </div>
@endsection
