<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Transaction;
use App\Models\Payment;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function admin()
    {
        $today = Carbon::today();
        $thisMonth = Carbon::now()->month;
        $thisYear = Carbon::now()->year;

        // Statistik Card
        $totalCustomers = Customer::count();
        $todayTransactions = Transaction::whereDate('tanggal_masuk', $today)->count();
        $monthlyIncome = Payment::whereMonth('created_at', $thisMonth)
                                ->whereYear('created_at', $thisYear)
                                ->sum('amount');
        $processingCucian = Transaction::whereIn('status_laundry', ['Diproses', 'Dicuci', 'Dikeringkan', 'Disetrika'])->count();

        // Tabel Transaksi Terbaru (5 Data Terakhir)
        $latestTransactions = Transaction::with('customer')
                                ->latest()
                                ->take(5)
                                ->get();

        return view('admin.dashboard', compact(
            'totalCustomers', 'todayTransactions', 'monthlyIncome', 'processingCucian', 'latestTransactions'
        ));
    }

    public function staff()
    {
        // Untuk staff, kita tampilkan cucian yang "Siap Diambil" agar bisa langsung di-follow up
        $readyForPickup = Transaction::with('customer')
                                ->where('status_laundry', 'Siap Diambil')
                                ->latest()
                                ->get();

        return view('staff.dashboard', compact('readyForPickup'));
    }
}