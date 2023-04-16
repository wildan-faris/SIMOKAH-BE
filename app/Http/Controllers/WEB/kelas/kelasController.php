<?php

namespace App\Http\Controllers\WEB\kelas;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Kelas;
use Illuminate\Http\Request;

class kelasController extends Controller
{
    public function index()
    {
        $data_kelas = Kelas::get();
        return view('kelas.index', compact("data_kelas"));
    }

    public function createIndex()
    {
        $data_guru = Guru::get();
        return view('kelas.create', compact("data_guru"));
    }

    public function create(Request $request)
    {

        Kelas::insert([
            'name' => $request->name,
            'guru_id' => $request->guru_id,
        ]);
        return redirect('/kelas/index')->with("success_create", "Berhasil Menambahkan Data");
    }
}
