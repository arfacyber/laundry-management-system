<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-slate-800 leading-tight">
            {{ __('Ringkasan Hari Ini') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Kartu Statistik Atas -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Kartu 1: Pesanan Baru -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 flex items-center transition duration-200 hover:shadow-md">
                <div class="p-3 rounded-xl bg-blue-50 text-blue-600 mr-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-slate-500">Cucian Masuk</p>
                    <p class="text-2xl font-bold text-slate-800">24 <span class="text-sm font-normal text-slate-400">/ hari ini</span></p>
                </div>
            </div>

            <!-- Kartu 2: Sedang Diproses -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 flex items-center transition duration-200 hover:shadow-md">
                <div class="p-3 rounded-xl bg-amber-50 text-amber-600 mr-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-slate-500">Sedang Dicuci</p>
                    <p class="text-2xl font-bold text-slate-800">12 <span class="text-sm font-normal text-slate-400">mesin aktif</span></p>
                </div>
            </div>

            <!-- Kartu 3: Selesai -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 flex items-center transition duration-200 hover:shadow-md">
                <div class="p-3 rounded-xl bg-emerald-50 text-emerald-600 mr-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-slate-500">Siap Diambil</p>
                    <p class="text-2xl font-bold text-slate-800">8 <span class="text-sm font-normal text-slate-400">pesanan</span></p>
                </div>
            </div>
        </div>

        <!-- Tabel Aktivitas Terakhir -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-center">
                <h3 class="text-lg font-bold text-slate-800">Aktivitas Terakhir</h3>
                <a href="#" class="text-sm font-medium text-blue-600 hover:text-blue-700">Lihat Semua &rarr;</a>
            </div>
            <div class="p-6 text-center text-slate-500">
                <!-- Anda bisa mengganti ini dengan perulangan tabel data nyata nantinya -->
                <p>Belum ada data pesanan baru.</p>
            </div>
        </div>
    </div>
</x-app-layout>