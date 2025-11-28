@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-6">
    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Produk -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                    <i class="fas fa-box text-2xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-sm font-medium text-gray-500">Total Produk</h3>
                    <p class="text-2xl font-bold text-gray-900">{{ \App\Models\Produk::count() }}</p>
                </div>
            </div>
        </div>

        <!-- Total Stok -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-600">
                    <i class="fas fa-layer-group text-2xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-sm font-medium text-gray-500">Total Stok</h3>
                    <p class="text-2xl font-bold text-gray-900">{{ \App\Models\Produk::sum('stok') }}</p>
                </div>
            </div>
        </div>

        <!-- Penjualan Hari Ini -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                    <i class="fas fa-shopping-cart text-2xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-sm font-medium text-gray-500">Penjualan Hari Ini</h3>
                    <p class="text-2xl font-bold text-gray-900">Rp {{ number_format(\App\Models\TransaksiPenjualan::whereDate('created_at', today())->sum('total'), 0, ',', '.') }}</p>
                </div>
            </div>
        </div>

        <!-- Total Supplier -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                    <i class="fas fa-truck text-2xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-sm font-medium text-gray-500">Total Supplier</h3>
                    <p class="text-2xl font-bold text-gray-900">{{ \App\Models\Supplier::count() }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Quick Penjualan -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Quick Actions</h3>
            <div class="space-y-4">
                <a href="{{ route('penjualan.create') }}" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 px-4 rounded-lg flex items-center justify-center space-x-2 transition-colors">
                    <i class="fas fa-cash-register"></i>
                    <span>Transaksi Penjualan Baru</span>
                </a>
                <a href="{{ route('pembelian.create') }}" class="w-full bg-green-600 hover:bg-green-700 text-white py-3 px-4 rounded-lg flex items-center justify-center space-x-2 transition-colors">
                    <i class="fas fa-shopping-cart"></i>
                    <span>Transaksi Pembelian Baru</span>
                </a>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Aktivitas Terbaru</h3>
            <div class="space-y-3">
                @php
                    $recentSales = \App\Models\TransaksiPenjualan::with('user')->latest()->take(3)->get();
                @endphp
                @foreach($recentSales as $sale)
                <div class="flex items-center space-x-3 text-sm">
                    <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                    <span class="text-gray-600">Transaksi penjualan #{{ $sale->id }}</span>
                    <span class="text-gray-400">{{ $sale->created_at->diffForHumans() }}</span>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection