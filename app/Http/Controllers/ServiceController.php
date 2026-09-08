<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $query = Service::query();

        if ($request->has('search')) {
            $query->where('nama_layanan', 'like', "%{$request->search}%");
        }

        $services = $query->latest()->paginate(10);

        return view('services.index', compact('services'));
    }

    public function create()
    {
        return view('services.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_layanan' => 'required|string|max:255',
            'harga' => 'required|integer|min:0',
            'unit' => 'required|string|max:50',
            'status_aktif' => 'required|boolean',
        ], [
            'harga.min' => 'Harga tidak boleh kurang dari 0.',
        ]);

        Service::create($request->all());

        return redirect()->route('services.index')->with('success', 'Layanan baru berhasil ditambahkan.');
    }

    public function edit(Service $service)
    {
        return view('services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $request->validate([
            'nama_layanan' => 'required|string|max:255',
            'harga' => 'required|integer|min:0',
            'unit' => 'required|string|max:50',
            'status_aktif' => 'required|boolean',
        ], [
            'harga.min' => 'Harga tidak boleh kurang dari 0.',
        ]);

        $service->update($request->all());

        return redirect()->route('services.index')->with('success', 'Data layanan berhasil diperbarui.');
    }

    public function destroy(Service $service)
    {
        try {
            $service->delete();
            return redirect()->route('services.index')->with('success', 'Layanan berhasil dihapus.');
        } catch (QueryException $e) {
            // Error 1451 menandakan ada Foreign Key constraint fails (data sudah dipakai di transaksi)
            if ($e->getCode() == "23000") {
                return redirect()->route('services.index')->with('error', 'Gagal! Layanan tidak dapat dihapus karena sudah memiliki riwayat transaksi. Solusi: Ubah status menjadi Nonaktif.');
            }
            return redirect()->route('services.index')->with('error', 'Terjadi kesalahan saat menghapus data.');
        }
    }
}