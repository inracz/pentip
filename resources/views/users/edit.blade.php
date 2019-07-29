@extends('layouts.app')

@section('content')
<div class="card mx-auto" style="width: 50%;">
    <div class="card-body">
        <h5 class="card-title">Edit profile</h5>
        <div class="card-text">
    
            <form method="post" action="{{ route('users.update') }}">
                @csrf
                @method('patch')
            
                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" id="description" name="description" value="{{ old('description') ?? $user->profile->description }}" class="form-control" autofocus>
            
                    @error('description')
                        <div>{{ $message }}</div>
                    @enderror
                </div>
            
                <button type="submit">
                    Save
                </button>
            <form>

        </div>
    </div>
</div>
@endsection