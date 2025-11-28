@extends('layouts.admin')

@section('title', 'Edit Supplier')

@section('content')
<div class="max-w-2xl mx-auto">
    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Edit Supplier</h1>
        <p class="text-gray-600">Edit data supplier</p>
    </div>

    <!-- Form -->
    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('supplier.update', $item->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Nama Supplier -->
            <div class="mb-6">
                <label for="nama_supplier" class="block text-sm font-medium text-gray-700 mb-2">
                    Nama Supplier *
                </label>
                <input type="text" 
                       id="nama_supplier" 
                       name="nama_supplier" 
                       value="{{ old('nama_supplier', $item->nama_supplier) }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                       placeholder="Nama supplier"
                       required>
                @error('nama_supplier')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Kontak -->
            <div class="mb-6">
                <label for="kontak" class="block text-sm font-medium text-gray-700 mb-2">
                    Kontak
                </label>
                <input type="text" 
                       id="kontak" 
                       name="kontak" 
                       value="{{ old('kontak', $item->kontak) }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                       placeholder="Nomor telepon/HP">
                @error('kontak')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Alamat -->
            <div class="mb-6">
                <label for="alamat" class="block text-sm font-medium text-gray-700 mb-2">
                    Alamat
                </label>
                <textarea id="alamat" 
                          name="alamat" 
                          rows="3"
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                          placeholder="Alamat lengkap supplier">{{ old('alamat', $item->alamat) }}</textarea>
                @error('alamat')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Catatan -->
            <div class="mb-6">
                <label for="catatan" class="block text-sm font-medium text-gray-700 mb-2">
                    Catatan
                </label>
                <textarea id="catatan" 
                          name="catatan" 
                          rows="2"
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                          placeholder="Catatan tambahan">{{ old('catatan', $item->catatan) }}</textarea>
                @error('catatan')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-end space-x-4 mt-8 pt-6 border-t border-gray-200">
                <a href="{{ route('supplier.index') }}" 
                   class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                    Batal
                </a>
                <button type="submit" 
                        class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors flex items-center space-x-2">
                    <i class="fas fa-save"></i>
                    <span>Update Supplier</span>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection