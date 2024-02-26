<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    
}
