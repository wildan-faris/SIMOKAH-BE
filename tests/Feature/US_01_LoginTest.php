<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class US_01_LoginTest extends TestCase
{
    // use RefreshDatabase;

    public function test_admin_dapat_mengakses_laman_login()
    {

        $response = $this->get('/admin/loginIndex');

        $response->assertStatus(200);
        $response->assertViewIs('admin.login');

    }

    public function test_admin_dapat_melakukan_login()
    {

        $response = $this->from('/admin/loginIndex')->post('/admin/login', [
            'name' => $this->admin->name,
            'password' => "password_admin",
        ]);
        $response->assertRedirect();
        $response->assertSessionHas('name', $this->admin->name);
        $response->assertSessionHas('remember_token', $this->admin->remember_token);
        $response->assertSessionHas('role', "admin");

    }

    public function test_admin_tidak_dapat_melakukan_login_dengan_nama_yang_salah()
    {

        info($this->admin->email);

        $response = $this->from('/admin/loginIndex')->post('/admin/login', [
            'name' => "nama_admin_salah",
            'password' => "password_admin",
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('failed', 'gagal login');

    }

    public function test_admin_tidak_dapat_melakukan_login_dengan_password_yang_salah()
    {

        info($this->admin->email);

        $response = $this->from('/admin/loginIndex')->post('/admin/login', [
            'name' => $this->admin->name,
            'password' => "password_admin_salah",
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('failed', 'gagal login');

    }

    // Kepsek
    public function kepala_sekolah_dapat_mengakses_laman_login()
    {

        $response = $this->get('/kepala-sekolah/loginIndex');

        $response->assertStatus(200);
        $response->assertViewIs('kepala_sekolah.login');

    }

    public function test_kepala_sekolah_dapat_melakukan_login()
    {

        $response = $this->from('/kepala-sekolah/loginIndex')->post('/kepala-sekolah/login', [
            'email' => $this->kepala_sekolah->email,
            'password' => "password_kepala_sekolah",
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('name', $this->kepala_sekolah->name);
        $response->assertSessionHas('remember_token', $this->kepala_sekolah->remember_token);
        $response->assertSessionHas('role', "kepala sekolah");

    }

    public function test_kepala_sekolah_tidak_dapat_melakukan_login_dengan_nama_yang_salah()
    {

        $response = $this->from('/kepala-sekolah/loginIndex')->post('/kepala-sekolah/login', [
            'email' => "email_kepala_sekolah_salah",
            'password' => "password_kepala_sekolah",
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('failed', 'gagal login, email tidak ada');

    }

    public function test_kepala_sekolah_tidak_dapat_melakukan_login_dengan_password_yang_salah()
    {

        info($this->kepala_sekolah->email);

        $response = $this->from('/kepala-sekolah/loginIndex')->post('/kepala-sekolah/login', [
            'email' => $this->kepala_sekolah->email,
            'password' => "password_kepala_sekolah_salah",
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('failed', 'gagal login');

    }
}
