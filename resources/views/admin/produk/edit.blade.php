@extends('layouts.admin')

@section('title', 'Edit Produk')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Edit Produk</h1>
        <p class="text-gray-600">Edit data produk</p>
    </div>

    <!-- Form -->
    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('produk.update', $produk->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Kode Barang -->
                <div>
                    <label for="kode_barang" class="block text-sm font-medium text-gray-700 mb-2">
                        Kode Barang *
                    </label>
                    <input type="text" 
                           id="kode_barang" 
                           name="kode_barang" 
                           value="{{ old('kode_barang', $produk->kode_barang) }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                           placeholder="PRD001"
                           required>
                    @error('kode_barang')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Nama Produk -->
                <div>
                    <label for="nama_produk" class="block text-sm font-medium text-gray-700 mb-2">
                        Nama Produk *
                    </label>
                    <input type="text" 
                           id="nama_produk" 
                           name="nama_produk" 
                           value="{{ old('nama_produk', $produk->nama_produk) }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                           placeholder="Nama produk"
                           required>
                    @error('nama_produk')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Kategori -->
                <div>
                    <label for="kategori_id" class="block text-sm font-medium text-gray-700 mb-2">
                        Kategori *
                    </label>
                    <select id="kategori_id" 
                            name="kategori_id"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                            required>
                        <option value="">Pilih Kategori</option>
                        @foreach($kategoris as $kategori)
                            <option value="{{ $kategori->id }}" {{ old('kategori_id', $produk->kategori_id) == $kategori->id ? 'selected' : '' }}>
                                {{ $kategori->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                    @error('kategori_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Satuan -->
                <div>
                    <label for="satuan_id" class="block text-sm font-medium text-gray-700 mb-2">
                        Satuan *
                    </label>
                    <select id="satuan_id" 
                            name="satuan_id"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                            required>
                        <option value="">Pilih Satuan</option>
                        @foreach($satuans as $satuan)
                            <option value="{{ $satuan->id }}" {{ old('satuan_id', $produk->satuan_id) == $satuan->id ? 'selected' : '' }}>
                                {{ $satuan->nama_satuan }}
                            </option>
                        @endforeach
                    </select>
                    @error('satuan_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Harga Modal -->
                <div>
                    <label for="harga_modal" class="block text-sm font-medium text-gray-700 mb-2">
                        Harga Modal *
                    </label>
                    <input type="number" 
                           id="harga_modal" 
                           name="harga_modal" 
                           value="{{ old('harga_modal', $produk->harga_modal) }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                           placeholder="0"
                           min="0"
                           required>
                    @error('harga_modal')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Harga Jual -->
                <div>
                    <label for="harga_jual" class="block text-sm font-medium text-gray-700 mb-2">
                        Harga Jual *
                    </label>
                    <input type="number" 
                           id="harga_jual" 
                           name="harga_jual" 
                           value="{{ old('harga_jual', $produk->harga_jual) }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                           placeholder="0"
                           min="0"
                           required>
                    @error('harga_jual')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Stok -->
                <div>
                    <label for="stok" class="block text-sm font-medium text-gray-700 mb-2">
                        Stok *
                    </label>
                    <input type="number" 
                           id="stok" 
                           name="stok" 
                           value="{{ old('stok', $produk->stok) }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                           placeholder="0"
                           min="0"
                           required>
                    @error('stok')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status -->
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                        Status
                    </label>
                    <select id="status" 
                            name="status"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                        <option value="aktif" {{ old('status', $produk->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="nonaktif" {{ old('status', $produk->status) == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                    @error('status')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Deskripsi -->
            <div class="mt-6">
                <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">
                    Deskripsi
                </label>
                <textarea id="deskripsi" 
                          name="deskripsi" 
                          rows="3"
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                          placeholder="Deskripsi produk (opsional)">{{ old('deskripsi', $produk->deskripsi) }}</textarea>
                @error('deskripsi')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-end space-x-4 mt-8 pt-6 border-t border-gray-200">
                <a href="{{ route('produk.index') }}" 
                   class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                    Batal
                </a>
                <button type="submit" 
                        class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors flex items-center space-x-2">
                    <i class="fas fa-save"></i>
                    <span>Update Produk</span>
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Auto calculate profit margin
    document.addEventListener('DOMContentLoaded', function() {
        const hargaModal = document.getElementById('harga_modal');
        const hargaJual = document.getElementById('harga_jual');

        function calculateProfit() {
            const modal = parseInt(hargaModal.value) || 0;
            const jual = parseInt(hargaJual.value) || 0;
            
            if (modal > 0 && jual > 0) {
                const profit = jual - modal;
                const margin = ((profit / modal) * 100).toFixed(2);
                
                // You can display this information if needed
                console.log(`Profit: Rp ${profit.toLocaleString()}, Margin: ${margin}%`);
            }
        }

        hargaModal.addEventListener('input', calculateProfit);
        hargaJual.addEventListener('input', calculateProfit);
        
        // Calculate initial profit
        calculateProfit();
    });
</script>
@endsection