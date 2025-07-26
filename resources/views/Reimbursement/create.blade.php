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
                            <label for="category" class="block text-sm font-medium text-gray-700">Kategori</label>
                            <select id="category" name="category" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                                <option value="">Pilih Kategori</option>
                                <option value="transport">Biaya Transportasi</option>
                                <option value="atk">Pembelian ATK</option>
                                <option value="health">Bill Kesehatan</option>
                                <option value="entertain">Entertain Klien</option>
                                <option value="other">Lainnya</option>
                            </select>
                            @error('category')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Tanggal --}}
                        <div>
                            <label for="date" class="block text-sm font-medium text-gray-700">Tanggal</label>
                            <input type="date" id="date" name="date" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                            @error('date')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Jumlah --}}
                        <div>
                            <label for="amount" class="block text-sm font-medium text-gray-700">Jumlah (Rp)</label>
                            <input type="number" id="amount" name="amount" min="1000" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                            @error('amount')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Deskripsi --}}
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                            <textarea id="description" name="description" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required></textarea>
                            @error('description')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Bukti Pembayaran --}}
                        <div>
                            <label for="proof_file" class="block text-sm font-medium text-gray-700">Bukti Pembayaran (Struk/Invoice)</label>
                            <input type="file" id="proof_file" name="proof_file" class="mt-1 block w-full text-sm text-gray-500
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-md file:border-0
                                file:text-sm file:font-semibold
                                file:bg-blue-50 file:text-blue-700
                                hover:file:bg-blue-100"
                                accept=".jpg,.png,.pdf" required>
                            
                            <p class="mt-1 text-sm text-gray-500">Format: JPG/PNG/PDF (max 5MB)</p>
                        </div>
                    </div>

                    <div class="flex justify-end mt-6 space-x-4">
                        <a href="{{ route('reimbursements.index') }}" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                            Batal
                        </a>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-black rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Ajukan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>