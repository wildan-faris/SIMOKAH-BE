<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UsersApiTest extends TestCase
{
    /**
     * Test GET /api/users endpoint.
     *
     * @return void
     */
    public function testGetUserById()
    {
        // Create a user
        $user = User::factory()->create();

        // Send a GET request to the API endpoint with the user ID
        $response = $this->get('/api/user/get-profil/' . $user->id);

        // Assert that the response status code is 200
        $response->assertStatus(200);

        // Assert that the response contains the user data
        $response->assertJsonFragment([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
        ]);
    }
}
