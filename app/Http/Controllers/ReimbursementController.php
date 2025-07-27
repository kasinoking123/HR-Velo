<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reimbursement;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ReimbursementController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('role:manager')->only('approveReimbursement');
    //     $this->middleware('role:finance')->only('processPayment');
    // }

    use AuthorizesRequests;
    // Tampilkan daftar pengajuan untuk pegawai
    public function index()
    {
        // $Reimbursements = auth()->user()->Reimbursements()->latest()->get();
        // return view('Reimbursement.index', compact('Reimbursements'));
        $sortField = request('sort', 'date');
        $sortDirection = request('direction', 'desc');
    
        $Reimbursements = auth()->user()->Reimbursements()
                            ->orderBy($sortField, $sortDirection)
                            ->paginate(10)
                            ->appends(request()->query());
        
        return view('Reimbursement.index', compact('Reimbursements', 'sortField', 'sortDirection'));
    }

    // Form pengajuan baru
    public function create()
    {
        return view('Reimbursement.create');
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
        $filePath = $request->file('proof_file')->store('Reimbursements', 'public');
        // Reimbursement::create($validate);
        
        Reimbursement::create([
            'user_id' => auth()->id(),
            'category' => $validate['category'],
            'date' => $validate['date'],
            'amount' => $validate['amount'],
            'description' => $validate['description'],
            'proof_file' => $filePath,
            'status' => 'pending',
        ]);

        // dd($filePath);
        return redirect()->route('Reimbursements.index')->with('success', 'Pengajuan berhasil dikirim!');
    }

    // Tampilkan detail pengajuan
    public function show(Reimbursement $Reimbursement)
    {
        // dd($Reimbursement);
        $auto= $this->authorize('view', $Reimbursement);
        //  dd($auto);
        
        return view('Reimbursement.show', compact('Reimbursement'));
    }

    // Daftar pengajuan yang perlu disetujui (Manager)
    public function approvalIndex()
    {
        $reimbursements = Reimbursement::with('user')
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('reimbursement.approval', compact('reimbursements'));

    }

    // Approve pengajuan (Manager)
    public function approve(Reimbursement $Reimbursement)
    {
        $Reimbursement->update([
            'status' => 'approved',
            'approver_id' => auth()->id(),
        ]);
        return back()->with('success', 'Pengajuan disetujui!');
    }

    // Reject pengajuan (Manager)
    public function reject(Request $request, Reimbursement $Reimbursement)
    {
        $request->validate(['rejection_reason' => 'required|string|max:255']);
        
        $Reimbursement->update([
            'status' => 'rejected',
            'approver_id' => auth()->id(),
            'rejection_reason' => $request->rejection_reason,
        ]);
        return back()->with('success', 'Pengajuan ditolak!');
    }

    // Daftar pengajuan yang perlu dibayar (Finance)
    public function paymentIndex()
    {
        $Reimbursements = Reimbursement::where('status', 'approved')->get();
        return view('Reimbursement.payment', compact('Reimbursements'));
    }

    // Tandai sebagai dibayar (Finance)
    public function markAsPaid(Reimbursement $Reimbursement)
    {
        $Reimbursement->update([
            'status' => 'paid',
            'finance_id' => auth()->id(),
        ]);
        return back()->with('success', 'Status pembayaran diperbarui!');
    }


    // app/Http/Controllers/ReimbursementController.php
    public function trackStatus(Request $request)
    {
        $status = $request->input('status');
        $reimbursements = auth()->user()->reimbursements()
            ->filterByStatus($status)
            ->latest()
            ->paginate(10);

        return view('reimbursement.track', compact('reimbursements'));
    }
}
