<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lacak Cucian - LaundryPro</title>
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-900 font-sans antialiased flex flex-col min-h-screen">
    <nav class="bg-blue-600 text-white shadow-md p-4">
        <div class="max-w-4xl mx-auto flex justify-between items-center">
            <a href="/" class="text-xl font-bold">LaundryPro</a>
            <a href="/" class="text-sm text-blue-100 hover:text-white transition">Beranda</a>
        </div>
    </nav>

    <main class="flex-grow flex items-center justify-center p-4 sm:p-6">
        <div class="w-full max-w-xl bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
            <div class="p-6 sm:p-8 text-center bg-blue-50 border-b border-blue-100">
                <h1 class="text-2xl font-bold text-gray-900 mb-2">Lacak Status Cucian Anda</h1>
                <p class="text-gray-500 text-sm">Masukkan nomor kode transaksi yang ada pada struk nota.</p>
            </div>
            
            <div class="p-6 sm:p-8">
                <form action="{{ route('tracking.search') }}" method="GET" class="flex flex-col sm:flex-row gap-3">
                    <input type="text" name="transaction_code" value="{{ request('transaction_code') }}" placeholder="Contoh: TRX-20231010-ABCD" required class="flex-1 rounded-md border-gray-300 focus:ring-blue-500 focus:border-blue-500 px-4 py-3 sm:py-2">
                    <button type="submit" class="w-full sm:w-auto bg-blue-600 text-white px-8 py-3 sm:py-2 rounded-md hover:bg-blue-700 font-medium transition shadow-sm">Lacak</button>
                </form>

                @if(request()->has('transaction_code'))
                    <div class="mt-8 pt-8 border-t border-gray-100">
                        @if(isset($transaction) && $transaction)
                            <div class="text-center">
                                <span class="block text-sm text-gray-500 mb-2">Status Saat Ini:</span>
                                @php
                                    $color = match($transaction->status_laundry) {
                                        'Menunggu' => 'bg-gray-100 text-gray-800 border border-gray-200',
                                        'Selesai', 'Siap Diambil' => 'bg-green-100 text-green-800 border border-green-200',
                                        'Dibatalkan' => 'bg-red-100 text-red-800 border border-red-200',
                                        default => 'bg-yellow-100 text-yellow-800 border border-yellow-200'
                                    };
                                @endphp
                                <span class="inline-block px-6 py-3 rounded-full text-lg font-bold {{ $color }}">
                                    {{ $transaction->status_laundry }}
                                </span>
                            </div>
                            <div class="mt-8 bg-gray-50 p-5 rounded-xl border border-gray-200 text-sm space-y-3 shadow-inner">
                                <div class="flex flex-col sm:flex-row sm:justify-between border-b pb-2 sm:border-0 sm:pb-0">
                                    <span class="text-gray-500 mb-1 sm:mb-0">Pelanggan:</span>
                                    <span class="font-bold text-gray-900 text-base">{{ $transaction->masked_name }}</span>
                                </div>
                                <div class="flex flex-col sm:flex-row sm:justify-between border-b pb-2 sm:border-0 sm:pb-0">
                                    <span class="text-gray-500 mb-1 sm:mb-0">Tanggal Masuk:</span>
                                    <span class="font-medium text-gray-900">{{ $transaction->tanggal_masuk->format('d/m/Y') }}</span>
                                </div>
                                <div class="flex flex-col sm:flex-row sm:justify-between">
                                    <span class="text-gray-500 mb-1 sm:mb-0">Estimasi Selesai:</span>
                                    <span class="font-medium text-gray-900">{{ $transaction->estimasi_selesai->format('d/m/Y') }}</span>
                                </div>
                            </div>
                        @else
                            <div class="bg-red-50 text-red-600 p-4 rounded-md text-center text-sm border border-red-100">
                                Transaksi dengan kode <strong>{{ request('transaction_code') }}</strong> tidak ditemukan.
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </main>
</body>
</html>