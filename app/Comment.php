<?php
namespace App;

use Actuallymab\LaravelComment\Models\Comment as LaravelComment;
use Overtrue\LaravelFollow\Traits\CanBeLiked;

class Comment extends LaravelComment
{
    use CanBeLiked;

    public function user()
    {
        return $this->belongsTo(User::class, 'commented_id');
    }
}