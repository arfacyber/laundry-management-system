<x-app-layout>
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900">Laporan Bulanan Laundry</h1>
            <p class="text-sm text-gray-500 mt-1">Rekapitulasi transaksi dan pendapatan per periode.</p>
        </div>
        <button onclick="window.print()" class="w-full sm:w-auto bg-gray-800 text-white px-4 py-2 rounded text-sm font-medium hover:bg-gray-700 print:hidden transition">
            Cetak Laporan
        </button>
    </div>

    <!-- Filter Bulan & Tahun -->
    <div class="bg-white p-4 rounded-lg border border-gray-200 mb-6 print:hidden">
        <form action="{{ route('admin.reports.monthly') }}" method="GET" class="flex flex-col sm:flex-row gap-4 sm:items-end">
            <div class="w-full sm:w-auto">
                <label class="block text-xs text-gray-500 mb-1">Bulan</label>
                <select name="month" class="w-full sm:w-auto rounded-md border-gray-300 text-sm focus:ring-blue-500 focus:border-blue-500">
                    @for($i = 1; $i <= 12; $i++)
                        <option value="{{ $i }}" {{ $month == $i ? 'selected' : '' }}>
                            {{ Carbon\Carbon::create()->month($i)->translatedFormat('F') }}
                        </option>
                    @endfor
                </select>
            </div>
            <div class="w-full sm:w-auto">
                <label class="block text-xs text-gray-500 mb-1">Tahun</label>
                <select name="year" class="w-full sm:w-auto rounded-md border-gray-300 text-sm focus:ring-blue-500 focus:border-blue-500">
                    @for($y = date('Y'); $y >= 2024; $y--)
                        <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>{{ $y }}</option>
                    @endfor
                </select>
            </div>
            <button type="submit" class="w-full sm:w-auto bg-blue-600 text-white px-6 py-2 rounded-md text-sm font-medium hover:bg-blue-700 transition">Filter</button>
        </form>
    </div>

    <!-- Ringkasan Statistik -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div class="bg-white p-6 rounded-lg border border-gray-200 shadow-sm">
            <p class="text-sm text-gray-500 font-medium">Total Transaksi Masuk</p>
            <h3 class="text-3xl font-bold text-gray-900 mt-2">{{ $totalTransaksi }} <span class="text-lg font-normal text-gray-500">Pesanan</span></h3>
        </div>
        <div class="bg-white p-6 rounded-lg border border-gray-200 shadow-sm">
            <p class="text-sm text-gray-500 font-medium">Total Pendapatan Masuk (Kas)</p>
            <h3 class="text-3xl font-bold text-green-600 mt-2">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h3>
        </div>
    </div>

    <!-- Tabel Rekapitulasi -->
    <div class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b bg-gray-50 font-bold text-gray-700">Rincian Transaksi Periode Ini</div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-gray-50 text-gray-500 uppercase text-xs">
                    <tr>
                        <th class="px-6 py-3 text-left tracking-wider">Kode TRX</th>
                        <th class="px-6 py-3 text-left tracking-wider">Pelanggan</th>
                        <th class="px-6 py-3 text-left tracking-wider">Tanggal</th>
                        <th class="px-6 py-3 text-left tracking-wider">Status</th>
                        <th class="px-6 py-3 text-right tracking-wider">Total Tagihan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    @forelse($transactions as $trx)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 font-bold whitespace-nowrap">{{ $trx->transaction_code }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $trx->customer->nama }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $trx->tanggal_masuk->format('d/m/Y') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                {{ $trx->status_laundry }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right font-medium whitespace-nowrap">Rp {{ number_format($trx->total, 0, ',', '.') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-gray-500">Tidak ada transaksi pada bulan ini.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>