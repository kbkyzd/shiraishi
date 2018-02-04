<?php

namespace tsumugi\Repositories;

use shiraishi\User;
use Spatie\Activitylog\Models\Activity;

class UserRepository
{
    /**
     * @param array $data
     * @return \shiraishi\User
     */
    public function createUser(array $data)
    {
        $filtered = array_only($data, [
            'name',
            'email',
            'password',
        ]);

        $user = User::create($filtered);
        $user->assignRole('user');

        return $user;
    }

    public function update()
    {
    }

//    public function logs(User $user)
//    {
//        return Activity::inLog('user')
//                       ->where('causer_id', $user->id)
//                       ->get();
//    }
}
