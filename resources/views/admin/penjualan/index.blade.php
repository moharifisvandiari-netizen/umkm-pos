@extends('layouts.admin')

@section('title', 'Riwayat Penjualan')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Riwayat Penjualan</h1>
            <p class="text-gray-600">Daftar transaksi penjualan</p>
        </div>
        <a href="{{ route('penjualan.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg flex items-center space-x-2 transition-colors">
            <i class="fas fa-plus"></i>
            <span>Tambah Penjualan</span>
        </a>
    </div>

    <!-- Sales Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kasir</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Metode Bayar</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($penjualan as $item)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">#{{ $item->id }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $item->user->name ?? 'System' }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800">
                                {{ $item->metode_pembayaran->nama_metode ?? '-' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            Rp {{ number_format($item->total, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $item->created_at->format('d/m/Y H:i') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <button type="button" 
                                    onclick="showDetail({{ $item->id }})"
                                    class="text-blue-600 hover:text-blue-900 transition-colors px-3 py-1 rounded hover:bg-blue-50"
                                    title="Lihat Detail">
                                <i class="fas fa-eye mr-1"></i>Detail
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Empty State -->
        @if($penjualan->count() === 0)
        <div class="text-center py-12">
            <i class="fas fa-cash-register text-4xl text-gray-300 mb-4"></i>
            <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada transaksi penjualan</h3>
            <p class="text-gray-500 mb-4">Mulai tambah transaksi penjualan untuk mencatat penjualan produk.</p>
            <a href="{{ route('penjualan.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg inline-flex items-center space-x-2 transition-colors">
                <i class="fas fa-plus"></i>
                <span>Tambah Penjualan Pertama</span>
            </a>
        </div>
        @endif
    </div>
</div>

<!-- Modal Detail -->
<div id="detailModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-full max-w-4xl shadow-lg rounded-lg bg-white">
        <div class="flex justify-between items-center pb-3 border-b">
            <h3 class="text-xl font-bold text-gray-800">Detail Penjualan</h3>
            <button onclick="closeDetail()" class="text-gray-400 hover:text-gray-600 text-2xl">
                &times;
            </button>
        </div>
        <div id="modalContent" class="py-4 max-h-96 overflow-y-auto">
            <!-- Content will be loaded here -->
        </div>
        <div class="flex justify-end pt-4 border-t">
            <button onclick="closeDetail()" class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700 transition-colors">
                Tutup
            </button>
        </div>
    </div>
</div>

<script>
function showDetail(id) {
    fetch(`/penjualan/${id}/detail`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.text();
        })
        .then(html => {
            document.getElementById('modalContent').innerHTML = html;
            document.getElementById('detailModal').classList.remove('hidden');
        })
        .catch(error => {
            console.error('Error:', error);
            document.getElementById('modalContent').innerHTML = `
                <div class="text-center py-8">
                    <i class="fas fa-exclamation-triangle text-3xl text-red-500 mb-4"></i>
                    <p class="text-red-500">Gagal memuat detail penjualan</p>
                </div>
            `;
            document.getElementById('detailModal').classList.remove('hidden');
        });
}

function closeDetail() {
    document.getElementById('detailModal').classList.add('hidden');
}

// Close modal when clicking outside
document.getElementById('detailModal').addEventListener('click', function(e) {
    if (e.target.id === 'detailModal') {
        closeDetail();
    }
});

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeDetail();
    }
});
</script>
@endsection