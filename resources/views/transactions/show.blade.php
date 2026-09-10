<x-app-layout>
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900">Detail Transaksi</h1>
            <p class="text-sm text-gray-500 mt-1">#{{ $transaction->transaction_code }}</p>
        </div>
        
        <!-- Area Tombol Aksi Kanan -->
        <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
            <button onclick="window.print()" class="w-full sm:w-auto justify-center bg-gray-800 text-white border border-transparent px-4 py-2 rounded-md hover:bg-gray-700 font-medium text-sm print:hidden flex items-center transition">
                <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" /></svg>
                Cetak Struk
            </button>
            <a href="{{ route('transactions.index') }}" class="w-full sm:w-auto text-center text-gray-600 border border-gray-300 px-4 py-2 rounded-md hover:bg-gray-50 font-medium text-sm print:hidden transition">Kembali</a>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg print:hidden">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="mb-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg print:hidden">
            {{ session('error') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Kolom Kiri: Detail & Invoice -->
        <div class="lg:col-span-2 space-y-6">
            
            <div class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden">
                <div class="p-4 sm:p-6 border-b border-gray-200 bg-gray-50 flex flex-col sm:flex-row justify-between sm:items-center gap-3">
                    <h2 class="text-lg font-bold text-gray-900">Invoice / Nota</h2>
                    @php
                        $color = match($transaction->status_laundry) {
                            'Menunggu' => 'bg-gray-200 text-gray-800',
                            'Diproses', 'Dicuci', 'Dikeringkan', 'Disetrika' => 'bg-yellow-200 text-yellow-800',
                            'Siap Diambil' => 'bg-blue-200 text-blue-800',
                            'Selesai' => 'bg-green-200 text-green-800',
                            'Dibatalkan' => 'bg-red-200 text-red-800',
                            default => 'bg-gray-200 text-gray-800'
                        };
                    @endphp
                    <span class="px-4 py-1.5 rounded-full text-sm font-bold w-fit {{ $color }}">Status: {{ $transaction->status_laundry }}</span>
                </div>

                <div class="p-4 sm:p-6 grid grid-cols-1 md:grid-cols-2 gap-6 border-b">
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Pelanggan:</p>
                        <p class="font-bold text-gray-900 text-lg">{{ $transaction->customer->nama }}</p>
                        <p class="text-sm text-gray-600">{{ $transaction->customer->nomor_hp }}</p>
                        <p class="text-sm text-gray-600 mt-1">{{ $transaction->customer->alamat ?? 'Tidak ada alamat' }}</p>
                    </div>
                    <div class="md:text-right">
                        <p class="text-sm text-gray-500 mb-1">Tanggal Masuk:</p>
                        <p class="font-bold text-gray-900 text-base">{{ $transaction->tanggal_masuk->format('d M Y') }}</p>
                        <p class="text-sm text-gray-500 mt-4 mb-1">Estimasi Selesai:</p>
                        <p class="font-bold text-gray-900 text-base">{{ $transaction->estimasi_selesai->format('d M Y') }}</p>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Layanan</th>
                                <th class="px-4 sm:px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                                <th class="px-4 sm:px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Qty</th>
                                <th class="px-4 sm:px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($transaction->items as $item)
                            <tr>
                                <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $item->service->nama_layanan }}</td>
                                <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm text-gray-600 text-right">Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                                <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm text-gray-600 text-right">{{ $item->quantity }} {{ $item->service->unit }}</td>
                                <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900 text-right">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="p-4 sm:p-6 bg-gray-50 border-t flex justify-end">
                    <div class="w-full sm:w-2/3 md:w-1/2 space-y-3 text-sm">
                        <div class="flex justify-between text-gray-600">
                            <span>Subtotal Item:</span>
                            <span class="font-medium">Rp {{ number_format($transaction->subtotal, 0, ',', '.') }}</span>
                        </div>
                        @if($transaction->discount > 0)
                        <div class="flex justify-between text-red-600">
                            <span>Diskon:</span>
                            <span class="font-medium">- Rp {{ number_format($transaction->discount, 0, ',', '.') }}</span>
                        </div>
                        @endif
                        @if($transaction->extra_cost > 0)
                        <div class="flex justify-between text-gray-600">
                            <span>Biaya Tambahan:</span>
                            <span class="font-medium">+ Rp {{ number_format($transaction->extra_cost, 0, ',', '.') }}</span>
                        </div>
                        @endif
                        <div class="flex justify-between text-xl font-bold text-gray-900 pt-3 border-t border-gray-300 mt-2">
                            <span>GRAND TOTAL</span>
                            <span>Rp {{ number_format($transaction->total, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            @if($transaction->notes)
            <div class="bg-yellow-50 border border-yellow-200 p-4 rounded-lg text-sm text-yellow-800 shadow-sm">
                <span class="font-bold block mb-1">Catatan Tambahan:</span> 
                {{ $transaction->notes }}
            </div>
            @endif
        </div>

        <!-- Kolom Kanan: Aksi & Pembayaran -->
        <div class="space-y-6">
            
            <!-- Update Status (Sembunyikan saat di-print) -->
            <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-4 sm:p-6 print:hidden">
                <h2 class="text-md font-bold text-gray-900 mb-4">Update Status Cucian</h2>
                <form action="{{ route('transactions.status.update', $transaction->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <select name="status_laundry" class="w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-sm mb-3 py-2">
                        @foreach(['Menunggu', 'Diproses', 'Dicuci', 'Dikeringkan', 'Disetrika', 'Siap Diambil', 'Selesai', 'Dibatalkan'] as $stat)
                            <option value="{{ $stat }}" {{ $transaction->status_laundry == $stat ? 'selected' : '' }}>{{ $stat }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="w-full bg-gray-800 text-white rounded-md text-sm py-2.5 font-bold hover:bg-gray-700 transition">Simpan Perubahan Status</button>
                </form>
            </div>

            <!-- Pembayaran -->
            <div class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden">
                <div class="p-4 bg-gray-800 text-white flex justify-between items-center">
                    <h2 class="font-bold">Status Pembayaran</h2>
                    @if($sisaTagihan <= 0)
                        <span class="bg-green-500 text-white text-xs px-3 py-1 rounded-full font-black tracking-wide">LUNAS</span>
                    @else
                        <span class="bg-red-500 text-white text-xs px-3 py-1 rounded-full font-black tracking-wide">BELUM LUNAS</span>
                    @endif
                </div>
                
                <div class="p-4 space-y-3 border-b text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-500">Total Tagihan</span>
                        <span class="font-bold text-gray-900 text-base">Rp {{ number_format($transaction->total, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Telah Dibayar</span>
                        <span class="font-bold text-green-600 text-base">Rp {{ number_format($totalDibayar, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between border-t border-gray-200 pt-3 mt-1">
                        <span class="text-gray-700 font-bold">Sisa Tagihan</span>
                        <span class="font-bold text-red-600 text-lg">Rp {{ number_format(max(0, $sisaTagihan), 0, ',', '.') }}</span>
                    </div>
                </div>

                @if($transaction->payments->count() > 0)
                    <div class="p-4 bg-gray-50">
                        <h3 class="text-xs font-bold text-gray-500 mb-3 uppercase tracking-wider">Riwayat Bayar:</h3>
                        <ul class="space-y-3">
                            @foreach($transaction->payments as $payment)
                            <li class="text-sm flex flex-col sm:flex-row sm:justify-between sm:items-center bg-white p-2 rounded border border-gray-100 shadow-sm gap-1">
                                <span class="text-gray-600 text-xs font-medium">{{ $payment->created_at->format('d/m/Y H:i') }} <span class="bg-gray-100 px-1 rounded ml-1">{{ strtoupper($payment->payment_method) }}</span></span>
                                <span class="font-bold text-green-600">Rp {{ number_format($payment->amount, 0, ',', '.') }}</span>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Form Tambah Pembayaran (Sembunyikan saat di-print) -->
                @if($sisaTagihan > 0)
                <div class="p-4 sm:p-5 border-t border-gray-200 print:hidden bg-white">
                    <h3 class="text-sm font-bold text-gray-900 mb-3">Terima Pembayaran Baru</h3>
                    <form action="{{ route('transactions.payment.store', $transaction->id) }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wide">Nominal Bayar (Rp)</label>
                            <input type="number" name="amount" value="{{ $sisaTagihan }}" max="{{ $sisaTagihan }}" required class="w-full rounded-md border-gray-300 text-sm focus:ring-blue-500 focus:border-blue-500 py-2 font-medium">
                        </div>
                        <div class="mb-5">
                            <label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wide">Metode</label>
                            <select name="payment_method" class="w-full rounded-md border-gray-300 text-sm focus:ring-blue-500 focus:border-blue-500 py-2">
                                <option value="cash">Cash / Tunai</option>
                                <option value="transfer">Transfer Bank</option>
                                <option value="qris">QRIS / E-Wallet</option>
                            </select>
                        </div>
                        <button type="submit" class="w-full bg-green-600 text-white rounded-md text-sm py-3 font-bold hover:bg-green-700 transition shadow-sm uppercase tracking-wide">Bayar Sekarang</button>
                    </form>
                </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>