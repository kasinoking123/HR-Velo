<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use App\Models\Pegawai;
use Illuminate\Support\Facades\DB;


class PegawaiSeedeer extends Seeder
{
   public function run()
    {
        $departemen = [
            'Teknologi Informasi',
            'Keuangan',
            'Sumber Daya Manusia',
            'Pemasaran',
            'Operasional',
            'Produksi',
            'Riset dan Pengembangan',
            'Logistik'
        ];

        $jabatan = [
            'Manager',
            'Supervisor',
            'Staff',
            'Analyst',
            'Engineer',
            'Coordinator',
            'Specialist',
            'Officer'
        ];

        $cities = [
            'Jakarta', 'Bandung', 'Surabaya', 'Medan', 'Semarang',
            'Yogyakarta', 'Makassar', 'Palembang', 'Denpasar', 'Balikpapan'
        ];

        $streetNames = [
            'Merdeka', 'Sudirman', 'Thamrin', 'Gatot Subroto', 'Hayam Wuruk',
            'Pahlawan', 'Diponegoro', 'Ahmad Yani', 'Juanda', 'Kemang'
        ];

        $bankNames = [
            'BCA', 'Mandiri', 'BNI', 'BRI', 'CIMB Niaga',
            'Danamon', 'Panin', 'Maybank', 'OCBC', 'HSBC'
        ];

        // Kosongkan tabel terlebih dahulu
        DB::table('pegawai')->truncate();

        $pegawaiData = [];
        $usedEmails = [];
        $usedNIPs = [];

        for ($i = 1; $i <= 30; $i++) {
            $gender = ($i % 2 == 0) ? 'P' : 'L';
            $firstName = ($gender == 'L') ? $this->maleNames() : $this->femaleNames();
            $lastName = $this->lastNames();
            $birthYear = rand(1980, 1995);
            $joinYear = rand(2018, 2023);
            $dept = $departemen[array_rand($departemen)];
            $position = $jabatan[array_rand($jabatan)];
            
            if (strpos($position, 'Manager') !== false) {
                $dept = $departemen[array_rand(['Teknologi Informasi', 'Keuangan', 'Sumber Daya Manusia', 'Pemasaran'])];
            }

            // Generate NIP unik (format: YYYYMMDDXXXX)
            $nip = $this->generateUniqueNip($joinYear, $i, $usedNIPs);
            $usedNIPs[] = $nip;

            // Generate email unik
            $baseEmail = strtolower(str_replace(' ', '.', $firstName)) . '.' . strtolower($lastName) . '@company.com';
            $email = $this->generateUniqueEmail($baseEmail, $usedEmails);
            $usedEmails[] = $email;

            $pegawaiData[] = [
                'nip' => $nip,
                'nama' => $firstName . ' ' . $lastName,
                'npwp' => $this->generateNpwp(),
                'jenis_kelamin' => $gender,
                'tempat_lahir' => $cities[array_rand($cities)],
                'tanggal_lahir' => Carbon::create($birthYear, rand(1, 12), rand(1, 28)),
                'jabatan' => $position . ($position === 'Manager' ? ' ' . explode(' ', $dept)[0] : ''),
                'departemen' => $dept,
                'tanggal_masuk' => Carbon::create($joinYear, rand(1, 12), rand(1, 28)),
                'status' => $this->randomStatus(),
                'email' => $email,
                'telepon' => '08' . rand(11, 99) . rand(1000000, 9999999),
                'kontak_darurat' => '08' . rand(11, 99) . rand(1000000, 9999999),
                'no_rek' => rand(1000000000, 9999999999) . ' (' . $bankNames[array_rand($bankNames)] . ')',
                'alamat' => 'Jl. ' . $streetNames[array_rand($streetNames)] . ' No. ' . rand(1, 100) . ', ' . $cities[array_rand($cities)],
                'foto' => null,
                'keterangan' => (rand(0, 3) === 0) ? $this->randomKeterangan() : null,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        // Insert data ke database dalam batch
        foreach (array_chunk($pegawaiData, 10) as $chunk) {
            DB::table('pegawai')->insert($chunk);
        }
    }

    private function generateUniqueNip($year, $seq, &$usedNIPs)
    {
        $nip = $year . str_pad($seq, 4, '0', STR_PAD_LEFT);
        
        while (in_array($nip, $usedNIPs)) {
            $seq++;
            $nip = $year . str_pad($seq, 4, '0', STR_PAD_LEFT);
        }
        
        return $nip;
    }

    private function generateUniqueEmail($baseEmail, &$usedEmails)
    {
        $email = $baseEmail;
        $counter = 1;
        
        while (in_array($email, $usedEmails)) {
            $email = str_replace('@company.com', $counter . '@company.com', $baseEmail);
            $counter++;
        }
        
        return $email;
    }

    private function randomStatus()
    {
        $statuses = ['aktif', 'aktif', 'aktif', 'aktif', 'non-aktif', 'cuti'];
        return $statuses[array_rand($statuses)];
    }

    private function randomKeterangan()
    {
        $keterangan = [
            'Pegawai berprestasi',
            'Pernah menjabat sebagai koordinator',
            'Mendapat penghargaan employee of the month',
            'Sedang mengikuti pelatihan',
            'Anggota tim proyek khusus'
        ];
        return $keterangan[array_rand($keterangan)];
    }

    private function maleNames()
    {
        $names = [
            'Ahmad', 'Budi', 'Cahyo', 'Dedi', 'Eko', 'Fajar', 'Gunawan', 'Hadi', 'Irfan', 'Joko',
            'Kurniawan', 'Lukman', 'Mulyadi', 'Nugroho', 'Oki', 'Prasetyo', 'Qomar', 'Rudi', 'Santo', 'Teguh'
        ];
        return $names[array_rand($names)];
    }

    private function femaleNames()
    {
        $names = [
            'Ani', 'Bunga', 'Citra', 'Dewi', 'Eka', 'Fitri', 'Gita', 'Hani', 'Intan', 'Juli',
            'Kartika', 'Lina', 'Maya', 'Nina', 'Olivia', 'Putri', 'Qonita', 'Rina', 'Sari', 'Tina'
        ];
        return $names[array_rand($names)];
    }

    private function lastNames()
    {
        $names = [
            'Santoso', 'Wijaya', 'Pratama', 'Kusuma', 'Setiawan', 'Hidayat', 'Saputra', 'Wibowo',
            'Nugroho', 'Siregar', 'Halim', 'Susanto', 'Gunawan', 'Tanuwijaya', 'Lim', 'Oentoro'
        ];
        return $names[array_rand($names)];
    }

    private function generateNpwp()
    {
        return sprintf(
            '%02d.%03d.%03d.%01d-%03d.%03d',
            rand(10, 36), // Kode wilayah
            rand(100, 999),
            rand(100, 999),
            rand(0, 9),
            rand(100, 999),
            rand(100, 999)
        );
    }
}
