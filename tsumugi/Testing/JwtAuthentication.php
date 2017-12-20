<?php

namespace tsumugi\Testing;

/** @codeCoverageIgnore */
trait JwtAuthentication
{
    /**
     * @var \shiraishi\User
     */
    protected $user;

    /**
     * @var string
     */
    protected $token;

    /**
     * "Log" the user in.
     *
     * @return void
     *
     * @throws \Exception
     */
    protected function generateValidJwtToken()
    {
        $response = $this->postJson('/api/auth/login', [
            'email'    => $this->user->email,
            'password' => 'changeme',
        ]);

        $this->token = $response->decodeResponseJson()['access_token'];
    }
}
