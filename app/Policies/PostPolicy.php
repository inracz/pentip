<?php

namespace App\Policies;

use App\User;
use App\Post;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Can a user update a post?
     * 
     * @param \App\User User
     * @param \App\Post Post
     * @return bool Result
     */
    public function update(User $user, Post $post)
    {
        return $user->id == $post->user->id;
    }

    /**
     * Can a user like a post?
     * 
     * @param \App\User User
     * @param \App\Post Post
     * @return bool Result
     */
    public function like(User $user, Post $post)
    {
        return !($user->id == $post->user->id);
    }
}
