<?php

namespace Tests\Feature;

use DatabaseSeeder;
use shiraishi\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RestrictedRoutesTest extends TestCase
{
    use RefreshDatabase;

    public function setUp()
    {
        parent::setUp();

        $this->seed(DatabaseSeeder::class);
    }

    /** @test */
    public function it_restricts_horizon()
    {
        $firstUser = User::find(1);
        $response = $this->actingAs($firstUser)
                         ->get('/horizon');

        $response->assertStatus(200);
    }
}
