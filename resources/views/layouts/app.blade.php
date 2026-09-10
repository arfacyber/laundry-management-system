<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'LaundryPro') }} - Dashboard</title>
        
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style> body { font-family: 'Plus Jakarta Sans', sans-serif; } </style>
    </head>
    <body class="font-sans antialiased bg-slate-50 text-slate-900 overflow-hidden">
        <div class="flex h-screen w-full">
            
            <!-- Sidebar Navigation -->
            <aside class="w-64 bg-white shadow-2xl flex flex-col z-20 flex-shrink-0">
                <!-- Logo -->
                <div class="h-20 flex items-center px-8 border-b border-slate-100">
                    <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center mr-3 shadow-lg shadow-blue-200">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10l-2 1m0 0l-2-1m2 1v2.5M20 7l-2 1m2-1l-2-1m2 1v2.5M14 4l-2-1-2 1M4 7l2-1M4 7l2 1M4 7v2.5M12 21l-2-1m2 1l2-1m-2 1v-2.5M6 18l-2-1v-2.5M18 18l2-1v-2.5"></path></svg>
                    </div>
                    <span class="text-2xl font-extrabold text-slate-800 tracking-tight">LaundryPro</span>
                </div>

                <!-- Menu Links -->
                <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
                    
                    <!-- 1. Menu Dashboard (Bisa diakses Admin & Staff) -->
                    @php
                        $dashboardRoute = auth()->user()->role === 'admin' ? route('admin.dashboard') : route('staff.dashboard');
                        $isDashboardActive = request()->routeIs('admin.dashboard') || request()->routeIs('staff.dashboard');
                    @endphp
                    <a href="{{ $dashboardRoute }}" class="flex items-center px-4 py-3.5 text-sm font-semibold rounded-xl transition duration-200 {{ $isDashboardActive ? 'bg-blue-600 text-white shadow-md shadow-blue-200' : 'text-slate-500 hover:bg-slate-50 hover:text-blue-600' }}">
                        <svg class="w-5 h-5 mr-3 {{ $isDashboardActive ? 'text-blue-100' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                        Dashboard
                    </a>

                    <!-- 2. Menu Transaksi (Bisa diakses Admin & Staff) -->
                    <a href="{{ route('transactions.index') }}" class="flex items-center px-4 py-3.5 text-sm font-semibold rounded-xl transition duration-200 {{ request()->routeIs('transactions.*') ? 'bg-blue-600 text-white shadow-md shadow-blue-200' : 'text-slate-500 hover:bg-slate-50 hover:text-blue-600' }}">
                        <svg class="w-5 h-5 mr-3 {{ request()->routeIs('transactions.*') ? 'text-blue-100' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                        Kelola Transaksi
                    </a>

                    <!-- KUNCI KEAMANAN: HANYA TAMPIL UNTUK ADMIN -->
                    @if(auth()->user()->role === 'admin')
                        <!-- 3. Menu Pelanggan (Contoh dibatasi hanya Admin) -->
                        <a href="{{ route('customers.index') }}" class="flex items-center px-4 py-3.5 text-sm font-semibold rounded-xl transition duration-200 {{ request()->routeIs('customers.*') ? 'bg-blue-600 text-white shadow-md shadow-blue-200' : 'text-slate-500 hover:bg-slate-50 hover:text-blue-600' }}">
                            <svg class="w-5 h-5 mr-3 {{ request()->routeIs('customers.*') ? 'text-blue-100' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            Data Pelanggan
                        </a>

                        <!-- 4. Menu Layanan / Paket Laundry (Hanya Admin) -->
                        <a href="{{ route('admin.services.index') }}" class="flex items-center px-4 py-3.5 text-sm font-semibold rounded-xl transition duration-200 {{ request()->routeIs('admin.services.*') ? 'bg-blue-600 text-white shadow-md shadow-blue-200' : 'text-slate-500 hover:bg-slate-50 hover:text-blue-600' }}">
                            <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.services.*') ? 'text-blue-100' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                            Layanan Laundry
                        </a>

                        <!-- 5. Menu Laporan (Hanya Admin) -->
                        <a href="{{ route('admin.reports.monthly') }}" class="flex items-center px-4 py-3.5 text-sm font-semibold rounded-xl transition duration-200 {{ request()->routeIs('admin.reports.*') ? 'bg-blue-600 text-white shadow-md shadow-blue-200' : 'text-slate-500 hover:bg-slate-50 hover:text-blue-600' }}">
                            <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.reports.*') ? 'text-blue-100' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            Laporan Bulanan
                        </a>
                    @endif
                    
                </nav>

                <!-- Logout Area -->
                <div class="p-6 border-t border-slate-100 bg-slate-50/50">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center justify-center px-4 py-3 text-sm font-bold text-red-600 bg-red-50 rounded-xl hover:bg-red-100 transition duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                            Keluar Sistem
                        </button>
                    </form>
                </div>
            </aside>

            <!-- Main Content Area -->
            <main class="flex-1 flex flex-col h-screen overflow-x-hidden overflow-y-auto bg-slate-50">
                <!-- User Top Bar -->
                <div class="h-16 bg-white border-b border-slate-100 flex items-center justify-end px-8 shadow-sm">
                    <div class="flex items-center space-x-3 cursor-pointer">
                        <div class="w-9 h-9 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <span class="text-sm font-bold text-slate-700">{{ Auth::user()->name }}</span>
                    </div>
                </div>

                <!-- Render Halaman -->
                <div class="relative w-full">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </body>
</html>