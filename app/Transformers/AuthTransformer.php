<?php

namespace shiraishi\Transformers;

use League\Fractal\TransformerAbstract;

class AuthTransformer extends TransformerAbstract
{
    public function transform($auth)
    {
        return [
            'access_token' => $auth->token,
            'token_type'   => 'bearer',
            'expires_in'   => $auth->ttl,
        ];
    }
}
