<?php

use shiraishi\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    protected $exampleTags = [
        'Art',
        'Automotive',
        'Baby',
        'Clothes',
        'Electronics',
        'Food',
        'Health',
        'Jewelry',
        'Music',
        'Outdoors',
        'Sports',
        'Toys',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $products = factory(Product::class, 50)->create();

        /** @var Product $product */
        foreach ($products as $product) {
            $product->tag(
                $faker->randomElements($this->exampleTags, $faker->numberBetween(1, 4))
            );
        }
    }
}
