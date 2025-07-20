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
                        </div>

                        {{-- Table Data --}}
                        <div class="bg-white shadow-md rounded-lg overflow-x-auto">
                <table class="w-full table-auto border-collapse divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider whitespace-nowrap">NIP</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider whitespace-nowrap">Nama</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider whitespace-nowrap">Jabatan</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider whitespace-nowrap">Departemen</th>
                            <th class="px-4 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider whitespace-nowrap w-48">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100 text-sm text-gray-800">
                        @forelse($pegawais as $pegawai)
                            <tr class="hover:bg-gray-50">
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
                
            </div>

        </div>
    </div>
</x-app-layout>
