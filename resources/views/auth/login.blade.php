<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-slate-50 py-12 px-4 sm:px-6 lg:px-8 font-sans">
        <div class="max-w-md w-full bg-white rounded-3xl shadow-xl overflow-hidden p-8 space-y-8 border border-slate-100">
            
            <!-- Bagian Header & Logo -->
            <div class="text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-blue-600 shadow-lg shadow-blue-200 mb-6 transform rotate-3">
                    <svg class="w-8 h-8 text-white -rotate-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10l-2 1m0 0l-2-1m2 1v2.5M20 7l-2 1m2-1l-2-1m2 1v2.5M14 4l-2-1-2 1M4 7l2-1M4 7l2 1M4 7v2.5M12 21l-2-1m2 1l2-1m-2 1v-2.5M6 18l-2-1v-2.5M18 18l2-1v-2.5"></path>
                    </svg>
                </div>
                <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">
                    LaundryPro
                </h2>
                <p class="mt-2 text-sm text-slate-500 font-medium">
                    Sistem Manajemen Laundry Modern
                </p>
            </div>

            <!-- Pesan Error (Jika ada) -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Formulir Login -->
            <form method="POST" action="{{ route('login') }}" class="mt-8 space-y-5">
                @csrf

                <div class="space-y-4">
                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-semibold text-slate-700 mb-1">Alamat Email</label>
                        <input id="email" name="email" type="email" autocomplete="email" required 
                            class="appearance-none block w-full px-4 py-3 border border-slate-300 rounded-xl shadow-sm placeholder-slate-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition duration-200" 
                            placeholder="nama@email.com" value="{{ old('email') }}">
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 text-xs font-medium" />
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-semibold text-slate-700 mb-1">Kata Sandi</label>
                        <input id="password" name="password" type="password" autocomplete="current-password" required 
                            class="appearance-none block w-full px-4 py-3 border border-slate-300 rounded-xl shadow-sm placeholder-slate-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition duration-200" 
                            placeholder="••••••••">
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 text-xs font-medium" />
                    </div>
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between pt-2">
                    <div class="flex items-center">
                        <input id="remember_me" name="remember" type="checkbox" 
                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-slate-300 rounded">
                        <label for="remember_me" class="ml-2 block text-sm font-medium text-slate-700">
                            Ingat Saya
                        </label>
                    </div>

                    @if (Route::has('password.request'))
                        <div class="text-sm">
                            <a href="{{ route('password.request') }}" class="font-semibold text-blue-600 hover:text-blue-500 transition duration-150">
                                Lupa sandi?
                            </a>
                        </div>
                    @endif
                </div>

                <!-- Tombol Login -->
                <div class="pt-2">
                    <button type="submit" 
                        class="w-full flex justify-center py-3.5 px-4 border border-transparent rounded-xl shadow-md text-sm font-bold text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-200 transform hover:-translate-y-0.5">
                        Masuk ke Sistem
                    </button>
                </div>
            </form>

            <!-- Bagian Akun Demo (Bisa dihapus nanti saat rilis ke publik) -->
            <div class="mt-8 pt-6 border-t border-slate-100">
                <p class="text-xs text-slate-500 text-center mb-4 font-semibold uppercase tracking-wider">Akses Cepat Akun Demo</p>
                <div class="grid grid-cols-2 gap-3">
                    <!-- Pastikan mengubah 'admin@gmail.com' dan 'password' sesuai data seeder Anda -->
                    <button type="button" onclick="fillDemo('admin@laundry.com', 'password')" class="flex items-center justify-center py-2.5 px-4 border border-blue-200 rounded-xl shadow-sm text-sm font-bold text-blue-700 bg-blue-50 hover:bg-blue-100 transition duration-200">
                        👨‍💼 Admin
                    </button>
                    <!-- Pastikan mengubah 'staff@gmail.com' dan 'password' sesuai data seeder Anda -->
                    <button type="button" onclick="fillDemo('staff@laundry.com', 'password')" class="flex items-center justify-center py-2.5 px-4 border border-teal-200 rounded-xl shadow-sm text-sm font-bold text-teal-700 bg-teal-50 hover:bg-teal-100 transition duration-200">
                        👩‍💻 Staff
                    </button>
                </div>
            </div>
            
        </div>
    </div>

    <!-- Script untuk mengisi form otomatis saat tombol demo diklik -->
    <script>
        function fillDemo(email, password) {
            document.getElementById('email').value = email;
            document.getElementById('password').value = password;
        }
    </script>
</x-guest-layout>