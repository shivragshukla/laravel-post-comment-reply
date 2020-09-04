<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Avihs\PostReply\Models\Comment;
use Avihs\PostReply\Models\Post;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'post_id' =>  factory(Post::class)->create()->id
    ];
});
