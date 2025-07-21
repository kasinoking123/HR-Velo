<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pegawai', function (Blueprint $table) {
            $table->id();
            
            // Data dasar
            $table->string('nip', 20)->unique()->comment('Nomor Induk Pegawai');
            $table->string('nama', 100);
            $table->string('npwp', 100);
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('tempat_lahir', 50);
            $table->date('tanggal_lahir');
            
            // Data pekerjaan
            $table->string('jabatan', 50);
            $table->string('departemen', 50);
            $table->date('tanggal_masuk');
            $table->enum('status', ['aktif', 'non-aktif', 'cuti'])->default('aktif');
            
            // Kontak
            $table->string('email', 100)->unique();
            $table->string('telepon', 15);
            $table->string('kontak_darurat', 15);
            $table->string('no_rek', 30);
            $table->text('alamat');
            
            // Data tambahan
            $table->string('foto')->nullable()->comment('Path foto profil');
            $table->text('keterangan')->nullable();
            
            // Timestamps
            $table->timestamps();
            $table->softDeletes();
            
            // Indexing
            $table->index('nip');
            $table->index('jabatan');
            $table->index('departemen');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pegawai', function (Blueprint $table) {
        $table->dropColumn('email');
        $table->string('jabatan')->change();
    });
    }
};
