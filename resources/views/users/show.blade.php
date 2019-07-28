 @extends('layouts.app')

 @section('content')
   <h2>{{ $user->name }}</h2>

   @auth
      @if ($user->id == auth()->user()->id)
         <p><a href="{{ route('users.edit') }}">Edit profile</a></p>

         <h4>You're subscribed to these authors:</h4>
         <ul>
         @foreach ($user->subscriptions as $subscription)
            <li><a href="{{ route('users.show', $subscription->id) }}">{{ $subscription->name}}</a></li>
         @endforeach
         </ul>

      @else
         <p><subscribe-button :user="{{$user->id}}" :default="{{json_encode($user->isSubscribedBy(auth()->user()))}}" /></p>
      @endif
   @endauth
      <p><em>{{ $user->profile->description }}</em></p>

      <h3>Posts</h3>

      @if ($user->posts->count() === 0)
        <p>No posts yet</p>
      @endif

      @include('partials.posts', ['posts' => $user->posts])
 @endsection

