<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - LaundryPro</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased text-gray-900 bg-white">
    <div class="flex min-h-screen">
        
        <!-- Bagian Kiri: Form Login -->
        <div class="flex flex-col justify-center w-full max-w-md px-6 py-12 mx-auto lg:w-1/2 lg:max-w-xl lg:px-16 xl:px-24">
            <div>
                <a href="/" class="text-3xl font-extrabold text-blue-600 tracking-tight">Laundry<span class="text-gray-800">Pro</span></a>
                <h2 class="mt-8 text-2xl font-bold text-gray-900">Selamat Datang Kembali</h2>
                <p class="mt-2 text-sm text-gray-500">Silakan masuk dengan akun Admin atau Staff Anda.</p>
            </div>

            <div class="mt-8">
                <!-- Session Status (Misal: pesan setelah reset password) -->
                @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                        <div class="mt-1">
                            <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus autocomplete="username" class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        </div>
                        @error('email')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <div class="flex items-center justify-between">
                            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-sm font-medium text-blue-600 hover:text-blue-500">Lupa password?</a>
                            @endif
                        </div>
                        <div class="mt-1">
                            <input id="password" name="password" type="password" required autocomplete="current-password" class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        </div>
                        @error('password')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center">
                        <input id="remember_me" type="checkbox" name="remember" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                        <label for="remember_me" class="block ml-2 text-sm text-gray-700">Ingat Saya</label>
                    </div>

                    <div>
                        <button type="submit" class="flex justify-center w-full px-4 py-3 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-lg shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
                            Masuk ke Sistem
                        </button>
                    </div>
                </form>

                <!-- Info Akun Demo (Bagus untuk yang melihat portfolio Anda) -->
                <div class="mt-10 p-4 bg-blue-50 rounded-lg border border-blue-100 text-sm text-gray-600">
                    <p class="font-bold text-blue-800 mb-2">Akun Demo Akses:</p>
                    <div class="flex justify-between border-b border-blue-200 pb-2 mb-2">
                        <span>Admin: <span class="font-bold text-gray-900">admin@laundry.com</span></span>
                        <span class="font-mono">password123</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Staff: <span class="font-bold text-gray-900">staff@laundry.com</span></span>
                        <span class="font-mono">password123</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bagian Kanan: Visual/Gambar (Akan sembunyi di layar HP) -->
        <div class="hidden lg:flex lg:w-1/2 lg:flex-col lg:justify-center lg:items-center bg-blue-600 relative overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-br from-blue-700 to-blue-900 opacity-95"></div>
            
            <!-- Elemen Dekoratif CSS Abstrak -->
            <div class="absolute -bottom-32 -left-40 w-96 h-96 bg-blue-500 rounded-full mix-blend-multiply filter blur-3xl opacity-70"></div>
            <div class="absolute -top-40 -right-20 w-96 h-96 bg-cyan-400 rounded-full mix-blend-multiply filter blur-3xl opacity-70"></div>
            
            <div class="relative z-10 text-center px-12 text-white">
                <svg class="w-24 h-24 mx-auto mb-6 opacity-90" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
                <h2 class="text-4xl font-extrabold tracking-tight mb-4">Efisiensi Maksimal</h2>
                <p class="text-lg text-blue-100 max-w-md mx-auto">Tingkatkan produktivitas bisnis laundry Anda dengan sistem Point of Sale (POS) dan pendataan terintegrasi.</p>
            </div>
        </div>
        
    </div>
</body>
</html>