<x-app-layout>
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900">Buat Transaksi Baru</h1>
            <p class="text-sm text-gray-500 mt-1">Sistem kasir (Point of Sale) penerimaan laundry.</p>
        </div>
    </div>

    @if($errors->any())
        <div class="mb-4 bg-red-50 text-red-700 p-4 rounded-lg">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('transactions.store') }}" method="POST" x-data="transactionForm()">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            <!-- Kolom Kiri: Data Utama & Layanan -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Info Pelanggan & Tanggal -->
                <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-4 sm:p-6">
                    <h2 class="text-lg font-medium text-gray-900 border-b pb-2 mb-4">Informasi Dasar</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Pelanggan <span class="text-red-500">*</span></label>
                            <select name="customer_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm py-2">
                                <option value="">-- Pilih Pelanggan --</option>
                                @foreach($customers as $c)
                                    <option value="{{ $c->id }}">{{ $c->nama }} ({{ $c->nomor_hp }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tanggal Masuk <span class="text-red-500">*</span></label>
                            <input type="date" name="tanggal_masuk" value="{{ date('Y-m-d') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm py-2">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Estimasi Selesai <span class="text-red-500">*</span></label>
                            <input type="date" name="estimasi_selesai" value="{{ date('Y-m-d', strtotime('+3 days')) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm py-2">
                        </div>
                    </div>
                </div>

                <!-- Input Layanan Dinamis (Alpine.js) -->
                <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-4 sm:p-6">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between border-b pb-2 mb-4 gap-2">
                        <h2 class="text-lg font-medium text-gray-900">Detail Layanan</h2>
                        <button type="button" @click="addItem()" class="w-full sm:w-auto text-sm bg-blue-50 text-blue-600 px-4 py-2 rounded hover:bg-blue-100 font-medium transition">+ Tambah Baris</button>
                    </div>

                    <div class="space-y-4">
                        <template x-for="(item, index) in items" :key="index">
                            <div class="grid grid-cols-1 sm:grid-cols-12 gap-3 items-end p-4 border rounded-lg bg-gray-50 relative">
                                <div class="sm:col-span-5">
                                    <label class="block text-xs font-medium text-gray-500 mb-1">Pilih Layanan</label>
                                    <select x-model="item.service_id" :name="'services['+index+'][id]'" @change="updateItem(index)" required class="block w-full rounded-md border-gray-300 py-2 text-sm focus:border-blue-500 focus:ring-blue-500">
                                        <option value="">- Pilih Layanan -</option>
                                        <template x-for="s in servicesData" :key="s.id">
                                            <option :value="s.id" x-text="s.nama_layanan + ' (Rp ' + s.harga + '/' + s.unit + ')'"></option>
                                        </template>
                                    </select>
                                </div>
                                <div class="sm:col-span-2">
                                    <label class="block text-xs font-medium text-gray-500 mb-1">Qty</label>
                                    <input type="number" step="0.1" min="0.1" x-model.number="item.qty" :name="'services['+index+'][quantity]'" @input="calculateItemSubtotal(index)" required class="block w-full rounded-md border-gray-300 py-2 text-sm focus:border-blue-500 focus:ring-blue-500">
                                </div>
                                <div class="sm:col-span-4">
                                    <label class="block text-xs font-medium text-gray-500 mb-1">Subtotal</label>
                                    <input type="text" x-bind:value="'Rp ' + item.subtotal.toLocaleString('id-ID')" readonly class="block w-full rounded-md border-gray-200 bg-gray-100 py-2 text-sm text-gray-600 cursor-not-allowed font-medium">
                                </div>
                                <div class="sm:col-span-1 flex justify-end sm:justify-center pb-1 absolute sm:relative top-2 right-2 sm:top-0 sm:right-0">
                                    <button type="button" @click="removeItem(index)" x-show="items.length > 1" class="text-red-500 hover:text-red-700 bg-white sm:bg-transparent rounded-full p-1 shadow sm:shadow-none border sm:border-0 border-red-100">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                    </button>
                                </div>
                            </div>
                        </template>
                    </div>

                    <div class="mt-6">
                        <label class="block text-sm font-medium text-gray-700">Catatan (Opsional)</label>
                        <textarea name="notes" rows="2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm p-3" placeholder="Contoh: Baju merah jangan dicampur..."></textarea>
                    </div>
                </div>
            </div>

            <!-- Kolom Kanan: Rincian Harga & Pembayaran -->
            <div class="space-y-6">
                <div class="bg-gray-800 text-white rounded-lg shadow-sm p-6">
                    <h2 class="text-lg font-medium border-b border-gray-700 pb-2 mb-4">Total Tagihan</h2>
                    
                    <div class="space-y-4 text-sm">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-1">
                            <span class="text-gray-400">Subtotal</span>
                            <span class="font-medium text-right" x-text="'Rp ' + subtotal.toLocaleString('id-ID')">Rp 0</span>
                        </div>
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-1">
                            <span class="text-gray-400">Diskon (Rp)</span>
                            <input type="number" min="0" name="discount" x-model.number="discount" class="w-full sm:w-28 px-3 py-1.5 bg-gray-700 border-gray-600 rounded text-right focus:ring-blue-500 text-white placeholder-gray-400" placeholder="0">
                        </div>
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-1">
                            <span class="text-gray-400">Biaya Extra (Rp)</span>
                            <input type="number" min="0" name="extra_cost" x-model.number="extraCost" class="w-full sm:w-28 px-3 py-1.5 bg-gray-700 border-gray-600 rounded text-right focus:ring-blue-500 text-white placeholder-gray-400" placeholder="0">
                        </div>
                        <div class="border-t border-gray-700 pt-4 mt-2 flex flex-col sm:flex-row justify-between sm:items-center gap-1">
                            <span class="font-bold text-lg text-gray-300">GRAND TOTAL</span>
                            <span class="font-bold text-3xl text-green-400 text-right" x-text="'Rp ' + total.toLocaleString('id-ID')">Rp 0</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-6">
                    <h2 class="text-lg font-medium text-gray-900 border-b pb-2 mb-4">Pembayaran Awal</h2>
                    
                    <div class="space-y-5">
                        <div class="flex flex-col sm:flex-row gap-4">
                            <label class="flex items-center cursor-pointer p-3 border rounded-lg hover:bg-gray-50 flex-1">
                                <input type="radio" name="payment_status" value="unpaid" x-model="paymentStatus" class="h-5 w-5 text-blue-600 focus:ring-blue-500 border-gray-300">
                                <span class="ml-3 text-sm text-gray-700 font-medium">Belum Bayar</span>
                            </label>
                            <label class="flex items-center cursor-pointer p-3 border rounded-lg hover:bg-green-50 border-green-100 flex-1">
                                <input type="radio" name="payment_status" value="paid" x-model="paymentStatus" class="h-5 w-5 text-green-600 focus:ring-green-500 border-gray-300">
                                <span class="ml-3 text-sm text-green-700 font-bold">Bayar Lunas</span>
                            </label>
                        </div>

                        <div x-show="paymentStatus === 'paid'" x-transition class="pt-3 border-t">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Pilih Metode Pembayaran</label>
                            <select name="payment_method" class="block w-full rounded-md border-gray-300 py-2.5 text-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="cash">Uang Tunai (Cash)</option>
                                <option value="transfer">Transfer Bank</option>
                                <option value="qris">QRIS / E-Wallet</option>
                            </select>
                        </div>
                    </div>
                </div>

                <button type="submit" class="w-full bg-blue-600 border border-transparent rounded-xl shadow-md py-4 px-4 text-center text-sm font-bold text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 uppercase tracking-wider transition transform hover:-translate-y-0.5">
                    Simpan & Buat Transaksi
                </button>
            </div>
        </div>
    </form>

    <script>
        function transactionForm() {
            return {
                servicesData: @json($services),
                items: [{ service_id: '', price: 0, qty: 1, subtotal: 0 }],
                discount: 0,
                extraCost: 0,
                paymentStatus: 'unpaid',
                
                get subtotal() {
                    return this.items.reduce((sum, item) => sum + item.subtotal, 0);
                },
                get total() {
                    return Math.max(0, this.subtotal - (this.discount || 0) + (this.extraCost || 0));
                },
                updateItem(index) {
                    let item = this.items[index];
                    let service = this.servicesData.find(s => s.id == item.service_id);
                    item.price = service ? service.harga : 0;
                    this.calculateItemSubtotal(index);
                },
                calculateItemSubtotal(index) {
                    let item = this.items[index];
                    item.subtotal = item.price * (item.qty || 0);
                },
                addItem() {
                    this.items.push({ service_id: '', price: 0, qty: 1, subtotal: 0 });
                },
                removeItem(index) {
                    if (this.items.length > 1) {
                        this.items.splice(index, 1);
                    }
                }
            }
        }
    </script>
</x-app-layout>