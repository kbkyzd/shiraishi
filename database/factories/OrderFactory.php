<?php

use Faker\Generator as Faker;
use shiraishi\User;

$factory->define(shiraishi\Order::class, function (Faker $faker) {
    $users = User::role('user')
                 ->pluck('id')
                 ->toArray();

    return [
        'user_id'      => $faker->randomElement($users),
        'processed_at' => $faker->optional(0.5)->dateTimeBetween('-5 days'),
    ];
});
