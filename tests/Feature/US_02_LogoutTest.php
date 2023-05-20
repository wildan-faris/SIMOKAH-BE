<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class US_02_LogoutTest extends TestCase
{
    use RefreshDatabase;

    public function login_action($fromURL, $toURL, $data ){
        return $this->from($fromURL)->post($toURL, $data);
    }

    public function test_admin_dapat_mengakses_laman_dashboard_admin()
    {
        // login
        $response = $this->login_action('/admin/loginIndex', '/admin/login', [
            'name' => $this->admin->name,
            'password' => 'password_admin'
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertViewIs('index');
    }

    public function test_admin_dapat_melakukan_logout()
    {
        $response = $this->login_action('/admin/loginIndex', '/admin/login', [
            'name' => $this->admin->name,
            'password' => 'password_admin'
        ]);

        $response = $this->from('/')->get('/admin/logout');

        $response->assertStatus(302);
        $response->assertRedirect('/admin/loginIndex');
        $response->assertSessionHas('success', 'berhasil logout');
    }

    public function test_kepala_sekolah_dapat_mengakses_laman_dashboard_admin()
    {
        $response = $this->login_action('/kepala-sekolah/loginIndex', '/kepala-sekolah/login', [
            'email' => $this->kepala_sekolah->email,
            'password' => 'password_kepala_sekolah'
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertViewIs('index');
    }

    public function test_kepala_sekolah_dapat_melakukan_logout()
    {
        $response = $this->login_action('/kepala-sekolah/loginIndex', '/kepala-sekolah/login', [
            'email' => $this->kepala_sekolah->email,
            'password' => 'password_kepala_sekolah'
        ]);

        $response = $this->from('/')->get('/kepala-sekolah/logout');

        $response->assertStatus(302);
        $response->assertRedirect('/kepala-sekolah/loginIndex');
        $response->assertSessionHas('success', 'berhasil logout');
    }
}
