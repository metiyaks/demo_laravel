<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
        
        $response = $this->get('/users/profile');

        $response->assertStatus(200);
        
        $response = $this->get('/export-users');

        $response->assertStatus(200);
    }
}
