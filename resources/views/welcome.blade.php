<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LaundryPro - Sistem Manajemen Laundry</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />
    
    <!-- Scripts / Tailwind -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-gray-50 text-gray-900 font-sans">
    
    <!-- Navbar -->
    <nav class="bg-white shadow-sm border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex-shrink-0 flex items-center">
                    <span class="text-2xl font-extrabold text-blue-600">Laundry<span class="text-gray-800">Pro</span></span>
                </div>
                <div class="flex items-center gap-4">
                    <!-- Tombol Cek Resi untuk Publik -->
                    <a href="{{ route('tracking.index') }}" class="text-sm font-medium text-gray-700 hover:text-blue-600 transition flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        Cek Resi
                    </a>

                    @if (Route::has('login'))
                        @auth
                            <a href="{{ route('dashboard') }}" class="text-sm font-medium text-gray-700 hover:text-blue-600">Ke Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 transition">
                                Masuk Sistem
                            </a>
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-32">
        <div class="text-center">
            
            <!-- Judul Utama -->
            <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
                <span class="block">Kelola Bisnis Laundry Anda</span>
                <span class="block text-blue-600 mt-2">Lebih Cerdas & Profesional</span>
            </h1>
            
            <!-- Teks Deskripsi -->
            <p class="mt-5 max-w-md mx-auto text-base text-gray-500 sm:text-lg md:mt-8 md:text-xl md:max-w-3xl">
                Sistem Kasir (POS) dan Manajemen Laundry terintegrasi. Pantau transaksi, kelola pelanggan, dan lihat laporan keuangan dalam satu aplikasi canggih.
            </p>
            
            <!-- Tombol Aksi Utama (Hanya ditulis satu kali di sini) -->
            <div class="mt-10 max-w-sm mx-auto sm:max-w-none sm:flex sm:justify-center gap-4">
                
                <!-- Tombol Cek Resi untuk Publik -->
                <a href="{{ route('tracking.index') }}" class="w-full sm:w-auto flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-blue-700 bg-blue-50 hover:bg-blue-100 md:py-4 md:text-lg md:px-10 transition shadow-sm">
                    🔍 Cek Status Cucian
                </a>

                <!-- Tombol Login / Dashboard -->
                @if (Route::has('login'))
                    @auth
                        <a href="{{ route('dashboard') }}" class="w-full sm:w-auto flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 md:py-4 md:text-lg md:px-10 shadow-lg hover:shadow-xl transition">
                            Buka Dashboard Aplikasi
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="w-full sm:w-auto flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 md:py-4 md:text-lg md:px-10 shadow-lg hover:shadow-xl transition">
                            Login Admin / Staff
                        </a>
                    @endauth
                @endif

            </div>
            
        </div>
    <!-- (Lanjutan Fitur Grid di bawahnya jika ada...) -->

        <!-- Fitur Grid -->
        <div class="mt-24 grid grid-cols-1 gap-8 sm:grid-cols-3">
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8 text-center hover:shadow-md transition">
                <div class="mx-auto flex items-center justify-center h-14 w-14 rounded-full bg-blue-50 text-blue-600 mb-4">
                    <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900">Kasir Transaksi Cepat</h3>
                <p class="mt-3 text-sm text-gray-500">Pencatatan order cuci yang dinamis, hitung otomatis, dan cetak struk nota secara instan.</p>
            </div>
            
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8 text-center hover:shadow-md transition">
                <div class="mx-auto flex items-center justify-center h-14 w-14 rounded-full bg-green-50 text-green-600 mb-4">
                    <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900">Database Pelanggan</h3>
                <p class="mt-3 text-sm text-gray-500">Kelola kontak dan riwayat cucian pelanggan setia Anda agar tidak ada yang terlewatkan.</p>
            </div>
            
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8 text-center hover:shadow-md transition">
                <div class="mx-auto flex items-center justify-center h-14 w-14 rounded-full bg-yellow-50 text-yellow-600 mb-4">
                    <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900">Laporan Keuangan</h3>
                <p class="mt-3 text-sm text-gray-500">Pantau omzet dan seluruh pendapatan bulanan Anda secara otomatis dalam satu klik.</p>
            </div>
        </div>
    </main>

</body>
</html>