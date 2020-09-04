<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Avihs\PostReply\Models\Reply;
use Avihs\PostReply\Models\Comment;
use Avihs\PostReply\Models\Message;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Message::class, function (Faker $faker) {

    $messageable = [ Comment::class, Reply::class ]; 
    $messageableType = $faker->randomElement($messageable);
    $messageable = factory($messageableType)->create();

    return [
        'content' => $faker->sentence,
        'user_id' => factory(App\User::class)->create()->id,
        'status' => $faker->numberBetween($min = 0, $max = 1),
        'messageable_id' => $messageable->id,
        'messageable_type' => Str::of($messageableType)->afterLast('\\')->plural()
    ];
});
