@extends('layouts.admin')

@section('title', 'Tambah Penjualan')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Tambah Penjualan</h1>
            <p class="text-gray-600">Tambah transaksi penjualan baru</p>
        </div>
        <a href="{{ route('penjualan.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white py-2 px-4 rounded-lg flex items-center space-x-2 transition-colors">
            <i class="fas fa-arrow-left"></i>
            <span>Kembali</span>
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Product Selection -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Pilih Produk</h3>
                
                <!-- Search -->
                <div class="mb-4">
                    <div class="relative">
                        <input type="text" 
                               id="searchProduct"
                               placeholder="Cari produk..."
                               class="w-full px-4 py-2 pl-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                        <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                    </div>
                </div>

                <!-- Products Grid -->
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4 max-h-96 overflow-y-auto p-1">
                    @foreach($produks as $produk)
                    <div class="border border-gray-200 rounded-lg p-4 hover:border-blue-500 transition-colors cursor-pointer product-card"
                         data-product-id="{{ $produk->id }}"
                         data-product-name="{{ $produk->nama_produk }}"
                         data-product-price="{{ $produk->harga_jual }}"
                         data-product-stock="{{ $produk->stok }}"
                         onclick="addToCart({{ $produk->id }}, '{{ $produk->nama_produk }}', {{ $produk->harga_jual }}, {{ $produk->stok }})">
                        <div class="text-center">
                            <div class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center mx-auto mb-2">
                                <i class="fas fa-box text-gray-400"></i>
                            </div>
                            <h4 class="font-medium text-gray-800 text-sm mb-1">{{ $produk->nama_produk }}</h4>
                            <p class="text-green-600 font-semibold text-sm">Rp {{ number_format($produk->harga_jual, 0, ',', '.') }}</p>
                            <p class="text-gray-500 text-xs mt-1">Stok: {{ $produk->stok }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Empty Products State -->
                @if($produks->count() === 0)
                <div class="text-center py-8">
                    <i class="fas fa-box-open text-3xl text-gray-300 mb-4"></i>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak ada produk tersedia</h3>
                    <p class="text-gray-500">Semua produk sedang habis atau nonaktif.</p>
                </div>
                @endif
            </div>
        </div>

        <!-- Cart -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow p-6 sticky top-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Keranjang Belanja</h3>
                
                <form action="{{ route('penjualan.store') }}" method="POST" id="penjualanForm">
                    @csrf

                    <!-- Cart Items -->
                    <div class="space-y-3 mb-4 max-h-64 overflow-y-auto p-1" id="cartItems">
                        <div class="text-center py-8 text-gray-500" id="emptyCart">
                            <i class="fas fa-shopping-cart text-2xl mb-2"></i>
                            <p>Keranjang kosong</p>
                            <p class="text-sm">Pilih produk dari daftar</p>
                        </div>
                    </div>

                    <!-- Total -->
                    <div class="border-t border-gray-200 pt-4 mb-4">
                        <div class="flex justify-between items-center text-lg font-semibold">
                            <span class="text-gray-800">Total:</span>
                            <span id="cartTotal" class="text-green-600">Rp 0</span>
                        </div>
                    </div>

                    <!-- Payment Method -->
                    <div class="mb-4">
                        <label for="metode_pembayaran_id" class="block text-sm font-medium text-gray-700 mb-2">
                            Metode Pembayaran *
                        </label>
                        <select id="metode_pembayaran_id" 
                                name="metode_pembayaran_id"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                required>
                            <option value="">Pilih Metode</option>
                            @foreach($metode as $method)
                                <option value="{{ $method->id }}">{{ $method->nama_metode }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Action Buttons -->
                    <div class="space-y-2">
                        <button type="submit" 
                                id="submitButton"
                                class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 px-4 rounded-lg font-semibold transition-colors flex items-center justify-center space-x-2 disabled:opacity-50 disabled:cursor-not-allowed"
                                disabled>
                            <i class="fas fa-cash-register"></i>
                            <span>Proses Penjualan</span>
                        </button>
                        <button type="button" 
                                onclick="clearCart()"
                                class="w-full bg-gray-600 hover:bg-gray-700 text-white py-2 px-4 rounded-lg font-semibold transition-colors flex items-center justify-center space-x-2">
                            <i class="fas fa-times"></i>
                            <span>Kosongkan Keranjang</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
let cart = [];
let total = 0;

function addToCart(productId, productName, price, stock) {
    const existingItem = cart.find(item => item.productId === productId);
    
    if (existingItem) {
        if (existingItem.quantity < stock) {
            existingItem.quantity++;
            existingItem.subtotal = existingItem.quantity * price;
        } else {
            alert('Stok tidak mencukupi!');
            return;
        }
    } else {
        if (stock > 0) {
            cart.push({
                productId: productId,
                productName: productName,
                price: price,
                quantity: 1,
                subtotal: price,
                stock: stock
            });
        } else {
            alert('Stok habis!');
            return;
        }
    }
    
    updateCartDisplay();
    updateFormInputs();
    updateSubmitButton();
}

function removeFromCart(productId) {
    cart = cart.filter(item => item.productId !== productId);
    updateCartDisplay();
    updateFormInputs();
    updateSubmitButton();
}

function updateQuantity(productId, change) {
    const item = cart.find(item => item.productId === productId);
    if (item) {
        const newQuantity = item.quantity + change;
        if (newQuantity > 0 && newQuantity <= item.stock) {
            item.quantity = newQuantity;
            item.subtotal = item.quantity * item.price;
            updateCartDisplay();
            updateFormInputs();
        } else if (newQuantity === 0) {
            removeFromCart(productId);
        } else {
            alert('Stok tidak mencukupi!');
        }
    }
}

function clearCart() {
    if (cart.length > 0 && confirm('Apakah Anda yakin ingin mengosongkan keranjang?')) {
        cart = [];
        updateCartDisplay();
        updateFormInputs();
        updateSubmitButton();
    }
}

function updateCartDisplay() {
    const cartItems = document.getElementById('cartItems');
    const cartTotal = document.getElementById('cartTotal');
    const emptyCart = document.getElementById('emptyCart');
    
    cartItems.innerHTML = '';
    total = 0;
    
    if (cart.length === 0) {
        emptyCart.style.display = 'block';
        cartTotal.textContent = 'Rp 0';
        return;
    }
    
    emptyCart.style.display = 'none';
    
    cart.forEach(item => {
        total += item.subtotal;
        
        const itemElement = document.createElement('div');
        itemElement.className = 'flex justify-between items-center border-b border-gray-200 pb-3';
        itemElement.innerHTML = `
            <div class="flex-1">
                <h4 class="font-medium text-gray-800 text-sm">${item.productName}</h4>
                <p class="text-green-600 font-semibold text-xs">Rp ${item.price.toLocaleString()} x ${item.quantity}</p>
                <p class="text-gray-500 text-xs">Subtotal: Rp ${item.subtotal.toLocaleString()}</p>
            </div>
            <div class="flex items-center space-x-2">
                <button type="button" onclick="updateQuantity(${item.productId}, -1)" 
                        class="w-6 h-6 bg-red-500 text-white rounded-full flex items-center justify-center hover:bg-red-600 transition-colors">
                    <i class="fas fa-minus text-xs"></i>
                </button>
                <span class="text-sm font-medium w-8 text-center">${item.quantity}</span>
                <button type="button" onclick="updateQuantity(${item.productId}, 1)" 
                        class="w-6 h-6 bg-green-500 text-white rounded-full flex items-center justify-center hover:bg-green-600 transition-colors">
                    <i class="fas fa-plus text-xs"></i>
                </button>
                <button type="button" onclick="removeFromCart(${item.productId})" 
                        class="w-6 h-6 bg-gray-500 text-white rounded-full flex items-center justify-center hover:bg-gray-600 transition-colors ml-2">
                    <i class="fas fa-times text-xs"></i>
                </button>
            </div>
        `;
        cartItems.appendChild(itemElement);
    });
    
    cartTotal.textContent = `Rp ${total.toLocaleString()}`;
}

function updateFormInputs() {
    const form = document.getElementById('penjualanForm');
    
    // Remove existing item inputs
    const existingInputs = form.querySelectorAll('input[name^="items"]');
    existingInputs.forEach(input => input.remove());
    
    // Add new item inputs
    cart.forEach((item, index) => {
        const productIdInput = document.createElement('input');
        productIdInput.type = 'hidden';
        productIdInput.name = `items[${index}][produk_id]`;
        productIdInput.value = item.productId;
        form.appendChild(productIdInput);
        
        const quantityInput = document.createElement('input');
        quantityInput.type = 'hidden';
        quantityInput.name = `items[${index}][jumlah]`;
        quantityInput.value = item.quantity;
        form.appendChild(quantityInput);
    });
}

function updateSubmitButton() {
    const submitButton = document.getElementById('submitButton');
    const paymentMethod = document.getElementById('metode_pembayaran_id');
    
    if (cart.length > 0 && paymentMethod.value) {
        submitButton.disabled = false;
    } else {
        submitButton.disabled = true;
    }
}

// Search functionality
document.getElementById('searchProduct').addEventListener('input', function(e) {
    const searchTerm = e.target.value.toLowerCase();
    const productCards = document.querySelectorAll('.product-card');
    
    productCards.forEach(card => {
        const productName = card.getAttribute('data-product-name').toLowerCase();
        if (productName.includes(searchTerm)) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });
});

// Payment method change
document.getElementById('metode_pembayaran_id').addEventListener('change', updateSubmitButton);

// Form validation
document.getElementById('penjualanForm').addEventListener('submit', function(e) {
    if (cart.length === 0) {
        e.preventDefault();
        alert('Tambahkan minimal satu produk ke keranjang!');
        return;
    }
    
    if (!document.getElementById('metode_pembayaran_id').value) {
        e.preventDefault();
        alert('Pilih metode pembayaran!');
        return;
    }
});

// Initialize
document.addEventListener('DOMContentLoaded', function() {
    updateSubmitButton();
});
</script>
@endsection