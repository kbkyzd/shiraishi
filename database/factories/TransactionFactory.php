<?php

use shiraishi\Order;
use shiraishi\Product;
use Faker\Generator as Faker;

$factory->define(shiraishi\Transaction::class, function (Faker $faker) {
    $orders = Order::pluck('id')
                   ->toArray();

    $products = Product::pluck('id')
                       ->toArray();

    return [
        'order_id'       => $faker->randomElement($orders),
        'product_id'     => $faker->unique()->randomElement($products),
        'quantity'       => $faker->numberBetween(1, 10),
        'order_snapshot' => 'snapshot',
    ];
});
