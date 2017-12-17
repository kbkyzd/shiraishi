<?php

use shiraishi\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $exampleTags = [
            'clothes',
            'food',
            'music',
            'toys',
            'sports',
            'electronics',
        ];

        $products = factory(Product::class, 50)->create();

        foreach ($products as $product) {
            $product->tag(array_random($exampleTags));
        }
    }
}
