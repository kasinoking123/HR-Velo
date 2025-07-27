<!-- resources/views/reimbursements/track.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pelacakan Status Reimbursement') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            {{-- Filter Status --}}
            <div class="bg-white p-4 shadow-md rounded-lg">
                <form method="GET" action="{{ route('reimbursements.track') }}" class="flex items-center space-x-4">
                    <div>
                        <x-input-label for="status" :value="__('Filter Status')" />
                        <select id="status" name="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Semua Status</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu</option>
                            <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Disetujui</option>
                            <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                            <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Dibayar</option>
                        </select>
                    </div>
                    <x-primary-button type="submit" class="mt-6">
                        Terapkan
                    </x-primary-button>
                </form>
            </div>

            {{-- Daftar Reimbursement --}}
            <div class="bg-white shadow-md rounded-lg overflow-x-auto">
                <table class="w-full table-auto border-collapse divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">No</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tanggal</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Kategori</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Jumlah</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100 text-sm text-gray-800">
                        @forelse($reimbursements as $reimb)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3">{{ $loop->iteration }}</td>
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
                                <td class="px-4 py-3">{!! $reimb->status_badge !!}</td>
                                <td class="px-4 py-3">
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

            {{-- Pagination --}}
            <div class="mt-4">
                {{ $reimbursements->links() }}
            </div>
        </div>
    </div>
</x-app-layout>