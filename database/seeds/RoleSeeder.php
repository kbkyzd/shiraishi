<?php

use shiraishi\Acl\Role;
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
            'root',
            'merchant',
            'user',
        ];

        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }
    }
}
