<?php

use Illuminate\Database\Seeder;
use shiraishi\User;

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
