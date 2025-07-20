<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
        'name' => 'Staff',
        'email' => 'staff@example.com',
        'tempat_lahir' => 'bandung',
        'tangal_lahir' => '1993-12-03',
        'alamat' => 'gg manunggal 2c',
        'jabatan' => 'Programmer',
        'tanggal_masuk' => '2015-01-01',
        'password' => bcrypt('password123'),
        'role' => 'user',


    ]);
    }
}
