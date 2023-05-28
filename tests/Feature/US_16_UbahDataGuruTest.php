<?php

namespace Tests\Feature;

use App\Models\Guru;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class US_16_UbahDataGuruTest extends TestCase
{
    public function test_admin_dapat_mengubah_data_guru()
    {
        // login as admin
        $response = $this->from('/admin/loginIndex')->post('/admin/login', [
            'name' => $this->admin->name,
            'password' => "password_admin",
        ]);

        $guru_target = Guru::create([
            'name' => $this->faker()->name(),
            'username' => $this->faker()->userName(),
            'email' => $this->faker()->email(),
            'password' => $this->faker()->password(),
            'photo_profil' => "https://upload.wikimedia.org/wikipedia/commons/thumb/2/2c/Default_pfp.svg/1200px-Default_pfp.svg.png",
        ]);

        $request = [
            'id' => $guru_target->id,
            'name' => $this->faker()->name(),
            'username' => $this->faker()->userName(),
            'email' => $this->faker()->email(),
        ];

        $response = $this->post('/guru/edit', $request);

        $response->assertStatus(302);
        $response->assertRedirect('/guru/index');
        $response->assertSessionHas("success_edit", "Berhasil Mengubah Data");
        $this->assertDatabaseHas('gurus', [
            'id' => $guru_target->id,
            'name' => $request["name"],
            'username' => $request["username"],
            'email' => $request["email"],
        ]);
    }
}
