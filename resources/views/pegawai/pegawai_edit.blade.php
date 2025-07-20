<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Data Pegawai') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            {{-- Alert --}}
            @if(session('success'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-4 font-medium text-sm text-red-600">
                    {{ session('error') }}
                </div>
            @endif

            {{-- Form --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ url('/pegawai/' . $pegawai->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- NIP --}}
                    <div class="mb-4">
                        <label for="nip" class="block text-sm font-medium text-gray-700">NIP</label>
                        <input type="text" name="nip" id="nip" value="{{ $pegawai->nip }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" readonly>
                    </div>

                    {{-- Nama --}}
                    <div class="mb-4">
                        <label for="nama" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                        <input type="text" name="nama" id="nama" value="{{ $pegawai->nama }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    {{-- Jenis Kelamin --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                        <div class="mt-2 flex space-x-4">
                            <label class="inline-flex items-center">
                                <input type="radio" name="jenis_kelamin" value="L" {{ $pegawai->jenis_kelamin == 'L' ? 'checked' : '' }} class="form-radio text-indigo-600">
                                <span class="ml-2 text-sm text-gray-700">Laki-laki</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" name="jenis_kelamin" value="P" {{ $pegawai->jenis_kelamin == 'P' ? 'checked' : '' }} class="form-radio text-indigo-600">
                                <span class="ml-2 text-sm text-gray-700">Perempuan</span>
                            </label>
                        </div>
                    </div>

                    {{-- Tambahkan field lainnya sesuai kebutuhan --}}

                    {{-- Tombol Aksi --}}
                    <div class="mt-6 flex justify-between">
                        <x-primary-button>Update</x-primary-button>
                        <a href="{{ route('pegawai.index') }}">
                            <x-secondary-button>Kembali</x-secondary-button>
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>
