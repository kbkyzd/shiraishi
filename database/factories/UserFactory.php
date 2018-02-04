<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(shiraishi\User::class, function (Faker $faker) {
    return [
        'name'     => $faker->name,
        'email'    => $faker->unique()->safeEmail,
        'image'    => sprintf('https://picsum.photos/400?random&rand=%s', $faker->numberBetween(100, 200)),
        'contact'  => $faker->phoneNumber,
        'password' => '$2y$10$91mBOtqPoPOz3oQeppATcOG0v97/btdAjZmR2GjPnogOMLEYsgcFS', // changeme
    ];
});
