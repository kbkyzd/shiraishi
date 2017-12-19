<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SanityTest extends TestCase
{
    /** @test */
    public function it_works()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
