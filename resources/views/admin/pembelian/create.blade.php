@extends('layouts.admin')

@section('title', 'Tambah Pembelian')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Tambah Pembelian</h1>
            <p class="text-gray-600">Tambah transaksi pembelian stok baru</p>
        </div>
        <a href="{{ route('pembelian.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white py-2 px-4 rounded-lg flex items-center space-x-2 transition-colors">
            <i class="fas fa-arrow-left"></i>
            <span>Kembali</span>
        </a>
    </div>

    <!-- Form -->
    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('pembelian.store') }}" method="POST" id="pembelianForm">
            @csrf

            <!-- Supplier -->
            <div class="mb-6">
                <label for="supplier_id" class="block text-sm font-medium text-gray-700 mb-2">
                    Supplier *
                </label>
                <select id="supplier_id" 
                        name="supplier_id"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                        required>
                    <option value="">Pilih Supplier</option>
                    @foreach($suppliers as $supplier)
                        <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>
                            {{ $supplier->nama_supplier }}
                        </option>
                    @endforeach
                </select>
                @error('supplier_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Products Section -->
            <div class="mb-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-800">Daftar Produk</h3>
                    <button type="button" 
                            onclick="addProductRow()"
                            class="bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded-lg flex items-center space-x-2 transition-colors">
                        <i class="fas fa-plus"></i>
                        <span>Tambah Produk</span>
                    </button>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full" id="productsTable">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Produk</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jumlah</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Harga Modal</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Subtotal</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="productsBody">
                            <!-- Rows will be added here dynamically -->
                        </tbody>
                        <tfoot class="bg-gray-50">
                            <tr>
                                <td colspan="3" class="px-4 py-3 text-right font-semibold text-gray-900">Total Pembelian:</td>
                                <td class="px-4 py-3 font-semibold text-gray-900">
                                    Rp <span id="totalAmount">0</span>
                                </td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-end space-x-4 mt-8 pt-6 border-t border-gray-200">
                <a href="{{ route('pembelian.index') }}" 
                   class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                    Batal
                </a>
                <button type="submit" 
                        class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors flex items-center space-x-2">
                    <i class="fas fa-save"></i>
                    <span>Simpan Pembelian</span>
                </button>
            </div>
        </form>
    </div>
</div>

<script>
let productCount = 0;

    @foreach($produks as $produk),
    {
        id: {{ $produk->id }},
        nama_produk: "{{ $produk->nama_produk }}",
        harga_modal: {{ $produk->harga_modal }},
        stok: {{ $produk->stok }}
    },
    @endforeach
];

function addProductRow(productId = '', jumlah = 1, hargaModal = 0) {
    productCount++;
    const row = document.createElement('tr');
    row.id = `productRow${productCount}`;
    row.className = 'border-b border-gray-200';
    
    // Build options HTML
    let optionsHtml = '<option value="">Pilih Produk</option>';
    produkList.forEach(produk => {
        const selected = productId == produk.id ? 'selected' : '';
        optionsHtml += `<option value="${produk.id}" data-harga="${produk.harga_modal}" ${selected}>
            ${produk.nama_produk} (Stok: ${produk.stok})
        </option>`;
    });
    
    row.innerHTML = `
        <td class="px-4 py-3">
            <select name="produk_id[]" 
                    class="w-full px-3 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500 product-select"
                    onchange="updateHargaModal(this, ${productCount})"
                    required>
                ${optionsHtml}
            </select>
        </td>
        <td class="px-4 py-3">
            <input type="number" 
                   name="jumlah[]" 
                   value="${jumlah}"
                   min="1"
                   class="w-20 px-3 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500 quantity"
                   onchange="calculateSubtotal(${productCount})"
                   required>
        </td>
        <td class="px-4 py-3">
            <input type="number" 
                   name="harga_modal[]" 
                   value="${hargaModal}"
                   min="0"
                   class="w-32 px-3 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500 price"
                   onchange="calculateSubtotal(${productCount})"
                   required>
        </td>
        <td class="px-4 py-3">
            <span class="subtotal font-medium" id="subtotal${productCount}">0</span>
        </td>
        <td class="px-4 py-3">
            <button type="button" 
                    onclick="removeProductRow(${productCount})"
                    class="text-red-600 hover:text-red-900 transition-colors p-2 rounded hover:bg-red-50">
                <i class="fas fa-trash"></i>
            </button>
        </td>
    `;
    document.getElementById('productsBody').appendChild(row);
    
    if (productId) {
        updateHargaModal(row.querySelector('.product-select'), productCount);
    }
    calculateTotal();
}

function updateHargaModal(select, rowId) {
    const selectedOption = select.options[select.selectedIndex];
    const hargaModal = selectedOption.getAttribute('data-harga');
    if (hargaModal) {
        const priceInput = document.querySelector(`#productRow${rowId} .price`);
        priceInput.value = hargaModal;
        calculateSubtotal(rowId);
    }
}

function calculateSubtotal(rowId) {
    const quantity = document.querySelector(`#productRow${rowId} .quantity`).value;
    const price = document.querySelector(`#productRow${rowId} .price`).value;
    const subtotal = quantity * price;
    document.getElementById(`subtotal${rowId}`).textContent = subtotal.toLocaleString();
    calculateTotal();
}

function calculateTotal() {
    let total = 0;
    document.querySelectorAll('.subtotal').forEach(subtotal => {
        total += parseInt(subtotal.textContent.replace(/,/g, '')) || 0;
    });
    document.getElementById('totalAmount').textContent = total.toLocaleString();
}

function removeProductRow(rowId) {
    if (document.querySelectorAll('#productsBody tr').length > 1) {
        document.getElementById(`productRow${rowId}`).remove();
        calculateTotal();
    } else {
        alert('Minimal harus ada satu produk dalam pembelian');
    }
}

// Form validation
document.getElementById('pembelianForm').addEventListener('submit', function(e) {
    const productRows = document.querySelectorAll('#productsBody tr');
    if (productRows.length === 0) {
        e.preventDefault();
        alert('Tambahkan minimal satu produk ke pembelian');
        return;
    }

    // Validate each product row
    let isValid = true;
    document.querySelectorAll('.product-select').forEach(select => {
        if (!select.value) {
            isValid = false;
            select.classList.add('border-red-500');
        } else {
            select.classList.remove('border-red-500');
        }
    });

    if (!isValid) {
        e.preventDefault();
        alert('Pilih produk untuk semua baris yang ditambahkan');
    }
});

// Add first row on page load
document.addEventListener('DOMContentLoaded', function() {
    addProductRow();
});
</script>
@endsection