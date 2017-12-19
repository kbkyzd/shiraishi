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
        $this->testUsers();

        factory(User::class, 10)->create()
                                ->each(function (User $user) {
                                    $user->assignRole('merchant');
                                });

        factory(User::class, 20)->create()
                                ->each(function (User $user) {
                                    $user->assignRole('user');
                                });
    }

    /**
     * Seed hardcoded test users.
     *
     * @return void
     */
    public function testUsers()
    {
        $admin = User::create([
            'name'     => 'Amatsuka Mao',
            'email'    => 'mao@m.m',
            'password' => bcrypt('changeme'),
        ]);

        $merchant = User::create([
            'name'     => 'Thomas',
            'email'    => 'thomas@t.t',
            'password' => bcrypt('changeme'),
        ]);

        $user = User::create([
            'name'     => 'Shaun',
            'email'    => 'shaun@s.s',
            'password' => bcrypt('changeme'),
        ]);

        $admin->assignRole('root');
        $merchant->assignRole('merchant');
        $user->assignRole('user');
    }
}
