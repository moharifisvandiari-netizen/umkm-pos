@extends('layouts.admin')

@section('title', 'Edit Kategori')

@section('content')
<div class="max-w-2xl mx-auto">
    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Edit Kategori</h1>
        <p class="text-gray-600">Edit data kategori</p>
    </div>

    <!-- Form -->
    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('kategori.update', $item->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Nama Kategori -->
            <div class="mb-6">
                <label for="nama_kategori" class="block text-sm font-medium text-gray-700 mb-2">
                    Nama Kategori *
                </label>
                <input type="text" 
                       id="nama_kategori" 
                       name="nama_kategori" 
                       value="{{ old('nama_kategori', $item->nama_kategori) }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                       placeholder="Nama kategori"
                       required>
                @error('nama_kategori')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-end space-x-4 mt-8 pt-6 border-t border-gray-200">
                <a href="{{ route('kategori.index') }}" 
                   class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                    Batal
                </a>
                <button type="submit" 
                        class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors flex items-center space-x-2">
                    <i class="fas fa-save"></i>
                    <span>Update Kategori</span>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection