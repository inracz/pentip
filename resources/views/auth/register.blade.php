@extends('layouts.app')

@section('content')

<div class="card mx-auto" style="width: 50%;">
  <div class="card-body">
    <h5 class="card-title">Register</h5>
    <div class="card-text">
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" placeholder="Enter name" name="name">

                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">

                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password">

                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password-confirm">Confirm password</label>
                <input type="password" class="form-control" id="password-confirm" name="password-confirm" placeholder="Password">

                @error('password-confirm')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Create an Account</button>
        </form>
    </div>
  </div>
</div>
@endsection