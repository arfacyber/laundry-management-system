<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TrackingController extends Controller
{
    public function index()
    {
        return view('tracking.index');
    }

    public function search(Request $request)
    {
        $request->validate([
            'transaction_code' => 'required|string'
        ]);

        $transaction = Transaction::with('customer')->where('transaction_code', $request->transaction_code)->first();

        // Data Masking untuk Privasi (Menyamarkan Nama)
        if ($transaction) {
            $nameLength = strlen($transaction->customer->nama);
            $maskedName = substr($transaction->customer->nama, 0, 2) . str_repeat('*', max($nameLength - 2, 3));
            $transaction->masked_name = $maskedName;
        }

        return view('tracking.index', compact('transaction'));
    }
}