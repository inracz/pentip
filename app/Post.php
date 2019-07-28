<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Overtrue\LaravelFollow\Traits\CanBeLiked;
use Actuallymab\LaravelComment\HasComments;
use Actuallymab\LaravelComment\Contracts\Commentable;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use EloquentFilter\Filterable;

class Post extends Model implements Commentable 
{
    use CanBeLiked, 
        HasComments,
        Filterable;

    protected $guarded = [];

    /**
     * User relationship
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Comment relationship
     */
    public function comments() : MorphMany
    {
        return $this->morphMany(config('comment.model'), 'commentable')->latest();
    }
}
