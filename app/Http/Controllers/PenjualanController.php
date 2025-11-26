<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransaksiPenjualan;
use App\Models\DetailPenjualan;
use App\Models\Produk;
use App\Models\MetodePembayaran;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PenjualanController extends Controller
{
    // Tampilkan daftar transaksi
    public function index() {
        $penjualan = TransaksiPenjualan::with('user','metode_pembayaran','details.produk')->get();
        return view('admin.penjualan.index', compact('penjualan'));
    }

    // Tampilkan form buat transaksi baru
    public function create() {
        $produks = Produk::where('status','aktif')->where('stok','>',0)->get();
        $metode = MetodePembayaran::all();
        return view('admin.penjualan.create', compact('produks','metode'));
    }

    // Simpan transaksi
    public function store(Request $request) {
        $request->validate([
            'items' => 'required|array',
            'items.*.produk_id' => 'required|exists:produk,id',
            'items.*.jumlah' => 'required|integer|min:1',
            'metode_pembayaran_id'=>'required|exists:metode_pembayaran,id'
        ]);

        DB::beginTransaction();

        try {
            // Buat header transaksi
            $transaksi = TransaksiPenjualan::create([
                'user_id' => Auth::id(), // ✅ properti ID pakai helper, Intelephense senang
                'metode_pembayaran_id' => $request->metode_pembayaran_id,
                'total' => 0
            ]);

            $totalTransaksi = 0;

            foreach($request->items as $item){
                $produk = Produk::lockForUpdate()->find($item['produk_id']);

                if(!$produk){
                    throw new \Exception("Produk ID {$item['produk_id']} tidak ditemukan");
                }

                if($produk->stok < $item['jumlah']){
                    throw new \Exception("Stok {$produk->nama_produk} tidak mencukupi");
                }

                $subtotal = $produk->harga_jual * $item['jumlah'];
                $totalTransaksi += $subtotal;

                DetailPenjualan::create([
                    'transaksi_penjualan_id' => $transaksi->id, // ✅ akses properti, bukan method
                    'produk_id' => $produk->id,
                    'jumlah' => $item['jumlah'],
                    'harga_jual' => $produk->harga_jual,
                    'subtotal' => $subtotal
                ]);

                // Kurangi stok
                $produk->decrement('stok', $item['jumlah']);
            }

            // Update total transaksi
            $transaksi->update(['total' => $totalTransaksi]);

            DB::commit();

            return redirect()->route('penjualan.index')->with('success','Penjualan berhasil disimpan');

        } catch (\Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: '.$e->getMessage());
        }
    }
}
