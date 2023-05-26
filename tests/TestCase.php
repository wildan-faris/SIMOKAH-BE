<?php

namespace Tests;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\WithFaker;

// models
use App\Models\Admin;
use App\Models\AhliParenting;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\KepalaSekolah;
use App\Models\OrangTua;
use App\Models\Siswa;
use Illuminate\Foundation\Testing\RefreshDatabase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use WithFaker;
    use RefreshDatabase;

    public Kelas $kelas;

    public KepalaSekolah $kepala_sekolah;
    public AhliParenting $ahli_parenting;
    public Guru $guru;
    public OrangTua $orang_tua;
    public Admin $admin;
    public Siswa $siswa;

    public function generate_remember_token(){
        return Str::random(60);
    }


    protected function setUp(): void
    {
        parent::setUp();

        Admin::insert([
            "name" => 'nama_admin',
            "password" => Hash::make("password_admin"),
            'remember_token' => Str::random(60),
            'photo_profil' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/2/2c/Default_pfp.svg/1200px-Default_pfp.svg.png'
        ]);
        $this->admin = Admin::first();

        Guru::insert([
            'name' => "nama_guru",
            'username' => "username_guru",
            'email' => "guru@gmail.com",
            'password' => Hash::make("password_guru"),
            'photo_profil' => "https://upload.wikimedia.org/wikipedia/commons/thumb/2/2c/Default_pfp.svg/1200px-Default_pfp.svg.png",
        ]);
        $this->guru = Guru::first();

        Kelas::insert([
            "name" => "nama_kelas",
            "guru_id" => $this->guru->id
        ]);
        $this->kelas = Kelas::first();

        KepalaSekolah::insert([
            'name' => "nama_kepala_sekolah",
            'email' => "kepala_sekolah@gmail.com",
            'password' => Hash::make("password_kepala_sekolah"),
            'remember_token' => Str::random(60),
            'photo_profil' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/2/2c/Default_pfp.svg/1200px-Default_pfp.svg.png'
        ]);
        $this->kepala_sekolah = KepalaSekolah::first();

        AhliParenting::insert([
            'name' => "nama_ahli_parenting",
            'email' => "ahli_parenting@gmail.com",
            'password' => Hash::make("password_ahli_parenting"),
            'photo_profil' => "https://upload.wikimedia.org/wikipedia/commons/thumb/2/2c/Default_pfp.svg/1200px-Default_pfp.svg.png",
        ]);
        $this->ahli_parenting = AhliParenting::first();

        OrangTua::insert([
            'name' => "nama_orang_tua",
            'username' => "username_orang_tua",
            'email' => "orang_tua@gmail.com",
            'password' => Hash::make("passowrd_orang_tua"),
            'photo_profil' => "https://upload.wikimedia.org/wikipedia/commons/thumb/2/2c/Default_pfp.svg/1200px-Default_pfp.svg.png",
            'pekerjaan' => "pekerjaan_orang_tua",
            'alamat' => "alamat_orang_tua",
            'no_hp' => "no_hp_orang_tua",
        ]);
        $this->orang_tua = OrangTua::first();

        Siswa::insert([
            "name" => "name_siswa",
            "nis" => $this->faker()->randomNumber(5),
            "jenis_kelamin" => "jenis_kelamin_siswa",
            "tempat_lahir" => "tempat_lahir_siswa",
            "tanggal_lahir" => $this->faker()->date(),
            "orang_tua_id" => $this->orang_tua->id,
            "kelas_id" => $this->kelas->id,
            "tahun_ajaran" => 2020
        ]);
        $this->siswa = Siswa::first();

    }

}
