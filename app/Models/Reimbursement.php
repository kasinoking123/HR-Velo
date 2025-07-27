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
    protected $casts = [
        'date' => 'date', // atau 'datetime' jika menyimpan waktu juga
    ];

    public function scopeFilterByStatus($query, $status)
    {
        if ($status) {
            return $query->where('status', $status);
        }
        return $query;
    }
    public function getStatusBadgeAttribute()
    {
        return match($this->status) {
            'pending' => '<span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs">Menunggu</span>',
            'approved' => '<span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs">Disetujui</span>',
            'rejected' => '<span class="px-2 py-1 bg-red-100 text-red-800 rounded-full text-xs">Ditolak</span>',
            'paid' => '<span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs">Dibayar</span>',
            default => ''
        };
    }
}
