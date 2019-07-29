@extends('layouts.app')

@section('content')
    <h2>Notifications</h2>

    @if ($notifications->isEmpty())
        <p>Nothing new!</p>
    @else
        @foreach ($notifications as $n)
            @if ($n->data['type'] == 'newpost')
                <p>New post by <a href="{{ route('users.show', $n->data['author']['id']) }}">{{ $n->data['author']['name'] }}</a>: <a href="{{ route('posts.show', $n->data['id']) }}"><strong>{{ $n->data['title'] }}</strong></a></p>
            @endif
        @endforeach
    @endif
@endsection

