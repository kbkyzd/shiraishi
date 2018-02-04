<?php

namespace Tests\Feature;

use Tests\TestCase;

class SanityTest extends TestCase
{
    /** @test */
    public function it_works()
    {
        $response = $this->get('/');

        $response->assertStatus(302);
    }
}
