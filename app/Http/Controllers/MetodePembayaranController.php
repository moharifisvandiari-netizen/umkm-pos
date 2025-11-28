<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MetodePembayaran;
use App\Models\TransaksiPenjualan;

class MetodePembayaranController extends Controller
{
    public function index()
    {
        $items = MetodePembayaran::latest()->get();
        return view('admin.metode-pembayaran.index', compact('items'));
    }

    public function create()
    {
        return view('admin.metode-pembayaran.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_metode' => 'required|string|max:255|unique:metode_pembayarans,nama_metode',
            'keterangan' => 'nullable|string|max:500',
            'status' => 'required|in:active,inactive'
        ]);

        MetodePembayaran::create([
            'nama_metode' => $request->nama_metode,
            'keterangan' => $request->keterangan,
            'status' => $request->status
        ]);

        return redirect()->route('metode-pembayaran.index')
            ->with('success', 'Metode pembayaran berhasil ditambahkan');
    }

    public function edit($id)
    {
        $item = MetodePembayaran::findOrFail($id);
        return view('admin.metode-pembayaran.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = MetodePembayaran::findOrFail($id);
        
        $request->validate([
            'nama_metode' => 'required|string|max:255|unique:metode_pembayarans,nama_metode,' . $id,
            'keterangan' => 'nullable|string|max:500',
            'status' => 'required|in:active,inactive'
        ]);

        $item->update([
            'nama_metode' => $request->nama_metode,
            'keterangan' => $request->keterangan,
            'status' => $request->status
        ]);

        return redirect()->route('metode-pembayaran.index')
            ->with('success', 'Metode pembayaran berhasil diupdate');
    }

    public function destroy($id)
    {
        $item = MetodePembayaran::findOrFail($id);

        // Cek apakah metode pembayaran digunakan di transaksi penjualan
        if (TransaksiPenjualan::where('metode_pembayaran_id', $id)->exists()) {
            return redirect()->route('metode-pembayaran.index')
                ->with('error', 'Metode pembayaran tidak dapat dihapus karena masih digunakan dalam transaksi');
        }

        $item->delete();

        return redirect()->route('metode-pembayaran.index')
            ->with('success', 'Metode pembayaran berhasil dihapus');
    }

    // Duplicate method
    public function duplicate($id)
    {
        $original = MetodePembayaran::findOrFail($id);
        
        $newMethod = $original->replicate();
        $newMethod->nama_metode = $original->nama_metode . ' (Copy)';
        $newMethod->save();

        return redirect()->route('metode-pembayaran.index')
            ->with('success', 'Metode pembayaran berhasil diduplikasi');
    }

    // Toggle status method
    public function toggleStatus($id)
    {
        $item = MetodePembayaran::findOrFail($id);
        $item->status = $item->status == 'active' ? 'inactive' : 'active';
        $item->save();

        $status = $item->status == 'active' ? 'diaktifkan' : 'dinonaktifkan';
        return redirect()->route('metode-pembayaran.index')
            ->with('success', "Metode pembayaran berhasil $status");
    }
}