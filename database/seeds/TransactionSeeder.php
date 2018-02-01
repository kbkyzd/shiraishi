<?php

use Illuminate\Database\Seeder;
use shiraishi\Transaction;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Transaction::class, 30)->create();
    }
}
