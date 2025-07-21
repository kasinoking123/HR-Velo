<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Reimbursement extends Model
{
    protected $fillable = [
        'user_id', 'approver_id', 'finance_id', 'category', 'date', 'amount',
        'description', 'proof_file', 'status', 'rejection_reason'
    ];

    // Relasi ke user (pegawai)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke manager yang menyetujui
    public function approver()
    {
        return $this->belongsTo(User::class, 'approver_id');
    }

    // Relasi ke admin finance yang memproses
    public function finance()
    {
        return $this->belongsTo(User::class, 'finance_id');
    }
}
