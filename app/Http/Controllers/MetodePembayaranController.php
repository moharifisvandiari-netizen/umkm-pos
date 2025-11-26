<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MetodePembayaran;

class MetodePembayaranController extends Controller
{
    public function index() {
        $items = MetodePembayaran::all();
        return view('admin.metode-pembayaran.index', compact('items'));
    }

    public function create() {
        return view('admin.metode-pembayaran.create');
    }

    public function store(Request $request) {
        $request->validate(['nama_metode'=>'required|unique:metode_pembayaran,nama_metode']);
        MetodePembayaran::create($request->all());
        return redirect()->route('metode-pembayaran.index')->with('success','Metode pembayaran berhasil ditambahkan');
    }

    public function edit($id) {
        $item = MetodePembayaran::findOrFail($id);
        return view('admin.metode-pembayaran.edit', compact('item'));
    }

    public function update(Request $request, $id) {
        $item = MetodePembayaran::findOrFail($id);
        $request->validate(['nama_metode'=>'required|unique:metode_pembayaran,nama_metode,'.$id]);
        $item->update($request->all());
        return redirect()->route('metode-pembayaran.index')->with('success','Metode pembayaran berhasil diupdate');
    }

    public function destroy($id) {
        $item = MetodePembayaran::findOrFail($id);
        $item->delete();
        return redirect()->route('metode-pembayaran.index')->with('success','Metode pembayaran berhasil dihapus');
    }
}
