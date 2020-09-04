<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Avihs\PostReply\Models\Comment;
use Avihs\PostReply\Models\Reply;
use Faker\Generator as Faker;

$factory->define(Reply::class, function (Faker $faker) {
    return [
        'comment_id' => factory(Comment::class)->create()->id
    ];
});
