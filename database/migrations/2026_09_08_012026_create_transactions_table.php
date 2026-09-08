<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_code')->unique();
            $table->foreignId('customer_id')->constrained('customers')->restrictOnDelete();
            $table->foreignId('user_id')->constrained('users')->restrictOnDelete();
            $table->date('tanggal_masuk');
            $table->date('estimasi_selesai');
            $table->enum('status_laundry', [
                'Menunggu', 'Diproses', 'Dicuci', 'Dikeringkan', 'Disetrika', 'Siap Diambil', 'Selesai', 'Dibatalkan'
            ])->default('Menunggu');
            $table->integer('subtotal')->default(0);
            $table->integer('discount')->default(0);
            $table->integer('extra_cost')->default(0);
            $table->integer('total')->default(0);
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};