<?php

use shiraishi\User;
use Faker\Generator as Faker;

$factory->define(shiraishi\Product::class, function (Faker $faker) {
    $users = User::role('merchant')
                 ->pluck('id')
                 ->toArray();

    return [
        'user_id'     => $faker->randomElement($users),
        'name'        => $faker->company,
        'description' => $faker->paragraph(),
        // Currency is stored in ints here.
        'price'       => $faker->randomNumber(5),
        'image'       => sprintf('https://picsum.photos/400?image=%s', $faker->numberBetween(0, 400)),
    ];
});
