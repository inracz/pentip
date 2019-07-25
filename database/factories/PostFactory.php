<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Post;
use App\User;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    
    $faker->addProvider(new BlogArticleFaker\FakerProvider($faker));

    return [
        'title' => $faker->articleTitle,
        'description' => $faker->realText(250),
        'content' => $faker->articleContentMarkdown
    ];
});
