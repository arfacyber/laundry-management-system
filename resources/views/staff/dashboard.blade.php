<x-app-layout>
    <!-- Header Gradasi Hijau/Teal Khas Staff -->
    <div class="bg-gradient-to-r from-teal-500 via-emerald-500 to-teal-600 pb-32 pt-12 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-extrabold text-white tracking-tight">Ruang Kerja Staff</h1>
            <p class="mt-2 text-teal-100 text-sm font-medium">Fokus pada operasional cucian dan pelayanan pelanggan hari ini.</p>
        </div>
    </div>

    <!-- Konten Utama Melayang -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-20">
        
        <!-- Grid Kartu Statistik Operasional -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            
            <!-- Kartu Cucian Baru -->
            <div class="bg-white rounded-2xl shadow-xl p-6 border border-slate-100 transform transition duration-300 hover:-translate-y-2 hover:shadow-2xl">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-semibold text-slate-500 uppercase tracking-wider">Cucian Masuk Hari Ini</p>
                        <p class="text-3xl font-black text-slate-800 mt-2">0</p>
                    </div>
                    <div class="p-4 bg-blue-50 text-blue-500 rounded-2xl shadow-inner">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    </div>
                </div>
            </div>

            <!-- Kartu Sedang Diproses -->
            <div class="bg-white rounded-2xl shadow-xl p-6 border border-slate-100 transform transition duration-300 hover:-translate-y-2 hover:shadow-2xl">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-semibold text-slate-500 uppercase tracking-wider">Sedang Dicuci</p>
                        <p class="text-3xl font-black text-slate-800 mt-2">0</p>
                    </div>
                    <div class="p-4 bg-amber-50 text-amber-500 rounded-2xl shadow-inner">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                    </div>
                </div>
            </div>

            <!-- Kartu Siap Diambil -->
            <div class="bg-white rounded-2xl shadow-xl p-6 border border-slate-100 transform transition duration-300 hover:-translate-y-2 hover:shadow-2xl">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-semibold text-slate-500 uppercase tracking-wider">Siap Diambil</p>
                        <p class="text-3xl font-black text-slate-800 mt-2">0</p>
                    </div>
                    <div class="p-4 bg-emerald-50 text-emerald-500 rounded-2xl shadow-inner">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                </div>
            </div>

        </div>

        <!-- Tabel Pekerjaan Aktif -->
        <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-slate-100 mb-10">
            <div class="px-8 py-6 border-b border-slate-100 bg-slate-50/50 flex justify-between items-center">
                <h3 class="text-lg font-bold text-slate-800">Antrean Cucian Aktif</h3>
                <a href="{{ route('transactions.index') }}" class="text-sm font-semibold text-teal-600 hover:text-teal-800 transition">Ke Halaman Transaksi &rarr;</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr>
                            <th class="py-4 px-8 bg-white font-semibold text-xs text-slate-400 uppercase tracking-wider border-b">Kode TRX</th>
                            <th class="py-4 px-8 bg-white font-semibold text-xs text-slate-400 uppercase tracking-wider border-b">Pelanggan</th>
                            <th class="py-4 px-8 bg-white font-semibold text-xs text-slate-400 uppercase tracking-wider border-b">Status Cucian</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Placeholder Data Kosong -->
                        <tr>
                            <td colspan="3" class="py-12 px-8 text-center border-b border-slate-50">
                                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-slate-100 mb-4">
                                    <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                                </div>
                                <p class="text-slate-500 font-medium text-sm">Belum ada antrean cucian aktif.</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>
</x-app-layout>