@extends('layouts.app')

@section('content')
    <h1>Latest</h1>

    @include('partials.posts', ['posts' => $posts])
@endsection
