<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Overtrue\LaravelFollow\Traits\CanBeLiked;
use Actuallymab\LaravelComment\HasComments;
use Actuallymab\LaravelComment\Contracts\Commentable;

class Post extends Model implements Commentable 
{
    use CanBeLiked, 
        HasComments;

    protected $guarded = [];

    /**
     * User relationship
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
