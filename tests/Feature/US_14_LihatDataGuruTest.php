<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class US_14_LihatDataGuruTest extends TestCase
{
    public function test_Admin_dapat_melihat_data_guru()
    {
        // login
        $response = $this->from('/admin/loginIndex')->post('/admin/login', [
            'name' => $this->admin->name,
            'password' => "password_admin",
        ]);

        // request
        $response = $this->get('/guru/index');

        // response assert
        $response->assertStatus(200);
        $response->assertViewIs('guru.index');
        $response->assertViewHas('data_guru');
        $response->assertSee($this->guru->email);
        $response->assertSee($this->guru->name);
    }
}
