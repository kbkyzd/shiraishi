<?php

namespace Tests\Feature;

use shiraishi\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class JwtAuthenticationTest extends TestCase
{
    use RefreshDatabase;

    protected $defaultHeaders = [
        'Accept' => 'application/x.shiraishi.v1+json',
    ];

    /** @test */
    public function it_issues_a_valid_token_when_presented_with_valid_credentials()
    {
        $user = factory(User::class)->create();

        $response = $this->postJson('/api/auth/login', [
            'email'    => $user->email,
            'password' => 'changeme',
        ]);

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'access_token',
                     'token_type',
                     'expires_in',
                 ]);
    }

    public function it_denies_on_invalid_credentials()
    {
        $response = $this->postJson('/api/auth/login', [
            'email'    => 'xd@xd.xd',
            'password' => 'asdasd',
        ]);

        $response->assertStatus(401);
    }
}
