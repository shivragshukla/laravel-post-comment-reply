<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Avihs\PostReply\Models\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
     	'title' => $faker->sentence,
        'description' => $faker->text,
        'user_id' => factory(App\User::class)->create()->id,
        'status' => $faker->numberBetween($min = 0, $max = 1)
    ];
});
