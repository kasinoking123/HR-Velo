<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PegawaiController;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ReimbursementController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('admin.dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route::middleware(['auth','admin'])->group(function () {
    // Route::resource('pegawai', PegawaiController::class);
    // Menggantikan:
// Route::resource('pegawai', PegawaiController::class);

// Menjadi:
Route::get('/pegawai', [PegawaiController::class, 'index'])->name('pegawai.index')->middleware('admin');       // Menampilkan daftar pegawai
Route::get('/pegawai/create', [PegawaiController::class, 'create'])->name('pegawai.create')->middleware('admin'); // Form tambah pegawai
Route::post('/pegawai', [PegawaiController::class, 'store'])->name('pegawai.store')->middleware(['auth','admin']);     // Proses simpan data baru
Route::get('/pegawai/{pegawai}', [PegawaiController::class, 'show'])->name('pegawai.show')->middleware('admin'); // Menampilkan detail pegawai
Route::get('/pegawai/{pegawai}/edit', [PegawaiController::class, 'edit'])->name('pegawai.edit')->middleware('admin'); // Form edit pegawai
Route::put('/pegawai/{pegawai}', [PegawaiController::class, 'update'])->name('pegawai.update')->middleware(['auth','admin']); // Proses update data
Route::delete('/pegawai/{pegawai}', [PegawaiController::class, 'destroy'])->name('pegawai.destroy')->middleware('admin'); // Hapus data pegawai
// });

Route::get('/test-db', function() {
    try {
        DB::connection()->getPdo();
        return "Connected successfully to: " . DB::connection()->getDatabaseName();
    } catch (\Exception $e) {
        return "Could not connect to database. Error: " . $e->getMessage();
    }
});

// Untuk Pegawai
Route::middleware(['auth'])->group(function () {
    Route::get('/reimbursements', [ReimbursementController::class, 'index'])->name('reimbursements.index');
    Route::get('/reimbursements/create', [ReimbursementController::class, 'create'])->name('reimbursements.create');
    Route::post('/reimbursements', [ReimbursementController::class, 'store'])->name('reimbursements.store');
    Route::get('/reimbursements/{reimbursement}', [ReimbursementController::class, 'show'])->name('reimbursements.show');
   
});

// Untuk Manager (Approve/Reject)
Route::middleware(['auth', 'role:manager'])->group(function () {
    Route::get('/reimbursements/approval', [ReimbursementController::class, 'approvalIndex'])->name('reimbursements.approval');
    Route::post('/reimbursements/{reimbursement}/approve', [ReimbursementController::class, 'approve'])->name('reimbursements.approve');
    Route::post('/reimbursements/{reimbursement}/reject', [ReimbursementController::class, 'reject'])->name('reimbursements.reject');
});

// Untuk Finance (Proses Pembayaran)
Route::middleware(['auth', 'role:finance'])->group(function () {
    Route::get('/reimbursements/payment', [ReimbursementController::class, 'paymentIndex'])->name('reimbursements.payment');
    Route::post('/reimbursements/{reimbursement}/pay', [ReimbursementController::class, 'markAsPaid'])->name('reimbursements.pay');
});


require __DIR__.'/auth.php';
