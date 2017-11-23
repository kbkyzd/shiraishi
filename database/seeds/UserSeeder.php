<?php

use shiraishi\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'     => 'Amatsuka Mao',
            'email'    => 'mao@mao.mao',
            'password' => bcrypt('changeme'),
        ]);
    }
}
