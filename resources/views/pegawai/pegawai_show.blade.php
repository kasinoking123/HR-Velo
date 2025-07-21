<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Pegawai') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Alert Success -->
            @if(session('success'))
                <div class="p-4 bg-green-100 border border-green-300 text-green-800 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Card Container -->
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <!-- Card Header -->
                <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                    <div class="flex items-center space-x-2">
                        <svg class="h-6 w-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <h3 class="text-lg font-medium text-gray-900">Informasi Pegawai</h3>
                    </div>
                    <div>
                        <a href="{{ route('pegawai.edit', $pegawai->id) }}" class="text-indigo-600 hover:text-indigo-900">
                            <x-primary-button>
                                <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Edit
                            </x-primary-button>
                        </a>
                    </div>
                </div>

                <!-- Card Content -->
                <div class="p-6">
                    <div class="flex flex-col md:flex-row gap-8">
                        <!-- Foto Profil -->
                        <div class="w-full md:w-1/4 flex flex-col items-center">
                            @if($pegawai->foto)
                                <img src="{{ asset('storage/' . $pegawai->foto) }}" alt="Foto Profil" class="rounded-lg shadow-md w-48 h-48 object-cover mb-4">
                            @else
                                <div class="rounded-lg shadow-md bg-gray-100 w-48 h-48 flex items-center justify-center mb-4">
                                    <svg class="h-24 w-24 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                            @endif
                            <div class="text-center">
                                <h4 class="text-xl font-semibold text-gray-800">{{ $pegawai->nama }}</h4>
                                <p class="text-gray-600">{{ $pegawai->jabatan }}</p>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium mt-2 
                                    {{ $pegawai->status == 'aktif' ? 'bg-green-100 text-green-800' : 
                                       ($pegawai->status == 'cuti' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                    {{ ucfirst($pegawai->status) }}
                                </span>
                            </div>
                        </div>

                        <!-- Data Pegawai -->
                        <div class="w-full md:w-3/4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Data Dasar -->
                                <div class="space-y-4">
                                    <h4 class="text-lg font-medium text-gray-900 border-b pb-2">Data Dasar</h4>
                                    <div>
                                        <p class="text-sm text-gray-500">NIP</p>
                                        <p class="font-medium">{{ $pegawai->nip }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Jenis Kelamin</p>
                                        <p class="font-medium">{{ $pegawai->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Tempat/Tanggal Lahir</p>
                                        <p class="font-medium">{{ $pegawai->tempat_lahir }}, {{ $pegawai->tanggal_lahir->format('d/m/Y') }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">NPWP</p>
                                        <p class="font-medium">{{ $pegawai->npwp ?? '-' }}</p>
                                    </div>
                                </div>

                                <!-- Data Pekerjaan -->
                                <div class="space-y-4">
                                    <h4 class="text-lg font-medium text-gray-900 border-b pb-2">Data Pekerjaan</h4>
                                    <div>
                                        <p class="text-sm text-gray-500">Departemen</p>
                                        <p class="font-medium">{{ $pegawai->departemen }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Tanggal Masuk</p>
                                        <p class="font-medium">{{ $pegawai->tanggal_masuk->format('d/m/Y') }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Masa Kerja</p>
                                        <p class="font-medium">{{ $pegawai->tanggal_masuk->diffForHumans() }}</p>
                                    </div>
                                </div>

                                <!-- Kontak -->
                                <div class="space-y-4">
                                    <h4 class="text-lg font-medium text-gray-900 border-b pb-2">Kontak</h4>
                                    <div>
                                        <p class="text-sm text-gray-500">Email</p>
                                        <p class="font-medium">{{ $pegawai->email }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Telepon</p>
                                        <p class="font-medium">{{ $pegawai->telepon }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Kontak Darurat</p>
                                        <p class="font-medium">{{ $pegawai->kontak_darurat }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Nomor Rekening</p>
                                        <p class="font-medium">{{ $pegawai->no_rek ?? '-' }}</p>
                                    </div>
                                </div>

                                <!-- Data Tambahan -->
                                <div class="space-y-4">
                                    <h4 class="text-lg font-medium text-gray-900 border-b pb-2">Data Tambahan</h4>
                                    <div>
                                        <p class="text-sm text-gray-500">Alamat</p>
                                        <p class="font-medium">{{ $pegawai->alamat }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Keterangan</p>
                                        <p class="font-medium">{{ $pegawai->keterangan ?? '-' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card Footer -->
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end">
                    <a href="{{ route('pegawai.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Kembali ke Daftar
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>