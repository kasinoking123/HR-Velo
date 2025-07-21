<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('List Data Pegawai') }}
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

                            {{-- Header dan Tombol Tambah --}}
                            <div class="flex justify-between items-center">
                    <a href="{{ route('pegawai.create') }}">
                        <x-primary-button>+ Tambah Pegawai</x-primary-button>
                    </a>
                    
                    {{-- Kolom Pencarian --}}
                    <form method="GET" action="{{ route('pegawai.index') }}" class="flex items-center">
                        <div class="relative">
                            <x-text-input 
                                type="text" 
                                name="search" 
                                placeholder="Cari pegawai..." 
                                value="{{ request('$search') }}"
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
                            <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider whitespace-nowrap">
                                <a href="{{ route('pegawai.index', [
                                            'search' => $search,
                                            'sort' => 'nip',
                                            'direction' => $sortField === 'nip' && $sortDirection === 'asc' ? 'desc' : 'asc'
                                            ]) }}" class="flex items-center">
                                            NIP
                                                @if($sortField === 'nip')
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
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider whitespace-nowrap">
                                <a href="{{ route('pegawai.index', [
                                        'search' => $search,
                                        'sort' => 'nama',
                                        'direction' => $sortField === 'nama' && $sortDirection === 'asc' ? 'desc' : 'asc'
                                        ]) }}" class="flex items-center">           
                                        Nama
                                        @if($sortField === 'nama')
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
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider whitespace-nowrap">
                                <a href="{{ route('pegawai.index', [
                                        'search' => $search,
                                        'sort' => 'jabatan',
                                        'direction' => $sortField === 'jabatan' && $sortDirection === 'asc' ? 'desc' : 'asc'
                                    ]) }}" class="flex items-center">
                                    Jabatan
                                    @if($sortField === 'jabatan')
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
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider whitespace-nowrap">Departemen</th>
                            <th class="px-4 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider whitespace-nowrap w-48">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100 text-sm text-gray-800">
                        @forelse($pegawais as $pegawai)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 whitespace-nowrap">{{ ($pegawais->currentPage() - 1) * $pegawais->perPage() + $loop->iteration }}</td>
                                <td class="px-4 py-3 whitespace-nowrap">{{ $pegawai->nip }}</td>
                                <td class="px-4 py-3 break-words">{{ $pegawai->nama }}</td>
                                <td class="px-4 py-3 break-words">{{ $pegawai->jabatan }}</td>
                                <td class="px-4 py-3 break-words">{{ $pegawai->departemen }}</td>
                                <td class="px-4 py-3 text-center space-x-2">
                                    <a href="{{ route('pegawai.show', $pegawai->id) }}">
                                        <x-secondary-button>Lihat</x-secondary-button>
                                    </a>
                                    <a href="{{ route('pegawai.edit', $pegawai->id) }}">
                                        <x-primary-button>Edit</x-primary-button>
                                    </a>
                                    <form action="{{ route('pegawai.destroy', $pegawai->id) }}" method="POST" class="inline-block"
                                        onsubmit="return confirm('Yakin ingin menghapus?')">
                                        @csrf
                                        @method('DELETE')
                                        <x-danger-button>Hapus</x-danger-button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-4 text-center text-gray-500 italic">Tidak ada data pegawai.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $pegawais->links() }}
            </div>

        </div>
    </div>
</x-app-layout>
