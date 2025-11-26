<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Satuan;

class SatuanController extends Controller
{
    public function index() {
        $items = Satuan::all();
        return view('admin.satuan.index', compact('items'));
    }

    public function create() {
        return view('admin.satuan.create');
    }

    public function store(Request $request) {
        $request->validate(['nama_satuan'=>'required|unique:satuan,nama_satuan']);
        Satuan::create($request->all());
        return redirect()->route('satuan.index')->with('success','Satuan berhasil ditambahkan');
    }

    public function edit($id) {
        $item = Satuan::findOrFail($id);
        return view('admin.satuan.edit', compact('item'));
    }

    public function update(Request $request, $id) {
        $item = Satuan::findOrFail($id);
        $request->validate(['nama_satuan'=>'required|unique:satuan,nama_satuan,'.$id]);
        $item->update($request->all());
        return redirect()->route('satuan.index')->with('success','Satuan berhasil diupdate');
    }

    public function destroy($id) {
        $item = Satuan::findOrFail($id);
        $item->delete();
        return redirect()->route('satuan.index')->with('success','Satuan berhasil dihapus');
    }
}
