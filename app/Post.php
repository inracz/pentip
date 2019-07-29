<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Overtrue\LaravelFollow\Traits\CanBeLiked;
use Actuallymab\LaravelComment\HasComments;
use Actuallymab\LaravelComment\Contracts\Commentable;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use EloquentFilter\Filterable;
use Carbon\Carbon;
use CyrildeWit\EloquentViewable\Viewable;
use CyrildeWit\EloquentViewable\Contracts\Viewable as ViewableContract;

class Post extends Model implements Commentable, ViewableContract
{
    use CanBeLiked, 
        HasComments,
        Filterable,
        Viewable;

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

    /**
     * How much time will take the user to read the article
     * 
     * @return string Time in minutes
     */
    public function timeToRead()
    {
        return (int) round(str_word_count($this->content)/200);
    }

    /**
     * Get post's views
     * 
     * @return string Views
     */
    public function getViews()
    {
        return views($this)->count();
    }

}
