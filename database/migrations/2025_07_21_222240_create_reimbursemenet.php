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
        // database/migrations/2023_01_01_create_reimbursements_table.php
        Schema::create('reimbursements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained(); // Pegawai yang mengajukan
            $table->foreignId('approver_id')->nullable()->constrained('users'); // Manajer yang menyetujui
            $table->foreignId('finance_id')->nullable()->constrained('users'); // Admin Finance yang memproses
            $table->enum('category', ['transport', 'atk', 'health', 'entertain', 'other']);
            $table->date('date');
            $table->decimal('amount', 12, 2);
            $table->text('description');
            $table->string('proof_file'); // Path file bukti
            $table->enum('status', ['pending', 'approved', 'rejected', 'paid'])->default('pending');
            $table->text('rejection_reason')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reimbursemenet');
    }
};
