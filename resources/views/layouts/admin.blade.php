<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UMKM POS - @yield('title')</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        .sidebar {
            transition: all 0.3s ease;
        }
        .active-menu {
            background-color: #3B82F6;
            color: white;
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-blue-800 text-white shadow-lg sidebar">
            <!-- Logo -->
            <div class="p-4 border-b border-blue-700">
                <div class="flex items-center space-x-3">
                    <i class="fas fa-cash-register text-2xl text-blue-300"></i>
                    <span class="text-xl font-bold">UMKM POS</span>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="p-4 space-y-2">
                <!-- Dashboard -->
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-blue-700 transition-colors {{ request()->routeIs('dashboard') ? 'active-menu' : '' }}">
                    <i class="fas fa-chart-bar w-6"></i>
                    <span>Dashboard</span>
                </a>

                <!-- Master Data -->
                <div class="pt-4">
                    <p class="text-blue-300 text-sm font-semibold px-3 pb-2">MASTER DATA</p>
                    
                    <a href="{{ route('produk.index') }}" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-blue-700 transition-colors {{ request()->routeIs('produk.*') ? 'active-menu' : '' }}">
                        <i class="fas fa-box w-6"></i>
                        <span>Produk</span>
                    </a>
                    
                    <a href="{{ route('kategori.index') }}" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-blue-700 transition-colors {{ request()->routeIs('kategori.*') ? 'active-menu' : '' }}">
                        <i class="fas fa-tags w-6"></i>
                        <span>Kategori</span>
                    </a>
                    
                    <a href="{{ route('satuan.index') }}" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-blue-700 transition-colors {{ request()->routeIs('satuan.*') ? 'active-menu' : '' }}">
                        <i class="fas fa-weight-hanging w-6"></i>
                        <span>Satuan</span>
                    </a>
                    
                    <a href="{{ route('supplier.index') }}" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-blue-700 transition-colors {{ request()->routeIs('supplier.*') ? 'active-menu' : '' }}">
                        <i class="fas fa-truck w-6"></i>
                        <span>Supplier</span>
                    </a>
                </div>

                <!-- Transaksi -->
                <div class="pt-4">
                    <p class="text-blue-300 text-sm font-semibold px-3 pb-2">TRANSAKSI</p>
                    
                    <a href="{{ route('pembelian.index') }}" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-blue-700 transition-colors {{ request()->routeIs('pembelian.*') ? 'active-menu' : '' }}">
                        <i class="fas fa-shopping-cart w-6"></i>
                        <span>Pembelian</span>
                    </a>
                    
                    <a href="{{ route('penjualan.index') }}" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-blue-700 transition-colors {{ request()->routeIs('penjualan.*') ? 'active-menu' : '' }}">
                        <i class="fas fa-cash-register w-6"></i>
                        <span>Penjualan</span>
                    </a>
                </div>

                <!-- Logout -->
                <div class="pt-4 border-t border-blue-700">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-blue-700 transition-colors w-full text-left">
                            <i class="fas fa-sign-out-alt w-6"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Topbar -->
            <header class="bg-white shadow-sm border-b">
                <div class="flex items-center justify-between p-4">
                    <h1 class="text-2xl font-bold text-gray-800">@yield('title')</h1>
                    <div class="flex items-center space-x-4">
                        <span class="text-gray-600">Welcome, {{ Auth::user()->name ?? 'Admin' }}</span>
                        <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                            <span class="text-white text-sm font-semibold">{{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}</span>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Content -->
            <main class="flex-1 overflow-y-auto p-6">
                <!-- Notifications -->
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        <i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        // Auto-hide alerts
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.bg-green-100, .bg-red-100');
            alerts.forEach(alert => {
                setTimeout(() => {
                    alert.style.transition = 'opacity 0.5s ease';
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 500);
                }, 5000);
            });
        });

        // Confirm delete
        function confirmDelete(message = 'Apakah Anda yakin ingin menghapus data ini?') {
            return confirm(message);
        }
    </script>

    @stack('scripts')
</body>
</html>