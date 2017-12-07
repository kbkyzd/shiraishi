<?php

use Faker\Generator as Faker;
use shiraishi\User;

$factory->define(shiraishi\Product::class, function (Faker $faker) {
    $users = User::pluck('id')
                 ->toArray();

    return [
        'user_id'     => $faker->randomElement($users),
        'name'        => $faker->company,
        'description' => $faker->paragraph(),
    ];
});
