<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Pegawai') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Alert Error -->
            @if($errors->any())
                <div class="p-4 bg-red-100 border border-red-300 text-red-800 rounded-lg">
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Card -->
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <form action="{{ route('pegawai.update', $pegawai->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Form Body -->
                    <div class="p-6 space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Data Dasar -->
                            <div class="space-y-4">
                                <h4 class="text-lg font-medium text-gray-900 border-b pb-2">Data Dasar</h4>

                                <div>
                                    <x-input-label for="nama" value="Nama" />
                                    <x-text-input id="nama" name="nama" type="text" class="mt-1 block w-full" value="{{ old('nama', $pegawai->nama) }}" required />
                                </div>

                                <div>
                                    <x-input-label for="nip" value="NIP (Read Only)" />
                                    <x-text-input id="nip" name="nip" type="text" class="mt-1 block w-full" value="{{ old('nip', $pegawai->nip) }}" readonly />
                                </div>

                                <div>
                                    <x-input-label for="jenis_kelamin" value="Jenis Kelamin" />
                                    <select id="jenis_kelamin" name="jenis_kelamin" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                        <option value="L" @selected(old('jenis_kelamin', $pegawai->jenis_kelamin) == 'L')>Laki-laki</option>
                                        <option value="P" @selected(old('jenis_kelamin', $pegawai->jenis_kelamin) == 'P')>Perempuan</option>
                                    </select>
                                </div>

                                <div>
                                    <x-input-label for="tempat_lahir" value="Tempat Lahir" />
                                    <x-text-input id="tempat_lahir" name="tempat_lahir" type="text" class="mt-1 block w-full" value="{{ old('tempat_lahir', $pegawai->tempat_lahir) }}" />
                                </div>

                                <div>
                                    <x-input-label for="tanggal_lahir" value="Tanggal Lahir" />
                                    <x-text-input id="tanggal_lahir" name="tanggal_lahir" type="date" class="mt-1 block w-full" value="{{ old('tanggal_lahir', $pegawai->tanggal_lahir->format('Y-m-d')) }}" />
                                </div>
                            </div>

                            <!-- Data Pekerjaan -->
                            <div class="space-y-4">
                                <h4 class="text-lg font-medium text-gray-900 border-b pb-2">Data Pekerjaan</h4>

                                <div>
                                    <x-input-label for="jabatan" value="Jabatan" />
                                    <x-text-input id="jabatan" name="jabatan" type="text" class="mt-1 block w-full" value="{{ old('jabatan', $pegawai->jabatan) }}" />
                                </div>

                                <div>
                                    <x-input-label for="departemen" value="Departemen" />
                                    <x-text-input id="departemen" name="departemen" type="text" class="mt-1 block w-full" value="{{ old('departemen', $pegawai->departemen) }}" />
                                </div>

                                <div>
                                    <x-input-label for="tanggal_masuk" value="Tanggal Masuk" />
                                    <x-text-input id="tanggal_masuk" name="tanggal_masuk" type="date" class="mt-1 block w-full" value="{{ old('tanggal_masuk', $pegawai->tanggal_masuk->format('Y-m-d')) }}" />
                                </div>

                                <div>
                                    <x-input-label for="status" value="Status" />
                                    <select id="status" name="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                        <option value="aktif" @selected(old('status', $pegawai->status) == 'aktif')>Aktif</option>
                                        <option value="cuti" @selected(old('status', $pegawai->status) == 'cuti')>Cuti</option>
                                        <option value="nonaktif" @selected(old('status', $pegawai->status) == 'nonaktif')>Nonaktif</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Kontak -->
                            <div class="space-y-4">
                                <h4 class="text-lg font-medium text-gray-900 border-b pb-2">Kontak</h4>

                                <div>
                                    <x-input-label for="email" value="Email" />
                                    <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" value="{{ old('email', $pegawai->email) }}" />
                                </div>

                                <div>
                                    <x-input-label for="telepon" value="Telepon Pribadi" />
                                    <x-text-input id="telepon" name="telepon" type="text" class="mt-1 block w-full" value="{{ old('telepon', $pegawai->telepon) }}" />
                                </div>

                                <div>
                                    <x-input-label for="kontak_darurat" value="Kontak Darurat" />
                                    <x-text-input id="kontak_darurat" name="kontak_darurat" type="text" class="mt-1 block w-full" value="{{ old('kontak_darurat', $pegawai->kontak_darurat) }}" />
                                </div>
                            </div>

                            <!-- Tambahan -->
                            <div class="space-y-4">
                                <h4 class="text-lg font-medium text-gray-900 border-b pb-2">Lainnya</h4>

                                <div>
                                    <x-input-label for="npwp" value="NPWP" />
                                    <x-text-input id="npwp" name="npwp" type="text" class="mt-1 block w-full" value="{{ old('npwp', $pegawai->npwp) }}" />
                                </div>

                                <div>
                                    <x-input-label for="no_rek" value="Nomor Rekening" />
                                    <x-text-input id="no_rek" name="no_rek" type="text" class="mt-1 block w-full" value="{{ old('no_rek', $pegawai->no_rek) }}" />
                                </div>

                                <div>
                                    <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                                    <textarea id="alamat" name="alamat" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('alamat', $pegawai->alamat) }}</textarea>

                                </div>

                                <div>
                                    <label for="keterangan" class="block text-sm font-medium text-gray-700">Keterangan</label>
                                    <textarea id="keterangan" name="keterangan" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('keterangan', $pegawai->keterangan) }}</textarea>

                                </div>

                                <div>
                                    <x-input-label for="foto" value="Foto Profil (Opsional)" />
                                    <x-text-input id="foto" name="foto" type="file" class="mt-1 block w-full" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-between">
                        <a href="{{ route('pegawai.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md text-gray-700 hover:bg-gray-100">
                            Batal
                        </a>
                        <x-primary-button>Simpan Perubahan</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
