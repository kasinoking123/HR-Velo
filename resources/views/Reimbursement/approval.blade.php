<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Persetujuan Reimbursement') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                    <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                        <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <title>Close</title>
                            <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/>
                        </svg>
                    </span>
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                    <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                        <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <title>Close</title>
                            <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/>
                        </svg>
                    </span>
                </div>
            @endif

            <div class="bg-white shadow-md rounded-lg overflow-x-auto">
                <table class="w-full table-auto border-collapse divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">No</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Pegawai</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tanggal</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Kategori</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Jumlah</th>
                            <th class="px-4 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100 text-sm text-gray-800">
                        @forelse($reimbursements as $index => $reimb)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3">{{ ($reimbursements->currentPage() - 1) * $reimbursements->perPage() + $loop->iteration }}</td>
                                <td class="px-4 py-3">{{ $reimb->user->name }}</td>
                                <td class="px-4 py-3">{{ $reimb->date->format('d/m/Y') }}</td>
                                <td class="px-4 py-3">
                                    @switch($reimb->category)
                                        @case('transport') Transportasi @break
                                        @case('atk') ATK @break
                                        @case('health') Kesehatan @break
                                        @case('entertain') Klien @break
                                        @default Lainnya
                                    @endswitch
                                </td>
                                <td class="px-4 py-3">Rp {{ number_format($reimb->amount, 0, ',', '.') }}</td>
                                <td class="px-4 py-3 text-center space-x-2">
                                    <form action="{{ route('reimbursements.approve', $reimb->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        <x-primary-button type="submit">Setujui</x-primary-button>
                                    </form>
                                    <button onclick="document.getElementById('reject-form-{{ $reimb->id }}').classList.toggle('hidden')"
                                        class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        Tolak
                                    </button>
                                    <form id="reject-form-{{ $reimb->id }}" action="{{ route('reimbursements.reject', $reimb->id) }}" method="POST" class="hidden mt-2">
                                        @csrf
                                        <x-text-input name="rejection_reason" placeholder="Alasan penolakan" required class="w-full mb-2" />
                                        <x-danger-button type="submit">Konfirmasi Tolak</x-danger-button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-4 text-center text-gray-500 italic">
                                    Tidak ada pengajuan pending saat ini.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                
                <!-- Pagination Links -->
                <div class="px-4 py-3 border-t border-gray-200 sm:px-6">
                    {{ $reimbursements->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>