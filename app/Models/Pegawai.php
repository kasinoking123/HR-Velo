<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pegawai extends Model
{
    use SoftDeletes;

    protected $table = 'pegawai';
    
    protected $fillable = [
        'nip',
        'nama',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'jabatan',
        'departemen',
        'tanggal_masuk',
        'status',
        'email',
        'telepon',
        'kontak_darurat',
        'npwp',
        'no_rek',
        'alamat',
        'foto',
        'keterangan'
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'tanggal_masuk' => 'date'
    ];

    public static $jenisKelaminOptions = 
    [
        'L' => 'Laki-laki',
        'P' => 'Perempuan'
    ];

    public static $statusOptions = [
        'aktif' => 'Aktif',
        'non-aktif' => 'Non-Aktif',
        'cuti' => 'Cuti'
    ];          

}
