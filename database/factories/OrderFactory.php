<?php

use shiraishi\User;
use Faker\Generator as Faker;

$factory->define(shiraishi\Order::class, function (Faker $faker) {
    $users = User::role('user')
                 ->pluck('id')
                 ->toArray();

    return [
        'user_id'      => $faker->randomElement($users),
        'processed_at' => $faker->optional(0.5)->dateTimeBetween('-5 days'),
    ];
});
