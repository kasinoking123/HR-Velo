<!-- resources/views/reimbursements/create.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ajukan Reimbursement') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg p-6">
                <form method="POST" action="{{ route('reimbursements.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-1 gap-6">
                        {{-- Kategori --}}
                        <div>
                            <x-input-label for="category" :value="__('Kategori')" />
                            <select id="category" name="category" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                                <option value="">Pilih Kategori</option>
                                <option value="transport">Biaya Transportasi</option>
                                <option value="atk">Pembelian ATK</option>
                                <option value="health">Bill Kesehatan</option>
                                <option value="entertain">Entertain Klien</option>
                                <option value="other">Lainnya</option>
                            </select>
                            <x-input-error :messages="$errors->get('category')" class="mt-2" />
                        </div>

                        {{-- Tanggal --}}
                        <div>
                            <x-input-label for="date" :value="__('Tanggal')" />
                            <x-text-input id="date" name="date" type="date" class="mt-1 block w-full" required />
                            <x-input-error :messages="$errors->get('date')" class="mt-2" />
                        </div>

                        {{-- Jumlah --}}
                        <div>
                            <x-input-label for="amount" :value="__('Jumlah (Rp)')" />
                            <x-text-input id="amount" name="amount" type="number" min="1000" class="mt-1 block w-full" required />
                            <x-input-error :messages="$errors->get('amount')" class="mt-2" />
                        </div>

                        {{-- Deskripsi --}}
                        <div>
                            <x-input-label for="description" :value="__('Deskripsi')" />
                            <x-text-area id="description" name="description" class="mt-1 block w-full" rows="3" required />
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        {{-- Bukti Pembayaran --}}
                        <div>
                            <x-input-label for="proof_file" :value="__('Bukti Pembayaran (Struk/Invoice)')" />
                            <x-file-input id="proof_file" name="proof_file" class="mt-1 block w-full" accept=".jpg,.png,.pdf" required />
                            <x-input-error :messages="$errors->get('proof_file')" class="mt-2" />
                            <p class="mt-1 text-sm text-gray-500">Format: JPG/PNG/PDF (max 5MB)</p>
                        </div>
                    </div>

                    <div class="flex justify-end mt-6 space-x-4">
                        <a href="{{ route('reimbursements.index') }}">
                            <x-secondary-button>Batal</x-secondary-button>
                        </a>
                        <x-primary-button>Ajukan</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>