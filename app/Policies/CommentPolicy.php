<?php

namespace App\Policies;

use App\User;
use App\Comment;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    public function like(User $user, Comment $comment)
    {
        return !($user->id == $comment->user->id);
    }
}
