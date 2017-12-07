<?php

use Illuminate\Database\Seeder;
use shiraishi\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Product::class, 50)->create();
    }
}
