<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class US_03_ChangePasswordTest extends TestCase
{
    use RefreshDatabase;

    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
