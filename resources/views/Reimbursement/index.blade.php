<!-- resources/views/reimbursements/index.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Pengajuan Reimbursement') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            {{-- Alert Success --}}
            @if(session('success'))
                <div class="p-4 bg-green-100 border border-green-300 text-green-800 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Header dan Tombol Ajukan --}}
            <div class="flex justify-between items-center">
                <a href="{{ route('reimbursements.create') }}">
                    <x-primary-button>+ Ajukan Reimbursement</x-primary-button>
                </a>
                
                {{-- Kolom Pencarian --}}
                <form method="GET" action="{{ route('reimbursements.index') }}" class="flex items-center">
                    <div class="relative">
                        <x-text-input 
                            type="text" 
                            name="search" 
                            placeholder="Cari reimbursement..." 
                            value="{{ request('search') }}"
                            class="pl-10 pr-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500"
                        />
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                    </div>
                    <x-primary-button type="submit" class="ml-2">
                        Cari
                    </x-primary-button>
                </form>
            </div>

            {{-- Table Data --}}
            <div class="bg-white shadow-md rounded-lg overflow-x-auto">
                <table class="w-full table-auto border-collapse divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider whitespace-nowrap">No</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider whitespace-nowrap">
                                <a href="{{ route('reimbursements.index', [
                                    'search' => request('search'),
                                    'sort' => 'date',
                                    'direction' => $sortField === 'date' && $sortDirection === 'asc' ? 'desc' : 'asc'
                                ]) }}" class="flex items-center">
                                    Tanggal
                                    @if($sortField === 'date')
                                        @if($sortDirection === 'asc')
                                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                                            </svg>
                                        @else
                                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                            </svg>
                                        @endif
                                    @endif
                                </a>
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider whitespace-nowrap">Kategori</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider whitespace-nowrap">Jumlah</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider whitespace-nowrap">Status</th>
                            <th class="px-4 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider whitespace-nowrap w-48">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100 text-sm text-gray-800">
                        @forelse($reimbursements as $reimb)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 whitespace-nowrap">{{ ($reimbursements->currentPage() - 1) * $reimbursements->perPage() + $loop->iteration }}</td>
                                <td class="px-4 py-3 whitespace-nowrap">{{ \Carbon\Carbon::parse($reimb->date)->format('d/m/Y') }}</td>
                                <td class="px-4 py-3 whitespace-nowrap">
                                    @switch($reimb->category)
                                        @case('transport') Biaya Transportasi @break
                                        @case('atk') Pembelian ATK @break
                                        @case('health') Bill Kesehatan @break
                                        @case('entertain') Entertain Klien @break
                                        @default Lainnya
                                    @endswitch
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap">Rp {{ number_format($reimb->amount, 0, ',', '.') }}</td>
                                <td class="px-4 py-3 whitespace-nowrap">
                                    @if($reimb->status == 'pending')
                                        <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs">Menunggu</span>
                                    @elseif($reimb->status == 'approved')
                                        <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs">Disetujui</span>
                                    @elseif($reimb->status == 'rejected')
                                        <span class="px-2 py-1 bg-red-100 text-red-800 rounded-full text-xs">Ditolak</span>
                                    @elseif($reimb->status == 'paid')
                                        <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs">Dibayar</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-center space-x-2">
                                    <a href="{{ route('reimbursements.show', $reimb->id) }}">
                                        <x-secondary-button>Detail</x-secondary-button>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-4 text-center text-gray-500 italic">Tidak ada data reimbursement.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $reimbursements->links() }}
            </div>
        </div>
    </div>
</x-app-layout>