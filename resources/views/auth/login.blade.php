@extends('layouts.app')

@section('content')
<h2>Login</h2>

<form method="POST" action="{{ route('login') }}">
    @csrf

    <div>
        <label for="email">Email address</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

        @error('email')
            <div>{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label for="password">Password</label>
        <input id="password" type="password" name="password" required autocomplete="current-password">

        @error('password')
            <div>{{ $message }}</div>
        @enderror
    </div>

    <div>
        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

        <label for="remember">
            Remember me
        </label>
    </div>

    <button type="submit">
        Login
    </button>
</form>
@endsection
