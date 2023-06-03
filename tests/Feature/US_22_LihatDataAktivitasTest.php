<?php

namespace Tests\Feature;

use App\Models\Aktivitas;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class US_22_LihatDataAktivitasTest extends TestCase
{
    public function test_Admin_dapat_melihat_data_aktifitas()
    {
        // login
        $response = $this->from('/admin/loginIndex')->post('/admin/login', [
            'name' => $this->admin->name,
            'password' => "password_admin",
        ]);

        $response->dumpSession();

        // request
        $response = $this->get('/aktivitas/index');

        $aktivitas = Aktivitas::factory(5)->create();


        // response assert
        $response->assertStatus(200);
        $response->assertViewIs('aktivitas.index');
        $response->assertViewHas('data_aktivitas');

        foreach ($aktivitas as $a ) {
            $response->assertSee($a->name);
        }
    }
}
