<x-app-layout>
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900">Edit Pelanggan</h1>
            <p class="text-sm text-gray-500 mt-1">Perbarui informasi data pelanggan.</p>
        </div>
        <a href="{{ route('customers.index') }}" class="text-gray-600 hover:text-gray-900 font-medium text-sm border border-gray-300 px-4 py-2 rounded-md hover:bg-gray-50 transition">
            Kembali
        </a>
    </div>

    <div class="bg-white rounded-lg border border-gray-200 shadow-sm max-w-2xl">
        <form action="{{ route('customers.update', $customer->id) }}" method="POST" class="p-6 space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="nama" class="block text-sm font-medium text-gray-700">Nama Lengkap <span class="text-red-500">*</span></label>
                <input type="text" name="nama" id="nama" value="{{ old('nama', $customer->nama) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                @error('nama')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="nomor_hp" class="block text-sm font-medium text-gray-700">Nomor HP / WhatsApp <span class="text-red-500">*</span></label>
                <input type="text" name="nomor_hp" id="nomor_hp" value="{{ old('nomor_hp', $customer->nomor_hp) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                @error('nomor_hp')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                <textarea name="alamat" id="alamat" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">{{ old('alamat', $customer->alamat) }}</textarea>
                @error('alamat')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="pt-4 border-t border-gray-200 flex justify-end">
                <button type="submit" class="bg-indigo-600 border border-transparent rounded-md shadow-sm py-2 px-6 inline-flex justify-center text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Perbarui Data
                </button>
            </div>
        </form>
    </div>
</x-app-layout>