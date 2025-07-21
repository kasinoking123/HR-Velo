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
            'nama'              => 'required|string|max:255',
            'nip'               => 'required|string|max:50|unique:pegawais,nip',
            'jenis_kelamin'     => 'required|in:L,P',
            'tempat_lahir'      => 'required|string|max:100',
            'tanggal_lahir'     => 'required|date|before:today',
            'jabatan'           => 'required|string|max:100',
            'departemen'        => 'required|string|max:100',
            'tanggal_masuk'     => 'required|date|before_or_equal:today',
            'status'            => 'required|in:aktif,cuti,nonaktif',
            'email'             => 'nullable|email|max:255',
            'telepon'           => 'nullable|string|max:20',
            'kontak_darurat'    => 'nullable|string|max:100',
            'npwp'              => 'nullable|string|max:30',
            'no_rek'            => 'nullable|string|max:30',
            'alamat'            => 'nullable|string|max:500',
            'keterangan'        => 'nullable|string|max:1000',
            'foto'              => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
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
           
                $validated = $request->validate([
                    'nama'              => 'required|string|max:255',
                    'jenis_kelamin'     => 'required|in:L,P',
                    'tempat_lahir'      => 'required|string|max:100',
                    'tanggal_lahir'     => 'required|date|before:today',
                    'jabatan'           => 'required|string|max:100',
                    'departemen'        => 'required|string|max:100',
                    'tanggal_masuk'     => 'required|date|before_or_equal:today',
                    'status'            => 'required|in:aktif,cuti,nonaktif',
                    'email'             => 'nullable|email|max:255',
                    'telepon'           => 'nullable|string|max:20',
                    'kontak_darurat'    => 'nullable|string|max:100',
                    'npwp'              => 'nullable|string|max:30',
                    'no_rek'            => 'nullable|string|max:30',
                    'alamat'            => 'nullable|string|max:500',
                    'keterangan'        => 'nullable|string|max:1000',
                    // 'foto'              => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
                    // tambahkan validasi lainnya
                ]);

                $pegawai = Pegawai::findOrFail($id);
                $pegawai->update($validated);

                return redirect('/pegawai')->with('success', 'Data berhasil diupdate');

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
