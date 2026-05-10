<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-lg sm:text-xl text-gray-800 leading-tight">
            {{ __('Dasbor Pedagang') }} 🛒
        </h2>
    </x-slot>

    {{-- Container utama Alpine.js untuk Modal --}}
    <div class="py-6 sm:py-12" x-data="{ 
        showModal: false, 
        postId: null, 
        judul: '', 
        harga: 0, 
        satuan: '',
        minOrder: 0,
        stokTersedia: 0,
        tempKuantitas: 0,
        tempTotal: 0,

        // Fungsi untuk menghitung ulang total harga
        updateTotal: function() {
            if (this.tempKuantitas >= this.minOrder && this.tempKuantitas <= this.stokTersedia) {
                this.tempTotal = this.tempKuantitas * this.harga;
            } else {
                this.tempTotal = 0;
            }
        },

        // Fungsi untuk membuka modal dan mengisi data produk
        openOrderModal: function(post) {
            this.postId = post.id;
            this.judul = post.judul;
            this.harga = post.harga;
            this.satuan = post.satuan;
            this.minOrder = post.minOrder;
            this.stokTersedia = post.stok;
            
            this.tempKuantitas = post.minOrder > 0 ? post.minOrder : 1; 
            
            if (this.stokTersedia < this.tempKuantitas) {
                this.tempKuantitas = this.stokTersedia;
            }
            
            this.updateTotal();
            this.showModal = true;
        }
    }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- START: NOTIFIKASI DAN BATASAN PROFIL --}}
            @if (!$detailPedagang)
            <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative mb-4 sm:mb-6 shadow-md" role="alert">
                <strong class="font-bold">Perhatian!</strong>
                <span class="block sm:inline text-sm">Anda belum melengkapi data profil. Lengkapi data <strong>Profil &amp; Alamat</strong> untuk bisa memulai transaksi.</span>
                <div class="mt-2">
                    <a href="{{ route('dashboard.pedagang.create') }}" class="inline-flex items-center px-3 py-1 bg-yellow-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-700 active:bg-yellow-800 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Lengkapi Profil Sekarang &rarr;
                    </a>
                </div>
            </div>
            @endif

            @if ($detailPedagang)
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4 sm:mb-6 shadow-md" role="alert">
                <strong class="font-bold">Profil Lengkap.</strong>
                <span class="block sm:inline text-sm"> Anda sudah siap bertransaksi! Lihat atau ubah data Anda <a href="{{ route('dashboard.pedagang.show', $detailPedagang) }}" class="font-medium underline hover:text-green-800">di sini</a>.</span>
            </div>
            @endif
            {{-- END: NOTIFIKASI DAN BATASAN PROFIL --}}

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4 sm:p-6">

                <h3 class="text-xl sm:text-2xl font-bold text-green-700 mb-2 sm:mb-4">
                    Selamat Datang, {{ Auth::user()->name }}! 🛒
                </h3>
                <p class="text-sm sm:text-base text-gray-700 mb-4 sm:mb-6">
                    Lihat semua penawaran hasil tani terbaru dari pengepul di seluruh wilayah.
                </p>

                {{-- START: SEARCH BAR --}}
                <form method="GET" action="{{ route('dashboard') }}" class="mb-4 sm:mb-6">
                    <label for="search" class="sr-only">Cari Penawaran</label>
                    <div class="relative">
                        <input type="text" name="q" id="search" placeholder="Cari cabai, bawang, atau lokasi..." value="{{ $q }}"
                            class="w-full text-sm border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm pr-10">
                        <button type="submit" class="absolute inset-y-0 right-0 flex items-center pr-3">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </button>
                    </div>
                    <input type="hidden" name="tab" value="{{ $activeTab }}">
                </form>
                {{-- END: SEARCH BAR --}}

                {{-- START: TABS FILTER --}}
                <div class="border-b border-gray-200 mb-4 sm:mb-6 overflow-x-auto">
                    <nav class="-mb-px flex space-x-4 sm:space-x-8" aria-label="Tabs">
                        @php
                        $tabs = [
                        'semua' => 'Semua Penawaran',
                        'terbaru' => 'Terbaru',
                        'termurah' => 'Termurah',
                        'populer' => 'Paling Diminati',
                        ];
                        @endphp

                        @foreach ($tabs as $key => $label)
                        @php
                        $isActive = ($key == $activeTab);
                        @endphp
                        <a href="{{ route('dashboard', ['tab' => $key, 'q' => $q]) }}"
                            class="{{ $isActive ? 'border-green-500 text-green-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} flex-shrink-0 whitespace-nowrap py-2 px-1 border-b-2 font-medium text-xs sm:text-sm transition duration-150 ease-in-out">
                            {{ $label }}
                        </a>
                        @endforeach
                    </nav>
                </div>
                {{-- END: TABS FILTER --}}

                {{-- Konten Utama: Marketplace DARI DATABASE --}}
                @if ($postingan_dagangans->isEmpty() && $q)
                <p class="text-center text-gray-500 mt-6 sm:mt-8">Tidak ditemukan penawaran untuk kata kunci <strong>"{{ $q }}"</strong>.</p>
                @elseif ($postingan_dagangans->isEmpty())
                <p class="text-center text-gray-500 mt-6 sm:mt-8">Saat ini belum ada postingan dagangan yang aktif.</p>
                @else
                <div class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 sm:gap-6">

                    @foreach ($postingan_dagangans as $postingan)
                    <div class="bg-white border border-gray-200 rounded-lg shadow-md hover:shadow-xl transition duration-300 flex flex-col">
                        {{-- Gambar Produk --}}
                        @php
                        $fotoUrl = $postingan->foto_postingan ? asset('storage/' . $postingan->foto_postingan) : 'https://placehold.co/600x400/CCCCCC/white?text=PRODUK';
                        @endphp

                        <img class="rounded-t-lg w-full h-24 sm:h-40 object-cover"
                            src="{{ $fotoUrl }}"
                            alt="{{ $postingan->judul_postingan }}" />

                        <div class="p-3 sm:p-4 flex flex-col flex-1">
                            {{-- Nama Produk --}}
                            <h5 class="mb-1 text-xs sm:text-base font-bold tracking-tight text-gray-900 line-clamp-2">
                                {{ $postingan->judul_postingan }}
                            </h5>

                            {{-- Detail Komoditas --}}
                            <p class="text-xs text-gray-500 mb-2">
                                Komoditas: {{ $postingan->stokPengepul->nama_komoditas ?? 'N/A' }}
                            </p>

                            {{-- Harga --}}
                            <p class="mb-3 text-base sm:text-xl font-extrabold text-green-600">
                                Rp{{ number_format($postingan->harga_jual_satuan, 0, ',', '.') }}
                                <span class="text-xs font-normal text-gray-500">/ {{ $postingan->satuan }}</span>
                            </p>

                            {{-- Lokasi & Stok --}}
                            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center text-xs text-gray-600 mb-3 sm:mb-4">
                                <div class="flex items-center mb-1 sm:mb-0">
                                    <svg class="w-3 h-3 mr-1 text-red-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="truncate">{{ $postingan->lokasi_stok }}</span>
                                </div>
                                <span class="text-xs font-semibold text-green-600 flex-shrink-0">
                                    Stok: {{ number_format($postingan->kuantitas_dijual, 0, ',', '.') }} {{ $postingan->satuan }}
                                </span>
                            </div>

                            {{-- Tombol Aksi (PERBAIKAN: class string tidak diputus oleh @if/@else) --}}
                            <div class="mt-auto">
                                @if (!$detailPedagang)
                                <button type="button"
                                    onclick="alert('Lengkapi profil Anda terlebih dahulu!')"
                                    class="inline-flex items-center px-2 py-1 sm:px-4 sm:py-2 text-xs sm:text-sm font-medium text-center text-white bg-green-600 rounded-lg focus:ring-4 focus:outline-none focus:ring-green-300 transition duration-150 ease-in-out w-full justify-center opacity-50 cursor-not-allowed">
                                    Lihat Detail &amp; Beli
                                </button>
                                @else
                                <a x-on:click.prevent="openOrderModal({
                                                id: {{ $postingan->id }},
                                                judul: '{{ addslashes($postingan->judul_postingan) }}',
                                                harga: {{ $postingan->harga_jual_satuan }},
                                                satuan: '{{ $postingan->satuan }}',
                                                minOrder: {{ $postingan->minimum_order ?? 1 }}, 
                                                stok: {{ $postingan->kuantitas_dijual }}
                                            })"
                                    href="#"
                                    class="inline-flex items-center px-2 py-1 sm:px-4 sm:py-2 text-xs sm:text-sm font-medium text-center text-white bg-green-600 rounded-lg hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 transition duration-150 ease-in-out w-full justify-center">
                                    Lihat Detail &amp; Beli
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>

                {{-- Pagination --}}
                <div class="mt-4 sm:mt-8">
                    {{ $postingan_dagangans->appends(['q' => $q, 'tab' => $activeTab])->links() }}
                </div>

                @endif

            </div>
        </div>

        {{-- ********************************************** --}}
        {{-- MODAL TRANSAKSI PEMBELIAN (DI LUAR GRID UTAMA) --}}
        {{-- ********************************************** --}}
        <div x-show="showModal" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div x-on:click="showModal = false" class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75"></div>

                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                <h3 class="text-lg leading-6 font-medium text-gray-900" x-text="judul"></h3>
                                <div class="mt-2">
                                    {{-- FORM AKSI KE ROUTE STORE TRANSAKSI --}}
                                    <form :action="'{{ route('dashboard.pedagang.pesanan.store', ['postingan' => 'TEMP_ID']) }}'.replace('TEMP_ID', postId)" method="POST">
                                        @csrf

                                        <div class="mb-4">
                                            <p class="text-sm font-semibold text-gray-700">Harga Satuan:</p>
                                            <p class="text-2xl font-extrabold text-green-600">
                                                Rp<span x-text="harga.toLocaleString('id-ID')"></span> / <span x-text="satuan"></span>
                                            </p>
                                            <p class="text-xs text-gray-500 mt-1">
                                                Stok Tersedia: <span x-text="stokTersedia"></span> <span x-text="satuan"></span>.
                                                Minimum Order: <span x-text="minOrder"></span> <span x-text="satuan"></span>.
                                            </p>
                                        </div>

                                        {{-- Input Kuantitas --}}
                                        <div class="mb-4">
                                            <label for="kuantitas_pesanan" class="block text-sm font-medium text-gray-700">Kuantitas Pesanan (<span x-text="satuan"></span>)</label>
                                            <input type="number" name="kuantitas_pesanan" id="kuantitas_pesanan"
                                                x-model.number="tempKuantitas" x-on:input="updateTotal"
                                                :min="minOrder" :max="stokTersedia"
                                                step="0.01" required
                                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring-green-500">
                                            @error('kuantitas_pesanan', 'default') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                        </div>

                                        {{-- Total Harga --}}
                                        <div class="mb-4 p-3 bg-gray-50 rounded-md">
                                            <p class="text-sm font-medium text-gray-700">Total Pembayaran:</p>
                                            <p class="text-3xl font-extrabold text-red-600">
                                                Rp<span x-text="tempTotal.toLocaleString('id-ID')"></span>
                                            </p>
                                        </div>

                                        {{-- Catatan --}}
                                        <div class="mb-4">
                                            <label for="catatan" class="block text-sm font-medium text-gray-700">Catatan (Opsional)</label>
                                            <textarea name="catatan" id="catatan" rows="2" class="mt-1 block w-full text-sm border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring-green-500"></textarea>
                                        </div>

                                        <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                                            <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm">
                                                Pesan Sekarang
                                            </button>
                                            <button type="button" x-on:click="showModal = false" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                                Batal
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>