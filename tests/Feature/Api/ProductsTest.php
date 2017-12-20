<?php

namespace Tests\Feature\Api;

use DatabaseSeeder;
use shiraishi\User;
use Tests\TestCase;
use tsumugi\Testing\DataStructures;
use tsumugi\Testing\JwtAuthentication;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductsTest extends TestCase
{
    use RefreshDatabase, WithFaker, JwtAuthentication, DataStructures;

    public function setUp()
    {
        parent::setUp();

        $this->seed(DatabaseSeeder::class);
        $this->user = User::find(1);
        $this->generateValidJwtToken();
    }

    /** @test */
    public function it_lets_me_fetch_products()
    {
        $response = $this->withHeader('Authorization', 'Bearer ' . $this->token)
                         ->getJson('/api/products');

        $response->assertStatus(200)
                 ->assertJsonStructure($this->productStructure);
    }
}
