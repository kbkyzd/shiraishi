<?php

namespace Tests\Feature;

use shiraishi\User;
use Tests\TestCase;
use tsumugi\Testing\JwtAuthentication;
use Illuminate\Foundation\Testing\RefreshDatabase;

class JwtAuthenticationTest extends TestCase
{
    use RefreshDatabase, JwtAuthentication;

    /**
     * @var array
     */
    private $blacklistedToken = [
        'message'     => 'The token has been blacklisted',
        'status_code' => 401,
    ];

    /**
     * @var array
     */
    private $accessTokenStructure = [
        'access_token',
        'token_type',
        'expires_in',
    ];

    public function setUp()
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
        $this->generateValidJwtToken();
    }

    /** @test */
    public function it_issues_a_valid_token_when_presented_with_valid_credentials()
    {
        $response = $this->postJson('/api/auth/login', [
            'email'    => $this->user->email,
            'password' => 'changeme',
        ]);

        $response->assertStatus(200)
                 ->assertJsonStructure($this->accessTokenStructure);
    }

    /** @test */
    public function it_denies_on_invalid_credentials()
    {
        $response = $this->postJson('/api/auth/login', [
            'email'    => 'xd@xd.xd',
            'password' => 'asdasd',
        ]);

        $response->assertStatus(401);
    }

    /** @test */
    public function it_identifies_the_user()
    {
        $response = $this->withHeader('Authorization', 'Bearer ' . $this->token)
                         ->getJson('/api/auth/me');

        $response->assertStatus(200)
                 ->assertJson([
                     'user' => [
                         'id'         => $this->user->id,
                         'name'       => $this->user->name,
                         'email'      => $this->user->email,
                         'created_at' => (string) $this->user->created_at,
                         'updated_at' => (string) $this->user->updated_at,
                     ],
                 ]);
    }

    /** @test */
    public function it_allows_the_token_to_be_refreshed()
    {
        $response = $this->withHeader('Authorization', 'Bearer ' . $this->token)
                         ->postJson('/api/auth/refresh');

        $response->assertStatus(200)
                 ->assertJsonStructure($this->accessTokenStructure);
    }

    /** @test */
    public function it_allows_the_token_to_be_invalidated()
    {
        // Testing of whether the token is still usable should be done in dusk
        $response = $this->withHeader('Authorization', 'Bearer ' . $this->token)
                         ->postJson('/api/auth/logout');

        $response->assertStatus(200)
                 ->assertJson([
                     'message'     => 'Token invalidated.',
                     'status_code' => 200,
                 ]);
    }
}
