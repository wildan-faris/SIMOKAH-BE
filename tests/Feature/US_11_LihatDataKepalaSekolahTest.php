<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class US_11_LihatDataKepalaSekolahTest extends TestCase
{

    public function test_Admin_dapat_melihat_data_kepala_sekolah()
    {
        // login
        Auth::login($this->admin);

        // request
        $response = $this->get('/kepala-sekolah/index');

        // response assert
        $response->assertStatus(200);
        $response->assertViewIs('kepala_sekolah.index');
        $response->assertViewHas('data_kepala_sekolah');
        $response->assertSee($this->kepala_sekolah->email);
        $response->assertSee($this->kepala_sekolah->name);
    }
}
