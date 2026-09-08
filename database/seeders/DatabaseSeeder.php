<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Service;
use App\Models\Customer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat Akun Admin
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@laundry.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        // 2. Buat Akun Staff
        User::create([
            'name' => 'Staff Operasional',
            'email' => 'staff@laundry.com',
            'password' => Hash::make('password123'),
            'role' => 'staff',
        ]);

        // 3. Buat Master Layanan (Services)
        Service::create([
            'nama_layanan' => 'Cuci Kering Setrika',
            'harga' => 7000,
            'unit' => 'kg',
            'status_aktif' => true,
        ]);

        Service::create([
            'nama_layanan' => 'Cuci Kering Lipat',
            'harga' => 5000,
            'unit' => 'kg',
            'status_aktif' => true,
        ]);

        Service::create([
            'nama_layanan' => 'Setrika Saja',
            'harga' => 4000,
            'unit' => 'kg',
            'status_aktif' => true,
        ]);

        Service::create([
            'nama_layanan' => 'Cuci Sepatu Sneaker',
            'harga' => 25000,
            'unit' => 'pasang',
            'status_aktif' => true,
        ]);

        Service::create([
            'nama_layanan' => 'Cuci Selimut / Bedcover',
            'harga' => 35000,
            'unit' => 'pcs',
            'status_aktif' => true,
        ]);

        // 4. Buat Data Customer Dummy
        Customer::create([
            'nama' => 'Budi Santoso',
            'nomor_hp' => '081234567890',
            'alamat' => 'Jl. Merdeka No. 45',
        ]);

        Customer::create([
            'nama' => 'Siti Aminah',
            'nomor_hp' => '089876543210',
            'alamat' => 'Perumahan Indah Blok C2',
        ]);
    }
}