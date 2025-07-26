<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\reimbursement;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class reimbursementController extends Controller
{
    use AuthorizesRequests;
    // Tampilkan daftar pengajuan untuk pegawai
    public function index()
    {
        // $reimbursements = auth()->user()->reimbursements()->latest()->get();
        // return view('reimbursement.index', compact('reimbursements'));
        $sortField = request('sort', 'date');
        $sortDirection = request('direction', 'desc');
    
        $reimbursements = auth()->user()->reimbursements()
                            ->orderBy($sortField, $sortDirection)
                            ->paginate(10)
                            ->appends(request()->query());
        
        return view('reimbursement.index', compact('reimbursements', 'sortField', 'sortDirection'));
    }

    // Form pengajuan baru
    public function create()
    {
        return view('reimbursement.create');
    }

    // Simpan pengajuan baru
    public function store(Request $request)
    {
        // dd($request);
        $validate = $request->validate([
            'category' => 'required|in:transport,atk,health,entertain,other',
            'date' => 'required|date',
            'amount' => 'required|numeric|min:1000',
            'description' => 'required|string|max:500',
            'proof_file' => 'required|file|mimes:jpg,png,pdf|max:5120',
        ]);

        // $filePath = $request->file('proof_file')->store();
        $filePath = $request->file('proof_file')->store('reimbursements', 'public');
        // reimbursement::create($validate);
        
        reimbursement::create([
            'user_id' => auth()->id(),
            'category' => $validate['category'],
            'date' => $validate['date'],
            'amount' => $validate['amount'],
            'description' => $validate['description'],
            'proof_file' => $filePath,
            'status' => 'pending',
        ]);

        // dd($filePath);
        return redirect()->route('reimbursements.index')->with('success', 'Pengajuan berhasil dikirim!');
    }

    // Tampilkan detail pengajuan
    public function show(reimbursement $reimbursement)
    {
        // dd($reimbursement);
        $auto= $this->authorize('view', $reimbursement);
        //  dd($auto);
        
        return view('reimbursement.show', compact('reimbursement'));
    }

    // Daftar pengajuan yang perlu disetujui (Manager)
    public function approvalIndex()
    {
        $reimbursements = reimbursement::where('status', 'pending')->get();
        return view('reimbursement.approval', compact('reimbursements'));
    }

    // Approve pengajuan (Manager)
    public function approve(reimbursement $reimbursement)
    {
        $reimbursement->update([
            'status' => 'approved',
            'approver_id' => auth()->id(),
        ]);
        return back()->with('success', 'Pengajuan disetujui!');
    }

    // Reject pengajuan (Manager)
    public function reject(Request $request, reimbursement $reimbursement)
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
        $reimbursements = reimbursement::where('status', 'approved')->get();
        return view('reimbursement.payment', compact('reimbursements'));
    }

    // Tandai sebagai dibayar (Finance)
    public function markAsPaid(reimbursement $reimbursement)
    {
        $reimbursement->update([
            'status' => 'paid',
            'finance_id' => auth()->id(),
        ]);
        return back()->with('success', 'Status pembayaran diperbarui!');
    }
}
