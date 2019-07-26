<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Comment;
use App\User;
use App\Post;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'body' => $faker->realText(100),
        'user_id' => User::inRandomOrder()->first(),
        'post_id' => Post::inRandomOrder()->first()
    ];
});
