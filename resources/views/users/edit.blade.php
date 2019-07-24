@extends('layouts.app')

@section('content')
<h2>Edit Profile</h2>

<form method="post" action="{{ route('users.update') }}">
    @csrf
    @method('patch')

    <div>
        <label for="description">Description</label>
        <input type="text" id="description" name="description" value="{{ old('description') ?? $user->profile->description }}" autofocus>

        @error('description')
            <div>{{ $message }}</div>
        @enderror
    </div>

    <button type="submit">
        Save
    </button>
<form>
@endsection