@extends('layouts.app')

@section('content')
    <h2>{{ $post->title }}</h2>
    <p><em>{{ $post->description }}</em></p>

    {{ $post->content }}
@endsection