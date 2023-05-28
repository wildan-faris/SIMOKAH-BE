<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class US_03_ChangePasswordTest extends TestCase
{
    // use RefreshDatabase;

    public function test_guru_dapat_mengubah_password()
    {
        Auth::login($this->guru);

        $oldPassword = $this->guru->password;

        $response = $this->put('/api/guru/' . $this->guru->id, [
            'password' => 'password_guru_baru'
        ]);

        $response->assertStatus(200);
        $response->assertJson(['message' => 'success update data user']);
        $this->assertDatabaseMissing('gurus', [
            'id' => $this->orang_tua->id,
            'password' => $oldPassword
        ]);
    }

    public function test_orang_tua_dapat_mengubah_password()
    {
        Auth::login($this->orang_tua);

        $oldPassword = $this->orang_tua->password;

        $response = $this->put('/api/orang-tua/' . $this->orang_tua->id, [
            'password' => 'password_orang_tua_baru'
        ]);

        $response->assertStatus(200);
        $response->assertJson(['message' => 'success update data user']);
        $this->assertDatabaseMissing('orang_tuas', [
            'id' => $this->orang_tua->id,
            'password' => $oldPassword
        ]);
    }
}
