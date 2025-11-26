@extends('layouts.admin')

@section('content')
<h1 class="text-2xl font-bold mb-4">Daftar Produk</h1>

<a href="{{ route('produk.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Tambah Produk</a>

<table class="table-auto w-full bg-white rounded shadow">
    <thead>
        <tr class="bg-gray-200">
            <th class="px-4 py-2">Kode</th>
            <th class="px-4 py-2">Nama</th>
            <th class="px-4 py-2">Kategori</th>
            <th class="px-4 py-2">Satuan</th>
            <th class="px-4 py-2">Harga Jual</th>
            <th class="px-4 py-2">Stok</th>
            <th class="px-4 py-2">Aksi</th>
        </tr>
    </thead>
<tbody>
    @foreach($produks as $produk)
    <tr>
        <td class="border px-4 py-2">{{ $produk->kode_barang }}</td>
        <td class="border px-4 py-2">{{ $produk->nama_produk }}</td>
        <td class="border px-4 py-2">{{ $produk->kategori->nama_kategori ?? '-' }}</td>
        <td class="border px-4 py-2">{{ $produk->satuan->nama_satuan ?? '-' }}</td>
        <td class="border px-4 py-2">{{ number_format($produk->harga_jual,0) }}</td>
        <td class="border px-4 py-2">{{ $produk->stok }}</td>
        <td class="border px-4 py-2">
            <a href="{{ route('produk.edit', $produk->id) }}" class="text-blue-500">Edit</a> |
            <form action="{{ route('produk.destroy', $produk->id) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-500">Hapus</button>
            </form>
        </td>
    </tr>
    @endforeach
</tbody>

</table>
@endsection
