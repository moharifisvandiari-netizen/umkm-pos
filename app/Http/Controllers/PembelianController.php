<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransaksiPembelian;
use App\Models\DetailPembelian;
use App\Models\Produk;
use App\Models\Supplier;

class PembelianController extends Controller
{
    public function index() {
        $pembelian = TransaksiPembelian::with('supplier','details.produk')->get();
        return view('admin.pembelian.index', compact('pembelian'));
    }

    public function create() {
        $suppliers = Supplier::all();
        $produks = Produk::where('status','aktif')->get();
        return view('admin.pembelian.create', compact('suppliers','produks'));
    }

    public function store(Request $request) {
        $request->validate([
            'supplier_id'=>'required',
            'produk_id'=>'required|array',
            'jumlah'=>'required|array',
            'harga_modal'=>'required|array'
        ]);

        $total = 0;
        foreach($request->jumlah as $key=>$val){
            $total += $val * $request->harga_modal[$key];
        }

        $transaksi = TransaksiPembelian::create([
            'supplier_id'=>$request->supplier_id,
            'total'=>$total
        ]);

        foreach($request->produk_id as $key=>$prod_id){
            $subtotal = $request->jumlah[$key] * $request->harga_modal[$key];
            DetailPembelian::create([
                'transaksi_pembelian_id'=>$transaksi->id,
                'produk_id'=>$prod_id,
                'jumlah'=>$request->jumlah[$key],
                'harga_modal'=>$request->harga_modal[$key],
                'subtotal'=>$subtotal
            ]);

            $produk = Produk::find($prod_id);
            $produk->stok += $request->jumlah[$key];
            $produk->save();
        }

        return redirect()->route('pembelian.index')->with('success','Pembelian berhasil disimpan');
    }
}
