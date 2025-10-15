<x-app-layout>
    <div x-data="{ openModal: false }">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Detail Pesanan {{ $transaksiPembelian->kode_transaksi }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
                
                {{-- Notifikasi Sukses --}}
                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                
                {{-- Notifikasi Error Validasi Modal --}}
                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <strong class="font-bold">Unggah Bukti Gagal!</strong>
                        <ul class="mt-1 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                    
                    {{-- ------------------- BAGIAN DETAIL TRANSAKSI ------------------- --}}
                    
                    <div class="mb-6 pb-4 border-b">
                        <h3 class="text-2xl font-bold text-gray-800">Pesanan ID: {{ $transaksiPembelian->kode_transaksi }}</h3>
                        <p class="text-sm text-gray-500">Dibuat pada: {{ $transaksiPembelian->created_at->format('d M Y, H:i') }}</p>
                    </div>

                    {{-- Status Pesanan --}}
                    <div class="mb-4">
                        <p class="text-gray-700 font-semibold">Status Saat Ini:</p>
                        @php
                            $status = $transaksiPembelian->status;
                            $color = match ($status) {
                                'menunggu_pembayaran' => 'bg-yellow-100 text-yellow-800',
                                'menunggu_verifikasi_pembayaran' => 'bg-purple-100 text-purple-800',
                                'diproses' => 'bg-green-100 text-green-800',
                                'dikirim', 'selesai' => 'bg-green-100 text-green-800',
                                'dibatalkan' => 'bg-red-100 text-red-800',
                                default => 'bg-gray-100 text-gray-800',
                            };
                        @endphp
                        <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full {{ $color }}">
                            {{ Str::title(str_replace('_', ' ', $status)) }}
                        </span>
                    </div>

                    {{-- Detail Produk, Penjual, dll. (Pastikan kode Anda ada di sini) --}}
                    
                    <div class="mt-6 pt-4 border-t">
                        <p class="text-xl font-bold text-gray-800">Total Pembayaran:</p>
                        <p class="text-3xl font-extrabold text-green-600">Rp{{ number_format($transaksiPembelian->total_harga, 0, ',', '.') }}</p>
                    </div>

                    
                    {{-- ------------------- UI PEMBAYARAN KONDISIONAL ------------------- --}}
                    
                    @if ($transaksiPembelian->status === 'menunggu_pembayaran')
                    <div class="mt-8 p-6 border-2 border-dashed border-green-300 bg-green-50 rounded-lg">
                        <h4 class="text-xl font-extrabold text-green-800 mb-4 flex items-center">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                            Instruksi Pembayaran
                        </h4>
                        
                        <p class="mb-4 text-gray-700">Mohon segera lakukan pembayaran sebesar <strong class="text-green-600">Rp{{ number_format($transaksiPembelian->total_harga, 0, ',', '.') }}</strong> ke rekening berikut:</p>
                        
                        <div class="bg-white p-4 rounded-md border border-gray-200 grid grid-cols-2 gap-4 text-sm font-mono">
                            <div>
                                <p class="text-gray-500">Bank Tujuan</p>
                                <p class="text-gray-900 font-semibold">BANK MANDIRI</p>
                            </div>
                            <div>
                                <p class="text-gray-500">Nomor Rekening</p>
                                <p class="text-gray-900 font-semibold text-lg" id="rekening-nomor">1370010887342</p>
                                <button onclick="copyToClipboard('rekening-nomor')" type="button" class="text-green-500 hover:text-green-700 text-xs mt-1">
                                    [ Salin Nomor ]
                                </button>
                            </div>
                            <div class="col-span-2">
                                <p class="text-gray-500">Atas Nama</p>
                                <p class="text-gray-900 font-semibold">PT. HASIL BUMI SEJAHTERA</p>
                            </div>
                        </div>
                        
                        <div class="mt-5">
                            <button @click="openModal = true" class="px-6 py-3 bg-green-600 text-white font-bold rounded-lg hover:bg-green-700 transition duration-150 shadow-md">
                                Konfirmasi Pembayaran & Unggah Bukti
                            </button>
                        </div>
                    </div>
                    @elseif ($transaksiPembelian->status === 'menunggu_verifikasi_pembayaran')
                    <div class="mt-8 p-6 border-2 border-dashed border-purple-300 bg-purple-50 rounded-lg text-purple-800">
                        <h4 class="text-xl font-extrabold mb-4">
                            <i class="fas fa-clock mr-2"></i> Bukti Pembayaran Sudah Diunggah
                        </h4>
                        <p class="mb-2">Bukti pembayaran Anda sudah kami terima dan sedang diverifikasi oleh Pengepul.</p>
                        @if ($transaksiPembelian->bukti_pembayaran_path)
                            <p class="text-sm italic">File Bukti: <a href="{{ Storage::url($transaksiPembelian->bukti_pembayaran_path) }}" target="_blank" class="text-purple-600 hover:underline">Lihat Bukti</a></p>
                        @endif
                    </div>
                    @endif
                    
                    {{-- ... (lanjutan kode lainnya) ... --}}
                    
                    <div class="mt-8 text-right">
                        <a href="{{ route('dashboard.pedagang.pesanan.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 transition ease-in-out duration-150">
                            ← Kembali ke Daftar Pesanan
                        </a>
                    </div>

                </div>
            </div>
        </div>
        
        {{-- --- MODAL UNGGAH BUKTI PEMBAYARAN --- --}}
        <div 
            x-show="openModal" 
            x-cloak 
            class="fixed inset-0 z-50 overflow-y-auto" 
            aria-labelledby="modal-title" role="dialog" 
            aria-modal="true"
        >
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div x-show="openModal" @click="openModal = false" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                
                <div x-show="openModal" class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <form action="{{ route('dashboard.pedagang.pesanan.upload-bukti', $transaksiPembelian) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                Unggah Bukti Pembayaran
                            </h3>
                            <div class="mt-4">
                                <p class="text-sm text-gray-500 mb-4">Total wajib transfer: <strong class="text-green-600">Rp{{ number_format($transaksiPembelian->total_harga, 0, ',', '.') }}</strong></p>
                                
                                <label for="bukti_pembayaran" class="block text-sm font-medium text-gray-700 mb-1">Pilih File Bukti Pembayaran (JPG/PNG)</label>
                                <input 
                                    type="file" 
                                    name="bukti_pembayaran" 
                                    id="bukti_pembayaran" 
                                    required 
                                    class="w-full border border-gray-300 p-2 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500"
                                >
                                
                                <label for="catatan_pembayaran" class="block text-sm font-medium text-gray-700 mt-4 mb-1">Catatan Tambahan (Opsional)</label>
                                <textarea name="catatan_pembayaran" id="catatan_pembayaran" rows="3" class="w-full border border-gray-300 p-2 rounded-md shadow-sm"></textarea>
                            </div>
                        </div>
                        
                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none sm:ml-3 sm:w-auto sm:text-sm">
                                Kirim Bukti
                            </button>
                            <button type="button" @click="openModal = false" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                Batal
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        {{-- Skrip untuk menyalin nomor rekening --}}
        <script>
            function copyToClipboard(elementId) {
                var copyText = document.getElementById(elementId).innerText;
                navigator.clipboard.writeText(copyText).then(() => {
                    alert("Nomor rekening berhasil disalin: " + copyText);
                });
            }
        </script>
    </div>
</x-app-layout>