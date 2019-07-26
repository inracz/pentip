@extends('layouts.app')

@section('content')
    <h1>Latest</h1>

    <ul>
         @foreach ($posts as $post)
            <li><a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a> | <small>{{ $post->created_at->format('d/m/Y') }}</small></li>
         @endforeach
    </ul>
@endsection
