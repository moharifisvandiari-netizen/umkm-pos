@extends('layouts.admin')

@section('title', 'Edit Satuan')

@section('content')
<div class="max-w-2xl mx-auto">
    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Edit Satuan</h1>
        <p class="text-gray-600">Edit data satuan</p>
    </div>

    <!-- Form -->
    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('satuan.update', $item->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Nama Satuan -->
            <div class="mb-6">
                <label for="nama_satuan" class="block text-sm font-medium text-gray-700 mb-2">
                    Nama Satuan *
                </label>
                <input type="text" 
                       id="nama_satuan" 
                       name="nama_satuan" 
                       value="{{ old('nama_satuan', $item->nama_satuan) }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                       placeholder="Contoh: pcs, kg, liter, etc"
                       required>
                @error('nama_satuan')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-end space-x-4 mt-8 pt-6 border-t border-gray-200">
                <a href="{{ route('satuan.index') }}" 
                   class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                    Batal
                </a>
                <button type="submit" 
                        class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors flex items-center space-x-2">
                    <i class="fas fa-save"></i>
                    <span>Update Satuan</span>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection