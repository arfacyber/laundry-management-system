<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $query = Customer::query();

        // Fitur Pencarian berdasarkan Nama atau Nomor HP
        if ($request->has('search')) {
            $search = $request->search;
            $query->where('nama', 'like', "%{$search}%")
                  ->orWhere('nomor_hp', 'like', "%{$search}%");
        }

        // Urutkan dari yang terbaru dan batasi 10 per halaman
        $customers = $query->latest()->paginate(10);

        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nomor_hp' => 'required|string|max:20|unique:customers,nomor_hp',
            'alamat' => 'nullable|string',
        ], [
            'nomor_hp.unique' => 'Nomor HP ini sudah terdaftar di sistem.',
            'nama.required' => 'Nama pelanggan wajib diisi.',
            'nomor_hp.required' => 'Nomor HP wajib diisi.'
        ]);

        Customer::create($request->all());

        return redirect()->route('customers.index')->with('success', 'Pelanggan baru berhasil ditambahkan.');
    }

    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nomor_hp' => 'required|string|max:20|unique:customers,nomor_hp,' . $customer->id,
            'alamat' => 'nullable|string',
        ], [
            'nomor_hp.unique' => 'Nomor HP ini sudah dipakai oleh pelanggan lain.',
            'nama.required' => 'Nama pelanggan wajib diisi.',
            'nomor_hp.required' => 'Nomor HP wajib diisi.'
        ]);

        $customer->update($request->all());

        return redirect()->route('customers.index')->with('success', 'Data pelanggan berhasil diperbarui.');
    }

    public function destroy(Customer $customer)
    {
        // Mencegah penghapusan jika pelanggan sudah punya transaksi (menjaga integritas data historis)
        if ($customer->transactions()->count() > 0) {
            return redirect()->route('customers.index')->with('error', 'Gagal menghapus! Pelanggan ini memiliki riwayat transaksi.');
        }

        $customer->delete();

        return redirect()->route('customers.index')->with('success', 'Pelanggan berhasil dihapus.');
    }
}