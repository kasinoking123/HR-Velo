<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Pegawai Baru') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow sm:rounded-lg p-6">
                <form action="{{ route('pegawai.store') }}" method="POST">
                    @csrf

                    {{-- NIP --}}
                    <div class="mb-4">
                        <label for="nip" class="block text-sm font-medium text-gray-700">NIP</label>
                        <input type="text" name="nip" id="nip" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    {{-- Nama --}}
                    <div class="mb-4">
                        <label for="nama" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                        <input type="text" name="nama" id="nama" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    {{-- Jenis Kelamin --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                        <div class="mt-2 flex gap-6">
                            <label class="inline-flex items-center">
                                <input type="radio" name="jenis_kelamin" value="L" checked class="form-radio text-indigo-600">
                                <span class="ml-2">Laki-laki</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" name="jenis_kelamin" value="P" class="form-radio text-indigo-600">
                                <span class="ml-2">Perempuan</span>
                            </label>
                        </div>
                    </div>

                    {{-- Tempat Lahir --}}
                    <div class="mb-4">
                        <label for="tempat_lahir" class="block text-sm font-medium text-gray-700">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" id="tempat_lahir" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    {{-- Tanggal Lahir --}}
                    <div class="mb-4">
                        <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" id="tanggal_lahir" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    {{-- Jabatan --}}
                    <div class="mb-4">
                        <label for="jabatan" class="block text-sm font-medium text-gray-700">Jabatan</label>
                        <input type="text" name="jabatan" id="jabatan" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    {{-- Departemen --}}
                    <div class="mb-4">
                        <label for="departemen" class="block text-sm font-medium text-gray-700">Departemen</label>
                        <input type="text" name="departemen" id="departemen" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    {{-- Tanggal Masuk --}}
                    <div class="mb-4">
                        <label for="tanggal_masuk" class="block text-sm font-medium text-gray-700">Tanggal Masuk</label>
                        <input type="date" name="tanggal_masuk" id="tanggal_masuk" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    {{-- Email --}}
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" id="email" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    {{-- Telepon --}}
                    <div class="mb-4">
                        <label for="telepon" class="block text-sm font-medium text-gray-700">Telepon</label>
                        <input type="text" name="telepon" id="telepon" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    {{-- Alamat --}}
                    <div class="mb-4">
                        <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                        <textarea name="alamat" id="alamat" rows="3" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                    </div>

                    {{-- Tombol Aksi --}}
                    <div class="mt-6 flex justify-between">
                        <x-primary-button>Simpan</x-primary-button>
                        <a href="{{ route('pegawai.index') }}">
                            <x-secondary-button>Kembali</x-secondary-button>
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>
