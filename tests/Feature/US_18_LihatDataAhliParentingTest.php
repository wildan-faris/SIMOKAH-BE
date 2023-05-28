<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class US_18_LihatDataAhliParentingTest extends TestCase
{
    public function test_Admin_dapat_melihat_data_ahli_parenting()
    {
        // login
        $response = $this->from('/admin/loginIndex')->post('/admin/login', [
            'name' => $this->admin->name,
            'password' => "password_admin",
        ]);

        // request
        $response = $this->get('/ahli-parenting/index');

        // response assert
        $response->assertStatus(200);
        $response->assertViewIs('ahli_parenting.index');
        $response->assertViewHas('data_ahli_parenting');
        $response->assertSee($this->ahli_parenting->email);
        $response->assertSee($this->ahli_parenting->name);
    }
}
