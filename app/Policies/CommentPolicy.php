<?php

namespace App\Policies;

use App\User;
use App\Comment;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    /**
     * Can a user like a comment?
     * 
     * @param \App\User User
     * @param \App\Comment Comment
     * @return bool Result
     */
    public function like(User $user, Comment $comment)
    {
        return !($user->id == $comment->user->id);
    }
}
