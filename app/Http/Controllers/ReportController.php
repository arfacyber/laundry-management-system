<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Payment;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function monthlyReport(Request $request)
    {
        $month = $request->input('month', date('m'));
        $year = $request->input('year', date('Y'));

        // Ambil data transaksi pada bulan dan tahun tersebut
        $transactions = Transaction::with(['customer', 'payments'])
                        ->whereMonth('tanggal_masuk', $month)
                        ->whereYear('tanggal_masuk', $year)
                        ->get();

        $totalPendapatan = Payment::whereMonth('created_at', $month)
                                  ->whereYear('created_at', $year)
                                  ->sum('amount');

        $totalTransaksi = $transactions->count();

        return view('admin.reports.monthly', compact('transactions', 'totalPendapatan', 'totalTransaksi', 'month', 'year'));
    }
}