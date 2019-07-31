<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Events\UserCreated;
use Overtrue\LaravelFollow\Traits\CanSubscribe;
use Overtrue\LaravelFollow\Traits\CanBeSubscribed;
use Overtrue\LaravelFollow\Traits\CanLike;
use Actuallymab\LaravelComment\CanComment;
use Overtrue\LaravelFollow\Traits\CanBookmark;

class User extends Authenticatable
{
    use Notifiable, 
        CanSubscribe, 
        CanBeSubscribed, 
        CanLike, 
        CanComment,
        CanBookmark;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The event map for the model
     * 
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => UserCreated::class
    ];

    /**
     * Profile relationship
     */
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    /**
     * Posts relationship
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    /**
     * Comments relationship
     */
    public function comments()
    {
        return $this->hasMany(Comment::class, 'commented_id');
    }
}
