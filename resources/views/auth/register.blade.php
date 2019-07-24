@extends('layouts.app')

@section('content')
<h2>Register</h2>

<form method="POST" action="{{ route('register') }}">
    @csrf

    <div>
        <label for="name">Name</label>
        <input id="name" type="text" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

        @error('name')
            <p>{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="email" >Email address</label>
        <input id="email" type="email"  name="email" value="{{ old('email') }}" required autocomplete="email">

        @error('email')
            <p>{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="password">Password</label>
        <input id="password" type="password" name="password" required autocomplete="new-password">

        @error('password')
            <p>{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="password-confirm">Confirm Password</label>
        <input id="password-confirm" type="password" name="password_confirmation" required autocomplete="new-password">

        @error('password-confirm')
            <p>{{ $message }}</p>
        @enderror
    </div>

    <div>
        <button type="submit">
            Register
        </button>
    </div>
</form>
@endsection
