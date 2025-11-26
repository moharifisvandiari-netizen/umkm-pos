<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mini POS Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- TailwindCDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="flex">
        <!-- Sidebar -->
        <div class="w-64 bg-white h-screen shadow p-4">
            <h1 class="text-xl font-bold mb-6">Mini POS</h1>
            <ul>
                <li class="mb-2"><a href="{{ route('dashboard') }}" class="block py-2 px-4 hover:bg-gray-200 rounded">Dashboard</a></li>
                <li class="mb-2"><a href="{{ route('produk.index') }}" class="block py-2 px-4 hover:bg-gray-200 rounded">Produk</a></li>
                <li class="mb-2"><a href="{{ route('kategori.index') }}" class="block py-2 px-4 hover:bg-gray-200 rounded">Kategori</a></li>
                <li class="mb-2"><a href="{{ route('satuan.index') }}" class="block py-2 px-4 hover:bg-gray-200 rounded">Satuan</a></li>
                <li class="mb-2"><a href="{{ route('supplier.index') }}" class="block py-2 px-4 hover:bg-gray-200 rounded">Supplier</a></li>
                <li class="mb-2"><a href="{{ route('metode-pembayaran.index') }}" class="block py-2 px-4 hover:bg-gray-200 rounded">Metode Pembayaran</a></li>
                <li class="mb-2"><a href="{{ route('pembelian.index') }}" class="block py-2 px-4 hover:bg-gray-200 rounded">Pembelian</a></li>
                <li class="mb-2"><a href="{{ route('penjualan.index') }}" class="block py-2 px-4 hover:bg-gray-200 rounded">Penjualan</a></li>
                <li class="mt-4"><a href="{{ route('logout') }}" class="block py-2 px-4 bg-red-500 text-white rounded hover:bg-red-600">Logout</a></li>
            </ul>
        </div>
        <!-- Content -->
        <div class="flex-1 p-6">
            @yield('content')
        </div>
    </div>
</body>
</html>
