<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Pegawai') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow sm:rounded-lg p-6">
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-700">{{ $pegawai->nama }}</h3>
                    <p class="text-sm text-gray-600">Informasi lengkap pegawai</p>
                </div>

                <div class="space-y-4 text-gray-800 text-sm">
                    <p><strong>NIP:</strong> {{ $pegawai->nip }}</p>
                    <p><strong>Jenis Kelamin:</strong> {{ $pegawai->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
                    <p><strong>Tempat/Tanggal Lahir:</strong> {{ $pegawai->tempat_lahir }}, {{ \Carbon\Carbon::parse($pegawai->tanggal_lahir)->format('d/m/Y') }}</p>
                    <p><strong>Jabatan:</strong> {{ $pegawai->jabatan }}</p>
                    <p><strong>Departemen:</strong> {{ $pegawai->departemen }}</p>
                    <p><strong>Tanggal Masuk:</strong> {{ \Carbon\Carbon::parse($pegawai->tanggal_masuk)->format('d/m/Y') }}</p>
                    <p><strong>Email:</strong> {{ $pegawai->email }}</p>
                    <p><strong>Telepon:</strong> {{ $pegawai->telepon }}</p>
                    <p><strong>Alamat:</strong><br>{{ $pegawai->alamat }}</p>
                </div>

                <div class="mt-6 flex gap-4">
                    <a href="{{ route('pegawai.edit', $pegawai->id) }}">
                        <x-primary-button>Edit</x-primary-button>
                    </a>

                    <form action="{{ route('pegawai.destroy', $pegawai->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                        @csrf
                        @method('DELETE')
                        <x-danger-button>Hapus</x-danger-button>
                    </form>

                    <a href="{{ route('pegawai.index') }}">
                        <x-secondary-button>Kembali</x-secondary-button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
