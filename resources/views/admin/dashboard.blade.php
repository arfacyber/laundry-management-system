<x-app-layout>
    <!-- Header dengan Gradasi Premium -->
    <div class="bg-gradient-to-r from-blue-600 via-indigo-600 to-blue-800 pb-32 pt-12 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-extrabold text-white tracking-tight">Dashboard Administrator</h1>
            <p class="mt-2 text-blue-100 text-sm font-medium">Ringkasan aktivitas dan performa bisnis LaundryPro Anda hari ini.</p>
        </div>
    </div>

    <!-- Konten Utama (Ditarik ke atas agar menumpuk dengan header) -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-20">
        
        <!-- Grid Kartu Statistik Berbayang -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            
            <!-- Kartu Total Pelanggan -->
            <div class="bg-white rounded-2xl shadow-xl p-6 border border-slate-100 transform transition duration-300 hover:-translate-y-2 hover:shadow-2xl">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-semibold text-slate-500 uppercase tracking-wider">Total Pelanggan</p>
                        <p class="text-3xl font-black text-slate-800 mt-2">0</p>
                    </div>
                    <div class="p-4 bg-blue-50 text-blue-600 rounded-2xl shadow-inner">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                </div>
            </div>

            <!-- Kartu Transaksi -->
            <div class="bg-white rounded-2xl shadow-xl p-6 border border-slate-100 transform transition duration-300 hover:-translate-y-2 hover:shadow-2xl">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-semibold text-slate-500 uppercase tracking-wider">Transaksi Hari Ini</p>
                        <p class="text-3xl font-black text-slate-800 mt-2">0</p>
                    </div>
                    <div class="p-4 bg-emerald-50 text-emerald-500 rounded-2xl shadow-inner">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                    </div>
                </div>
            </div>

            <!-- Kartu Pendapatan -->
            <div class="bg-white rounded-2xl shadow-xl p-6 border border-slate-100 transform transition duration-300 hover:-translate-y-2 hover:shadow-2xl">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-semibold text-slate-500 uppercase tracking-wider">Pendapatan (Bln Ini)</p>
                        <p class="text-3xl font-black text-slate-800 mt-2"><span class="text-xl text-slate-400">Rp</span> 0</p>
                    </div>
                    <div class="p-4 bg-amber-50 text-amber-500 rounded-2xl shadow-inner">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                </div>
            </div>

            <!-- Kartu Proses -->
            <div class="bg-white rounded-2xl shadow-xl p-6 border border-slate-100 transform transition duration-300 hover:-translate-y-2 hover:shadow-2xl">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-semibold text-slate-500 uppercase tracking-wider">Cucian Diproses</p>
                        <p class="text-3xl font-black text-slate-800 mt-2">0</p>
                    </div>
                    <div class="p-4 bg-purple-50 text-purple-500 rounded-2xl shadow-inner">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                    </div>
                </div>
            </div>

        </div>

        <!-- Tabel Transaksi Bergaya Modern -->
        <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-slate-100 mb-10">
            <div class="px-8 py-6 border-b border-slate-100 bg-slate-50/50 flex justify-between items-center">
                <h3 class="text-lg font-bold text-slate-800">5 Transaksi Terbaru</h3>
                <a href="#" class="text-sm font-semibold text-blue-600 hover:text-blue-800 transition">Lihat Semua Data &rarr;</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr>
                            <th class="py-4 px-8 bg-white font-semibold text-xs text-slate-400 uppercase tracking-wider border-b">Kode TRX</th>
                            <th class="py-4 px-8 bg-white font-semibold text-xs text-slate-400 uppercase tracking-wider border-b">Pelanggan</th>
                            <th class="py-4 px-8 bg-white font-semibold text-xs text-slate-400 uppercase tracking-wider border-b">Status</th>
                            <th class="py-4 px-8 bg-white font-semibold text-xs text-slate-400 uppercase tracking-wider border-b text-right">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Baris Data Kosong (Ganti dengan perulangan foreach nantinya) -->
                        <tr>
                            <td colspan="4" class="py-12 px-8 text-center border-b border-slate-50">
                                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-slate-100 mb-4">
                                    <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                                </div>
                                <p class="text-slate-500 font-medium text-sm">Belum ada transaksi saat ini.</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>
</x-app-layout>