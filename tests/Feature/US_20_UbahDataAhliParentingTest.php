<?php

namespace Tests\Feature;

use App\Models\AhliParenting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class US_20_UbahDataAhliParentingTest extends TestCase
{
    public function test_admin_dapat_mengubah_data_ahli_parenting()
    {
        // login as admin
        $response = $this->from('/admin/loginIndex')->post('/admin/login', [
            'name' => $this->admin->name,
            'password' => "password_admin",
        ]);

        $ahli_parenting_target = AhliParenting::create([
            'name' => $this->faker()->name(),
            'email' => $this->faker()->email(),
            'password' => $this->faker()->password(),
            'photo_profil' => "https://upload.wikimedia.org/wikipedia/commons/thumb/2/2c/Default_pfp.svg/1200px-Default_pfp.svg.png",
        ]);

        $request = [
            'id' => $ahli_parenting_target->id,
            'name' => $this->faker()->name(),
            'email' => $this->faker()->email(),
        ];

        $response = $this->post('/ahli-parenting/edit', $request);

        $response->assertStatus(302);
        $response->assertRedirect('/ahli-parenting/index');
        $response->assertSessionHas("success_edit", "Berhasil Mengubah Data");
        $this->assertDatabaseHas('ahli_parentings', [
            'id' => $ahli_parenting_target->id,
            'name' => $request["name"],
            'email' => $request["email"],
        ]);
    }
}
