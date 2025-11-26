<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    public function index() {
        $items = Kategori::all();
        return view('admin.kategori.index', compact('items'));
    }

    public function create() {
        return view('admin.kategori.create');
    }

    public function store(Request $request) {
        $request->validate(['nama_kategori'=>'required|unique:kategori,nama_kategori']);
        Kategori::create($request->all());
        return redirect()->route('kategori.index')->with('success','Kategori berhasil ditambahkan');
    }

    public function edit($id) {
        $item = Kategori::findOrFail($id);
        return view('admin.kategori.edit', compact('item'));
    }

    public function update(Request $request, $id) {
        $item = Kategori::findOrFail($id);
        $request->validate(['nama_kategori'=>'required|unique:kategori,nama_kategori,'.$id]);
        $item->update($request->all());
        return redirect()->route('kategori.index')->with('success','Kategori berhasil diupdate');
    }

    public function destroy($id) {
        $item = Kategori::findOrFail($id);
        $item->delete();
        return redirect()->route('kategori.index')->with('success','Kategori berhasil dihapus');
    }
}
