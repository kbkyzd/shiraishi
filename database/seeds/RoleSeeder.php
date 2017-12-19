<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            'admin',
            'merchant',
            'user',
        ];

        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }
    }
}
