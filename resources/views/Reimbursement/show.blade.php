<!-- resources/views/reimbursements/show.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Reimbursement') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Info Dasar --}}
                    <div class="space-y-4">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900">Informasi Pengajuan</h3>
                            <dl class="mt-2 space-y-2">
                                <div class="flex justify-between">
                                    <dt class="text-sm text-gray-500">Kategori</dt>
                                    <dd class="text-sm text-gray-900">
                                        @switch($reimbursement->category)
                                            @case('transport') Biaya Transportasi @break
                                            @case('atk') Pembelian ATK @break
                                            @case('health') Bill Kesehatan @break
                                            @case('entertain') Entertain Klien @break
                                            @default Lainnya
                                        @endswitch
                                    </dd>
                                </div>
                                <div class="flex justify-between">
                                    <dt class="text-sm text-gray-500">Tanggal</dt>
                                    <dd class="text-sm text-gray-900">{{ $reimbursement->date->format('d/m/Y') }}</dd>
                                </div>
                                <div class="flex justify-between">
                                    <dt class="text-sm text-gray-500">Jumlah</dt>
                                    <dd class="text-sm text-gray-900">Rp {{ number_format($reimbursement->amount, 0, ',', '.') }}</dd>
                                </div>
                                <div class="flex justify-between">
                                    <dt class="text-sm text-gray-500">Status</dt>
                                    <dd class="text-sm">
                                        @if($reimbursement->status == 'pending')
                                            <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full">Menunggu</span>
                                        @elseif($reimbursement->status == 'approved')
                                            <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full">Disetujui</span>
                                        @elseif($reimbursement->status == 'rejected')
                                            <span class="px-2 py-1 bg-red-100 text-red-800 rounded-full">Ditolak</span>
                                        @elseif($reimbursement->status == 'paid')
                                            <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full">Dibayar</span>
                                        @endif
                                    </dd>
                                </div>
                            </dl>
                        </div>

                        {{-- Deskripsi --}}
                        <div>
                            <h3 class="text-lg font-medium text-gray-900">Deskripsi</h3>
                            <p class="mt-2 text-sm text-gray-700">{{ $reimbursement->description }}</p>
                        </div>
                    </div>

                    {{-- Bukti & Approval --}}
                    <div class="space-y-4">
                        {{-- Bukti Pembayaran --}}
                        <div>
                            <h3 class="text-lg font-medium text-gray-900">Bukti Pembayaran</h3>
                            <div class="mt-2">
                                @if(pathinfo($reimbursement->proof_file, PATHINFO_EXTENSION) === 'pdf')
                                    <embed src="{{ asset('storage/' . $reimbursement->proof_file) }}" type="application/pdf" width="30%" height="300px">
                                @else
                                    <img src="{{ asset('storage/' . $reimbursement->proof_file) }}" alt="Bukti Pembayaran" class="max-w-full h-auto rounded-lg" width="30%" height="300px>
                                @endif
                            </div>
                        </div>

                        {{-- Catatan Penolakan --}}
                        @if($reimbursement->status == 'rejected' && $reimbursement->rejection_reason)
                            <div class="p-4 bg-red-50 border-l-4 border-red-400">
                                <h4 class="text-sm font-medium text-red-800">Alasan Penolakan</h4>
                                <p class="mt-1 text-sm text-red-700">{{ $reimbursement->rejection_reason }}</p>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="flex justify-end mt-6 space-x-4">
                    <a href="{{ route('reimbursements.index') }}">
                        <x-secondary-button>Kembali</x-secondary-button>
                    </a>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>