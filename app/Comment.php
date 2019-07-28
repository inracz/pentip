<?php
namespace App;

use Actuallymab\LaravelComment\Models\Comment as LaravelComment;

class Comment extends LaravelComment
{
    public function user()
    {
        return $this->belongsTo(User::class, 'commented_id');
    }
}