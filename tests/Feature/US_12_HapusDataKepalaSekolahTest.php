<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class US_12_HapusDataKepalaSekolahTest extends TestCase
{

    public function test_admin_dapat_menghapus_data_kepala_sekolah()
    {
        // login
        $response = $this->from('/admin/loginIndex')->post('/admin/login', [
            'name' => $this->admin->name,
            'password' => "password_admin",
        ]);

        // request
        $response = $this->from('/kepala-sekolah/index')->get('/kepala-sekolah/delete/'. $this->kepala_sekolah->id);

        // response assert
        $response->assertStatus(302);
        $response->assertRedirect('/kepala-sekolah/index');
        $response->assertSessionHas('success_delete', 'Berhasil Menghapus Data');

        // database assert
        $this->assertDatabaseMissing('kepala_sekolahs', [
            'id' => $this->kepala_sekolah->id,
            'name' => $this->kepala_sekolah->name,
            'email' => $this->kepala_sekolah->email,
        ]);
    }
}
