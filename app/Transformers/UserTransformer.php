<?php

namespace shiraishi\Transformers;

use shiraishi\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    public function transform(User $user)
    {
        return [
            'id'         => $user->id,
            'name'       => $user->name,
            'email'      => $user->email,
            'contact'    => $user->contact,
            'created_at' => (string) $user->created_at,
            'updated_at' => (string) $user->updated_at,
            'role'       => $user->getRoleNames()[0],
        ];
    }
}
