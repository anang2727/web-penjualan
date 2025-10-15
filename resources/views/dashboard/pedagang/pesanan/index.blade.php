<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pesanan Saya (Histori Pembelian)') }} 📝
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                
                <h3 class="text-2xl font-bold text-gray-800 mb-6">
                    Daftar Pesanan Pembelian Yang Sedang Diproses
                </h3>

                {{-- Tampilkan Notifikasi Sukses --}}
                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                
                {{-- Tampilkan Error Validasi (jika ada error dari modal setelah redirect) --}}
                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <strong class="font-bold">Gagal Membuat Pesanan!</strong>
                        <ul class="mt-1 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if ($transaksiPembelian->isEmpty())
                    <p class="text-center text-gray-500 py-10">Anda belum memiliki riwayat pesanan pembelian.</p>
                @else
                    {{-- TABEL PESANAN --}}
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kode / Tanggal</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Produk</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kuantitas</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Harga</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3"></th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($transaksiPembelian as $transaksi)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">{{ $transaksi->kode_transaksi }}</div>
                                            <div class="text-xs text-gray-500">{{ $transaksi->created_at->format('d M Y H:i') }}</div>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-900">
                                            {{ $transaksi->postinganDagangan?->judul_postingan ?? 'Produk Dihapus' }}
                                            <!-- <div class="text-xs text-gray-500">Pengepul: {{ $transaksi->pengepul->name ?? 'N/A' }}</div> -->
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ number_format($transaksi->kuantitas_pesanan, 2) }} {{ $transaksi->satuan }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-green-600">
                                            Rp{{ number_format($transaksi->total_harga, 0, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{-- Penanda Status --}}
                                            @php
                                                $statusColor = [
                                                    'menunggu_konfirmasi' => 'bg-yellow-100 text-yellow-800',
                                                    'diproses' => 'bg-blue-100 text-blue-800',
                                                    'dikirim' => 'bg-green-100 text-green-800',
                                                    'selesai' => 'bg-green-100 text-green-800',
                                                    'dibatalkan' => 'bg-red-100 text-red-800',
                                                ];
                                            @endphp
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusColor[$transaksi->status] ?? 'bg-gray-100 text-gray-800' }}">
                                                {{ Str::title(str_replace('_', ' ', $transaksi->status)) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            {{-- Tombol Detail/Aksi --}}
                                            
                                            <a href="{{ route('dashboard.pedagang.pesanan.show', $transaksi) }}" class="text-green-600 hover:text-green-900">Detail</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $transaksiPembelian->links() }}
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>