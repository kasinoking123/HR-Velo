<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Container\Attributes\Log;
use Illuminate\Support\Facades\DB;


class PegawaiController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $sortField = $request->input('sort', 'nama'); // Default sort by nama
        $sortDirection = $request->input('direction', 'asc'); // Default asc

        $pegawais = Pegawai::when($search, function ($query, $search) {
        return $query->where('nip', 'like', "%{$search}%")
                   ->orWhere('nama', 'like', "%{$search}%")
                   ->orWhere('jabatan', 'like', "%{$search}%")
                   ->orWhere('departemen', 'like', "%{$search}%");
        })
        ->orderBy($sortField, $sortDirection)
        ->paginate(5);

        // $pegawais = Pegawai::paginate(5);
        // $pegawais->paginate(5);
        return view('pegawai.pegawai_index', compact('pegawais', 'search', 'sortField', 'sortDirection'));
    }

    // Menampilkan form tambah pegawai
    public function create()
    {
        return response()->view('/pegawai/pegawai_create');
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
        return response()->view('/pegawai/pegawai_show', ['pegawai' => $pegawai]);
    }

    // Menampilkan form edit
    public function edit($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        return response()->view('/pegawai/pegawai_edit', ['pegawai' => $pegawai]);
    }

    // Update data pegawai
    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'nama' => 'required|max:100',
                'jenis_kelamin' => 'required|in:L,P',
                // tambahkan validasi lainnya
            ]);

            $pegawai = Pegawai::findOrFail($id);
            $pegawai->update($validated);

            return redirect('/pegawai')->with('success', 'Data berhasil diupdate');

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengupdate data: '.$e->getMessage());
        }
    }

    // Hapus pegawai
    public function destroy($id)
    {
        try{
            Pegawai::destroy($id);
            return redirect('/pegawai')->with('success','Data Berhasil dihapus');
        }
        catch(\Exception $e){
             return back()->with('error', 'Gagal mengupdate data: '.$e->getMessage());
        }
       
    }
}
