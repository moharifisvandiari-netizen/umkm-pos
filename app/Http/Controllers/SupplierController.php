<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;

class SupplierController extends Controller
{
    public function index() {
        $items = Supplier::all();
        return view('admin.supplier.index', compact('items'));
    }

    public function create() {
        return view('admin.supplier.create');
    }

    public function store(Request $request) {
        $request->validate([
            'nama_supplier'=>'required|unique:supplier,nama_supplier',
            'kontak'=>'nullable',
            'alamat'=>'nullable',
            'catatan'=>'nullable'
        ]);
        Supplier::create($request->all());
        return redirect()->route('supplier.index')->with('success','Supplier berhasil ditambahkan');
    }

    public function edit($id) {
        $item = Supplier::findOrFail($id);
        return view('admin.supplier.edit', compact('item'));
    }

    public function update(Request $request, $id) {
        $item = Supplier::findOrFail($id);
        $request->validate([
            'nama_supplier'=>'required|unique:supplier,nama_supplier,'.$id,
            'kontak'=>'nullable',
            'alamat'=>'nullable',
            'catatan'=>'nullable'
        ]);
        $item->update($request->all());
        return redirect()->route('supplier.index')->with('success','Supplier berhasil diupdate');
    }

    public function destroy($id) {
        $item = Supplier::findOrFail($id);
        $item->delete();
        return redirect()->route('supplier.index')->with('success','Supplier berhasil dihapus');
    }
}
