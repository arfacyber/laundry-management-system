<x-app-layout>
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900">Tambah Layanan</h1>
            <p class="text-sm text-gray-500 mt-1">Tambahkan layanan baru beserta harganya.</p>
        </div>
        <a href="{{ route('admin.services.index') }}" class="text-gray-600 border border-gray-300 px-4 py-2 rounded-md hover:bg-gray-50 transition">Kembali</a>
    </div>

    <div class="bg-white rounded-lg border border-gray-200 shadow-sm max-w-2xl">
        <form action="{{ route('admin.services.store') }}" method="POST" class="p-6 space-y-6">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700">Nama Layanan <span class="text-red-500">*</span></label>
                <input type="text" name="nama_layanan" value="{{ old('nama_layanan') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" placeholder="Contoh: Cuci Kering Reguler">
                @error('nama_layanan') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Harga (Rp) <span class="text-red-500">*</span></label>
                    <input type="number" name="harga" value="{{ old('harga') }}" required min="0" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" placeholder="Contoh: 7000">
                    @error('harga') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Unit Satuan <span class="text-red-500">*</span></label>
                    <select name="unit" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                        <option value="kg" {{ old('unit') == 'kg' ? 'selected' : '' }}>Kilogram (kg)</option>
                        <option value="pcs" {{ old('unit') == 'pcs' ? 'selected' : '' }}>Pcs (Satuan)</option>
                        <option value="pasang" {{ old('unit') == 'pasang' ? 'selected' : '' }}>Pasang (Sepatu/Kaos Kaki)</option>
                        <option value="meter" {{ old('unit') == 'meter' ? 'selected' : '' }}>Meter (Karpet)</option>
                    </select>
                    @error('unit') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Status Layanan <span class="text-red-500">*</span></label>
                <div class="mt-2 space-y-2">
                    <div class="flex items-center">
                        <input id="status_aktif_1" name="status_aktif" type="radio" value="1" {{ old('status_aktif', '1') == '1' ? 'checked' : '' }} class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300">
                        <label for="status_aktif_1" class="ml-3 block text-sm font-medium text-gray-700">Aktif (Bisa dipilih saat transaksi)</label>
                    </div>
                    <div class="flex items-center">
                        <input id="status_aktif_0" name="status_aktif" type="radio" value="0" {{ old('status_aktif') == '0' ? 'checked' : '' }} class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300">
                        <label for="status_aktif_0" class="ml-3 block text-sm font-medium text-gray-700">Nonaktif (Sembunyikan dari transaksi baru)</label>
                    </div>
                </div>
                @error('status_aktif') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div class="pt-4 border-t border-gray-200 flex justify-end">
                <button type="submit" class="bg-blue-600 text-white rounded-md shadow-sm py-2 px-6 text-sm font-medium hover:bg-blue-700">Simpan Layanan</button>
            </div>
        </form>
    </div>
</x-app-layout>