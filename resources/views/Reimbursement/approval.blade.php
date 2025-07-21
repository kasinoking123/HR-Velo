<!-- resources/views/reimbursements/approval.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Persetujuan Reimbursement') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            {{-- Table Data --}}
            <div class="bg-white shadow-md rounded-lg overflow-x-auto">
                <table class="w-full table-auto border-collapse divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Pegawai</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tanggal</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Kategori</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Jumlah</th>
                            <th class="px-4 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider w-48">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100 text-sm text-gray-800">
                        @forelse($reimbursements as $reimb)
                            <tr class="hover:bg-gray-50">
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
                                    <a href="{{ route('reimbursements.show', $reimb->id) }}">
                                        <x-secondary-button>Detail</x-secondary-button>
                                    </a>
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
                                <td colspan="5" class="px-4 py-4 text-center text-gray-500 italic">Tidak ada pengajuan yang perlu disetujui.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>