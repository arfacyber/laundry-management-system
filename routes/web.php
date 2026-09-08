<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TransactionController; 
use App\Http\Controllers\ReportController; // <-- Tambahan Controller Laporan
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TrackingController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    if (auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('staff.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ==========================================
// ROUTE KHUSUS ADMIN
// ==========================================
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'admin'])->name('dashboard');
    
    // Manajemen Layanan hanya untuk Admin
    Route::resource('services', ServiceController::class)->except(['show']);

    // Laporan Bulanan hanya untuk Admin
    Route::get('/reports/monthly', [ReportController::class, 'monthlyReport'])->name('reports.monthly');
});

// ==========================================
// ROUTE KHUSUS STAFF
// ==========================================
Route::middleware(['auth', 'role:staff'])->prefix('staff')->name('staff.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'staff'])->name('dashboard');
});

// ==========================================
// ROUTE UMUM (Bisa diakses Admin & Staff)
// ==========================================
Route::middleware('auth')->group(function () {
    Route::resource('customers', CustomerController::class);
    
    // Transaksi Route
    Route::resource('transactions', TransactionController::class)->except(['edit', 'update', 'destroy']);
    Route::patch('transactions/{transaction}/status', [TransactionController::class, 'updateStatus'])->name('transactions.status.update');
    Route::post('transactions/{transaction}/payment', [TransactionController::class, 'addPayment'])->name('transactions.payment.store');
    
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route Tracking Publik dengan Rate Limiting anti-spam (10 request / 1 menit)
Route::middleware('throttle:10,1')->group(function () {
    Route::get('/track', [TrackingController::class, 'index'])->name('tracking.index');
    Route::get('/track/search', [TrackingController::class, 'search'])->name('tracking.search');
});

require __DIR__.'/auth.php';