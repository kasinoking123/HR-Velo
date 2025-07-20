<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use App\Models\Pegawai;

class PegawaiSeedeer extends Seeder
{
   public function run()
    {
        $dataPegawai = [
            [
                'nip' => '199003012022011001',
                'nama' => 'Ahmad Santoso',
                'jenis_kelamin' => 'L',
                'tempat_lahir' => 'Jakarta',
                'tanggal_lahir' => Carbon::create(1990, 3, 1),
                'jabatan' => 'Manager IT',
                'departemen' => 'Teknologi Informasi',
                'tanggal_masuk' => Carbon::create(2022, 1, 10),
                'status' => 'aktif',
                'email' => 'ahmad.santoso@example.com',
                'telepon' => '081122334455',
                'alamat' => 'Jl. Merdeka No. 10, Jakarta Pusat',
                'foto' => null,
                'keterangan' => 'Pegawai berprestasi bulan lalu'
            ],
            [
                'nip' => '199105152022011002',
                'nama' => 'Budi Setiawan',
                'jenis_kelamin' => 'L',
                'tempat_lahir' => 'Bandung',
                'tanggal_lahir' => Carbon::create(1991, 5, 15),
                'jabatan' => 'Supervisor Marketing',
                'departemen' => 'Pemasaran',
                'tanggal_masuk' => Carbon::create(2022, 1, 15),
                'status' => 'aktif',
                'email' => 'budi.setiawan@example.com',
                'telepon' => '081233445566',
                'alamat' => 'Jl. Pahlawan No. 5, Bandung',
                'foto' => null,
                'keterangan' => null
            ],
            [
                'nip' => '199208202022021003',
                'nama' => 'Citra Dewi',
                'jenis_kelamin' => 'P',
                'tempat_lahir' => 'Surabaya',
                'tanggal_lahir' => Carbon::create(1992, 8, 20),
                'jabatan' => 'Staff Keuangan',
                'departemen' => 'Keuangan',
                'tanggal_masuk' => Carbon::create(2022, 2, 1),
                'status' => 'aktif',
                'email' => 'citra.dewi@example.com',
                'telepon' => '081344556677',
                'alamat' => 'Jl. Sudirman No. 22, Surabaya',
                'foto' => null,
                'keterangan' => 'Baru menikah'
            ],
            [
                'nip' => '199312122022031004',
                'nama' => 'Dian Permata',
                'jenis_kelamin' => 'P',
                'tempat_lahir' => 'Yogyakarta',
                'tanggal_lahir' => Carbon::create(1993, 12, 12),
                'jabatan' => 'HR Staff',
                'departemen' => 'HRD',
                'tanggal_masuk' => Carbon::create(2022, 3, 1),
                'status' => 'aktif',
                'email' => 'dian.permata@example.com',
                'telepon' => '081455667788',
                'alamat' => 'Jl. Malioboro No. 8, Yogyakarta',
                'foto' => null,
                'keterangan' => null
            ],
            [
                'nip' => '199404252022041005',
                'nama' => 'Eko Prasetyo',
                'jenis_kelamin' => 'L',
                'tempat_lahir' => 'Semarang',
                'tanggal_lahir' => Carbon::create(1994, 4, 25),
                'jabatan' => 'IT Support',
                'departemen' => 'Teknologi Informasi',
                'tanggal_masuk' => Carbon::create(2022, 4, 1),
                'status' => 'aktif',
                'email' => 'eko.prasetyo@example.com',
                'telepon' => '081566778899',
                'alamat' => 'Jl. Gajah Mada No. 15, Semarang',
                'foto' => null,
                'keterangan' => 'Bersertifikasi Microsoft'
            ],
            [
                'nip' => '199506302022051006',
                'nama' => 'Fitriani',
                'jenis_kelamin' => 'P',
                'tempat_lahir' => 'Medan',
                'tanggal_lahir' => Carbon::create(1995, 6, 30),
                'jabatan' => 'Admin Gudang',
                'departemen' => 'Logistik',
                'tanggal_masuk' => Carbon::create(2022, 5, 10),
                'status' => 'aktif',
                'email' => 'fitriani@example.com',
                'telepon' => '081677889900',
                'alamat' => 'Jl. Gatot Subroto No. 3, Medan',
                'foto' => null,
                'keterangan' => null
            ],
            [
                'nip' => '199611082022061007',
                'nama' => 'Gunawan',
                'jenis_kelamin' => 'L',
                'tempat_lahir' => 'Bali',
                'tanggal_lahir' => Carbon::create(1996, 11, 8),
                'jabatan' => 'Sales Executive',
                'departemen' => 'Pemasaran',
                'tanggal_masuk' => Carbon::create(2022, 6, 15),
                'status' => 'aktif',
                'email' => 'gunawan@example.com',
                'telepon' => '081788990011',
                'alamat' => 'Jl. Raya Kuta No. 7, Bali',
                'foto' => null,
                'keterangan' => 'Sales terbaik Q2 2022'
            ],
            [
                'nip' => '199702142022071008',
                'nama' => 'Hesti Rahayu',
                'jenis_kelamin' => 'P',
                'tempat_lahir' => 'Palembang',
                'tanggal_lahir' => Carbon::create(1997, 2, 14),
                'jabatan' => 'Customer Service',
                'departemen' => 'Layanan Pelanggan',
                'tanggal_masuk' => Carbon::create(2022, 7, 1),
                'status' => 'aktif',
                'email' => 'hesti.rahayu@example.com',
                'telepon' => '081899001122',
                'alamat' => 'Jl. Jenderal Sudirman No. 12, Palembang',
                'foto' => null,
                'keterangan' => null
            ],
            [
                'nip' => '199803252022081009',
                'nama' => 'Irfan Maulana',
                'jenis_kelamin' => 'L',
                'tempat_lahir' => 'Makassar',
                'tanggal_lahir' => Carbon::create(1998, 3, 25),
                'jabatan' => 'Staff Akuntansi',
                'departemen' => 'Keuangan',
                'tanggal_masuk' => Carbon::create(2022, 8, 5),
                'status' => 'aktif',
                'email' => 'irfan.maulana@example.com',
                'telepon' => '081900112233',
                'alamat' => 'Jl. Sultan Hasanuddin No. 9, Makassar',
                'foto' => null,
                'keterangan' => 'Lulusan terbaik'
            ],
            [
                'nip' => '199909172022091010',
                'nama' => 'Jihan Putri',
                'jenis_kelamin' => 'P',
                'tempat_lahir' => 'Balikpapan',
                'tanggal_lahir' => Carbon::create(1999, 9, 17),
                'jabatan' => 'Graphic Designer',
                'departemen' => 'Kreatif',
                'tanggal_masuk' => Carbon::create(2022, 9, 1),
                'status' => 'aktif',
                'email' => 'jihan.putri@example.com',
                'telepon' => '082011223344',
                'alamat' => 'Jl. MT Haryono No. 18, Balikpapan',
                'foto' => null,
                'keterangan' => 'Juara lomba desain internal'
            ]
        ];

        foreach ($dataPegawai as $pegawai) {
            Pegawai::create($pegawai);
        }
    }
}
