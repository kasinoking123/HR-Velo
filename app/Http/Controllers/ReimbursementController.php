<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reimbursement;

class ReimbursementController extends Controller
{
    // Tampilkan daftar pengajuan untuk pegawai
    public function index()
    {
        $reimbursements = auth()->user()->reimbursements()->latest()->get();
        return view('reimbursements.index', compact('reimbursements'));
    }

    // Form pengajuan baru
    public function create()
    {
        return view('reimbursements.create');
    }

    // Simpan pengajuan baru
    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required|in:transport,atk,health,entertain,other',
            'date' => 'required|date',
            'amount' => 'required|numeric|min:1000',
            'description' => 'required|string|max:500',
            'proof_file' => 'required|file|mimes:jpg,png,pdf|max:5120',
        ]);

        $filePath = $request->file('proof_file')->store('reimbursements');

        Reimbursement::create([
            'user_id' => auth()->id(),
            'category' => $request->category,
            'date' => $request->date,
            'amount' => $request->amount,
            'description' => $request->description,
            'proof_file' => $filePath,
            'status' => 'pending',
        ]);

        return redirect()->route('reimbursements.index')->with('success', 'Pengajuan berhasil dikirim!');
    }

    // Tampilkan detail pengajuan
    public function show(Reimbursement $reimbursement)
    {
        $this->authorize('view', $reimbursement);
        return view('reimbursements.show', compact('reimbursement'));
    }

    // Daftar pengajuan yang perlu disetujui (Manager)
    public function approvalIndex()
    {
        $reimbursements = Reimbursement::where('status', 'pending')->get();
        return view('reimbursements.approval', compact('reimbursements'));
    }

    // Approve pengajuan (Manager)
    public function approve(Reimbursement $reimbursement)
    {
        $reimbursement->update([
            'status' => 'approved',
            'approver_id' => auth()->id(),
        ]);
        return back()->with('success', 'Pengajuan disetujui!');
    }

    // Reject pengajuan (Manager)
    public function reject(Request $request, Reimbursement $reimbursement)
    {
        $request->validate(['rejection_reason' => 'required|string|max:255']);
        
        $reimbursement->update([
            'status' => 'rejected',
            'approver_id' => auth()->id(),
            'rejection_reason' => $request->rejection_reason,
        ]);
        return back()->with('success', 'Pengajuan ditolak!');
    }

    // Daftar pengajuan yang perlu dibayar (Finance)
    public function paymentIndex()
    {
        $reimbursements = Reimbursement::where('status', 'approved')->get();
        return view('reimbursements.payment', compact('reimbursements'));
    }

    // Tandai sebagai dibayar (Finance)
    public function markAsPaid(Reimbursement $reimbursement)
    {
        $reimbursement->update([
            'status' => 'paid',
            'finance_id' => auth()->id(),
        ]);
        return back()->with('success', 'Status pembayaran diperbarui!');
    }
}
