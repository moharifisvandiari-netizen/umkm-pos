@extends('layouts.admin')

@section('content')
<h1 class="text-2xl font-bold mb-4">Dashboard Admin</h1>

<div class="grid grid-cols-3 gap-4">
    <div class="bg-white p-4 rounded shadow">Total Produk: {{ \App\Models\Produk::count() }}</div>
    <div class="bg-white p-4 rounded shadow">Total Supplier: {{ \App\Models\Supplier::count() }}</div>
    <div class="bg-white p-4 rounded shadow">Total Penjualan: {{ \App\Models\TransaksiPenjualan::count() }}</div>
</div>
@endsection
