<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Kategori;
use App\Models\Satuan;

class ProdukController extends Controller
{
    public function index() {
        $produks = Produk::with(['kategori','satuan'])->get();
        return view('admin.produk.index', compact('produks'));
    }

    public function create() {
        $kategoris = Kategori::all();
        $satuans = Satuan::all();
        return view('admin.produk.create', compact('kategoris','satuans'));
    }

    public function store(Request $request) {
        $request->validate([
            'kode_barang'=>'required|unique:produk,kode_barang',
            'nama_produk'=>'required',
            'kategori_id'=>'required',
            'satuan_id'=>'required',
            'harga_modal'=>'required|numeric',
            'harga_jual'=>'required|numeric',
            'stok'=>'required|integer'
        ]);

        Produk::create($request->all());
        return redirect()->route('produk.index')->with('success','Produk berhasil ditambahkan');
    }

    public function edit($id) {
        $produk = Produk::findOrFail($id);
        $kategoris = Kategori::all();
        $satuans = Satuan::all();
        return view('admin.produk.edit', compact('produk','kategoris','satuans'));
    }

    public function update(Request $request, $id) {
        $produk = Produk::findOrFail($id);
        $request->validate([
            'kode_barang'=>'required|unique:produk,kode_barang,'.$id,
            'nama_produk'=>'required',
            'kategori_id'=>'required',
            'satuan_id'=>'required',
            'harga_modal'=>'required|numeric',
            'harga_jual'=>'required|numeric',
            'stok'=>'required|integer'
        ]);
        $produk->update($request->all());
        return redirect()->route('produk.index')->with('success','Produk berhasil diupdate');
    }

    public function destroy($id) {
        $produk = Produk::findOrFail($id);
        $produk->delete();
        return redirect()->route('produk.index')->with('success','Produk berhasil dihapus');
    }
}
