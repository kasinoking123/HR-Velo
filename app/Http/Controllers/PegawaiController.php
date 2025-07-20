<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;


class PegawaiController extends Controller
{
    public function index()
    {
        $pegawais = Pegawai::all();
        return response()->view('/pegawai/pegawai_index', ['pegawais' => $pegawais])
            ->header('Content-Type', 'text/html');
    }

    // Menampilkan form tambah pegawai
    public function create()
    {
        return response()->view('/pegawai/pegawai_create')
            ->header('Content-Type', 'text/html');
    }

    // Menyimpan pegawai baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nip' => 'required|unique:pegawai|max:20',
            'nama' => 'required|max:100',
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir' => 'required|max:50',
            'tanggal_lahir' => 'required|date',
            'jabatan' => 'required|max:50',
            'departemen' => 'required|max:50',
            'tanggal_masuk' => 'required|date',
            'email' => 'required|email|unique:pegawai',
            'telepon' => 'required|max:15',
            'alamat' => 'required',
        ]);

        Pegawai::create($validated);

        return redirect('/pegawai');
    }

    // Menampilkan detail pegawai
    public function show($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        return response()->view('/pegawai/pegawai_show', ['pegawai' => $pegawai])
            ->header('Content-Type', 'text/html');
    }

    // Menampilkan form edit
    public function edit($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        return response()->view('/pegawai/pegawai_edit', ['pegawai' => $pegawai])
            ->header('Content-Type', 'text/html');
    }

    // Update data pegawai
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required|max:100',
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir' => 'required|max:50',
            'tanggal_lahir' => 'required|date',
            'jabatan' => 'required|max:50',
            'departemen' => 'required|max:50',
            'tanggal_masuk' => 'required|date',
            'email' => 'required|email|unique:pegawai,email,'.$id,
            'telepon' => 'required|max:15',
            'alamat' => 'required',
        ]);

        Pegawai::where('id', $id)->update($validated);

        return redirect('/pegawai');
    }

    // Hapus pegawai
    public function destroy($id)
    {
        Pegawai::destroy($id);
        return redirect('/pegawai');
    }
}
