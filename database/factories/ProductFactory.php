<?php

use shiraishi\User;
use Faker\Generator as Faker;

$factory->define(shiraishi\Product::class, function (Faker $faker) {
    $users = User::pluck('id')
                 ->toArray();

    return [
        'user_id'     => $faker->randomElement($users),
        'name'        => $faker->company,
        'description' => $faker->paragraph(),
        // Currency is stored in ints here.
        'price'       => $faker->randomNumber(5),
    ];
});
