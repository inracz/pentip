<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = [];

    /**
     * User relationship
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Comments relationship
     */
    public function comments()
    {
        return $this->hasMany(Comment::class)->latest();
    }
}
