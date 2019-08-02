<?php
namespace App;

use Actuallymab\LaravelComment\Models\Comment as LaravelComment;
use Overtrue\LaravelFollow\Traits\CanBeLiked;
use EloquentFilter\Filterable;


class Comment extends LaravelComment
{
    use CanBeLiked,
        Filterable;

    /**
     * User relationship
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'commented_id');
    }

    public function scopeFilterAndPaginate($query)
    {
        return $query->filter(request()->all())->latest()->with('user')->simplePaginate(30)->appends(request()->except('page'));
    }
}