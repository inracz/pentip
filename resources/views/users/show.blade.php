@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card mb-4">
         <div class="card-header d-flex">
            <span class="flex-grow-1">&commat;{{ $user->name }}</span>
            @auth
               @if ($user->id != auth()->user()->id)
                  <subscribe-button :user="{{$user->id}}" :default="{{json_encode($user->isSubscribedBy(auth()->user()))}}" />
               @endif
            @endauth
         </div>

        <div class="card-body">
            <p class="card-text"><em>{{ $user->profile->description }}</em></p>

            @auth
               @if ($user->id == auth()->user()->id)
                  <a class="card-link" href="{{ route('users.edit') }}">Edit profile</a>    
               @endif
            @endauth
        </div>
    </div>

    <h3>Posts</h3>

      @if ($user->posts->count() === 0)
         <div class="card w-100 mt-3">
                <div class="card-body">
                    <p class="card-text">
                        No posts yet!
                    </p>
                </div>
            </div>
      @endif

      {{--@include('partials.posts', ['posts' => $user->posts])--}}
      <post-list api="{{ route('posts.index', ['user_id' => $user->id]) }}" titleredirect="{{ url('/posts/') }}" userredirect="{{ url('/users/') }}"></post-list>

</div>
@endsection
