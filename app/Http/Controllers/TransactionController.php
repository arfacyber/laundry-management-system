<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Service;
use App\Models\Transaction;
use App\Models\TransactionItem;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $query = Transaction::with(['customer', 'user'])->latest();

        if ($request->has('search')) {
            $search = $request->search;
            $query->where('transaction_code', 'like', "%{$search}%")
                  ->orWhereHas('customer', function($q) use ($search) {
                      $q->where('nama', 'like', "%{$search}%");
                  });
        }

        if ($request->has('status') && $request->status != '') {
            $query->where('status_laundry', $request->status);
        }

        $transactions = $query->paginate(10);
        return view('transactions.index', compact('transactions'));
    }

    public function create()
    {
        $customers = Customer::orderBy('nama')->get();
        $services = Service::where('status_aktif', true)->orderBy('nama_layanan')->get();
        return view('transactions.create', compact('customers', 'services'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'tanggal_masuk' => 'required|date',
            'estimasi_selesai' => 'required|date|after_or_equal:tanggal_masuk',
            'services' => 'required|array|min:1',
            'services.*.id' => 'required|exists:services,id',
            'services.*.quantity' => 'required|numeric|min:0.1',
            'discount' => 'nullable|integer|min:0',
            'extra_cost' => 'nullable|integer|min:0',
            'payment_status' => 'required|in:unpaid,paid',
            'payment_method' => 'nullable|required_if:payment_status,paid|string',
        ]);

        try {
            DB::beginTransaction();

            // FIX N+1 Query: Ambil semua service sekaligus di luar loop
            $serviceIds = collect($request->services)->pluck('id');
            $servicesDb = Service::whereIn('id', $serviceIds)->get()->keyBy('id');

            $subtotal = 0;
            $itemsData = [];

            foreach ($request->services as $serviceData) {
                $service = $servicesDb[$serviceData['id']];
                $qty = $serviceData['quantity'];
                $itemSubtotal = $service->harga * $qty;
                
                $subtotal += $itemSubtotal;
                
                $itemsData[] = [
                    'service_id' => $service->id,
                    'quantity' => $qty,
                    'harga' => $service->harga,
                    'subtotal' => $itemSubtotal,
                ];
            }

            $discount = $request->discount ?? 0;
            $extra_cost = $request->extra_cost ?? 0;
            $total = ($subtotal - $discount) + $extra_cost;

            $trxCode = 'TRX-' . Carbon::parse($request->tanggal_masuk)->format('Ymd') . '-' . strtoupper(Str::random(4));

            $transaction = Transaction::create([
                'transaction_code' => $trxCode,
                'customer_id' => $request->customer_id,
                'user_id' => auth()->id(),
                'tanggal_masuk' => $request->tanggal_masuk,
                'estimasi_selesai' => $request->estimasi_selesai,
                'status_laundry' => 'Menunggu',
                'subtotal' => $subtotal,
                'discount' => $discount,
                'extra_cost' => $extra_cost,
                'total' => $total,
                'notes' => $request->notes,
            ]);

            foreach ($itemsData as $item) {
                $transaction->items()->create($item);
            }

            if ($request->payment_status === 'paid') {
                Payment::create([
                    'transaction_id' => $transaction->id,
                    'amount' => $total,
                    'payment_method' => $request->payment_method ?? 'cash',
                ]);
            }

            DB::commit();
            return redirect()->route('transactions.show', $transaction->id)->with('success', 'Transaksi berhasil dibuat!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Terjadi kesalahan sistem: ' . $e->getMessage());
        }
    }

    public function show(Transaction $transaction)
    {
        $transaction->load(['customer', 'user', 'items.service', 'payments']);
        $totalDibayar = $transaction->payments->sum('amount');
        $sisaTagihan = $transaction->total - $totalDibayar;
        return view('transactions.show', compact('transaction', 'totalDibayar', 'sisaTagihan'));
    }

    public function updateStatus(Request $request, Transaction $transaction)
    {
        $request->validate(['status_laundry' => 'required|in:Menunggu,Diproses,Dicuci,Dikeringkan,Disetrika,Siap Diambil,Selesai,Dibatalkan']);
        $transaction->update(['status_laundry' => $request->status_laundry]);
        return back()->with('success', 'Status cucian berhasil diperbarui.');
    }

    public function addPayment(Request $request, Transaction $transaction)
    {
        $request->validate(['amount' => 'required|integer|min:1', 'payment_method' => 'required|string']);
        $totalDibayar = $transaction->payments->sum('amount');
        $sisaTagihan = $transaction->total - $totalDibayar;

        if ($request->amount > $sisaTagihan) {
            return back()->with('error', 'Nominal pembayaran melebihi sisa tagihan.');
        }

        Payment::create(['transaction_id' => $transaction->id, 'amount' => $request->amount, 'payment_method' => $request->payment_method]);
        return back()->with('success', 'Pembayaran berhasil ditambahkan.');
    }
}