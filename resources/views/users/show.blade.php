 @extends('layouts.app')

 @section('content')
   <h2>{{ $user->name }}</h2>

   @auth
      @if ($user->id == auth()->user()->id)
         <p><a href="{{ route('users.edit') }}">Edit profile</a></p>
      @endif
   @endauth
      <p><em>{{ $user->profile->description }}</em></p>

      <h3>Posts</h3>

      @if ($user->posts->count() === 0)
        <p>No posts yet</p>
      @endif

      <ul>
         @foreach ($user->posts as $post)
            <li><a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a></li>
         @endforeach
      </ul>
 @endsection

