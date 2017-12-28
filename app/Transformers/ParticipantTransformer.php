<?php

namespace shiraishi\Transformers;

use shiraishi\User;
use League\Fractal\TransformerAbstract;

class ParticipantTransformer extends TransformerAbstract
{
    public function transform(User $chat)
    {
        return [
            'id'    => $chat->id,
            'name'  => $chat->name,
            'email' => $chat->email,
        ];
    }
}
