 @extends('layouts.app')

 @section('content')
    <h2>{{ $user->name }}</h2>
    <p><a href="{{ route('users.edit') }}">Edit profile</a></p>
    <p><em>{{ $user->profile->description }}</em></p>
 @endsection