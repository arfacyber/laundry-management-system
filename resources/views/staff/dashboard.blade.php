<x-app-layout>
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-gray-900">Beranda Staff</h1>
        <p class="text-sm text-gray-500 mt-1">Selamat datang, kelola cucian dan pelanggan hari ini.</p>
    </div>

    <!-- Tombol Aksi Cepat -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
        <a href="{{ route('transactions.create') }}" class="flex items-center p-6 bg-blue-600 rounded-lg shadow-md hover:bg-blue-700 transition">
            <div class="w-12 h-12 bg-white bg-opacity-20 rounded-full flex items-center justify-center text-white mr-4">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
            </div>
            <div>
                <h3 class="text-lg font-bold text-white">Buat Transaksi Baru</h3>
                <p class="text-blue-100 text-sm mt-1">Terima cucian dari pelanggan</p>
            </div>
        </a>

        <a href="{{ route('transactions.index') }}" class="flex items-center p-6 bg-white border border-gray-200 rounded-lg shadow-sm hover:bg-gray-50 transition">
            <div class="w-12 h-12 bg-green-50 text-green-600 rounded-full flex items-center justify-center mr-4">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            </div>
            <div>
                <h3 class="text-lg font-bold text-gray-900">Perbarui Status / Pembayaran</h3>
                <p class="text-gray-500 text-sm mt-1">Kelola transaksi yang sedang berjalan</p>
            </div>
        </a>
    </div>

    <div class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 bg-blue-50">
            <h3 class="font-bold text-blue-800">Cucian Siap Diambil (Perlu dihubungi)</h3>
        </div>
        
        <ul class="divide-y divide-gray-200">
            @forelse ($readyForPickup as $trx)
                <li class="p-4 hover:bg-gray-50 flex justify-between items-center">
                    <div>
                        <p class="font-bold text-gray-900">{{ $trx->customer->nama }} <span class="text-sm font-normal text-gray-500">({{ $trx->customer->nomor_hp }})</span></p>
                        <p class="text-sm text-gray-500">Kode: {{ $trx->transaction_code }} | Selesai tgl: {{ $trx->updated_at->format('d M') }}</p>
                    </div>
                    <a href="{{ route('transactions.show', $trx->id) }}" class="px-3 py-1 bg-white border border-gray-300 rounded text-sm font-medium hover:bg-gray-50">
                        Proses Pengambilan
                    </a>
                </li>
            @empty
                <li class="p-8 text-center text-gray-500 text-sm">
                    Saat ini tidak ada cucian dengan status "Siap Diambil".
                </li>
            @endforelse
        </ul>
    </div>
</x-app-layout>