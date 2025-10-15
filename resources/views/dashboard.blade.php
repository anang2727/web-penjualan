<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dasbor Petani') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <h3 class="text-2xl font-bold text-green-700 mb-4">
                        Selamat Datang, {{ Auth::user()->name }}! 🌾
                    </h3>

                    @php
                        // Mengambil objek user yang Paling Segar (fresh) dari database
                        $userFresh = Auth::user()->fresh('detailPetani');
                        $profilPetani = $userFresh->detailPetani;
                    @endphp

                    @if (!$profilPetani)
                        {{-- Tampilan jika data BELUM diisi --}}
                        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-md shadow-md">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <svg class="h-6 w-6 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.3 16c-.77 1.333.192 3 1.732 3z" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-lg font-medium text-yellow-800">
                                        Perhatian! Profil Anda Belum Lengkap.
                                    </p>
                                    <p class="mt-1 text-sm text-yellow-700">
                                        Agar pengepul dapat melihat penawaran Anda dan melakukan transaksi COD atau Transfer, mohon **lengkapi data Anda** terlebih dahulu.
                                    </p>
                                </div>
                            </div>
                            <div class="mt-4">
                                <a href="{{ route('petani.datapetani.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-yellow-800 bg-yellow-200 hover:bg-yellow-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transition duration-150 ease-in-out">
                                    Lengkapi Data Saya Sekarang
                                </a>
                            </div>
                        </div>
                    @else
                        {{-- Tampilan jika data SUDAH diisi (BLOCK PERBAIKAN TAMPILAN HIJAU) --}}
                        <div class="bg-green-50 border-l-4 border-green-400 p-4 rounded-md shadow-md text-gray-700">
                            <h4 class="text-xl font-semibold text-green-800 mb-2">Profil Petani Anda Lengkap! ✅</h4>
                            
                            <p class="mb-2">
                                Anda sudah masuk dan siap untuk mulai menawarkan hasil pertanian Anda.
                            </p>
                            
                            <div class="mt-4 p-3 border border-gray-200 rounded-lg bg-white">
                                <p class="text-sm font-medium text-gray-600">Komoditas Utama:</p>
                                <p class="text-lg font-bold text-green-600 mb-2">{{ $profilPetani->komoditas_utama ?? 'Belum Ditentukan' }}</p>
                                
                                <p class="text-sm font-medium text-gray-600">Alamat Pemasaran:</p>
                                <p class="text-base">{{ \Illuminate\Support\Str::limit($profilPetani->alamat_lengkap, 80) }}</p>
                            </div>
                            
                            <div class="mt-4 flex space-x-4">
                                {{-- PERUBAHAN: Mengarahkan langsung ke Edit --}}
                                <a href="{{ route('petani.datapetani.edit', $profilPetani) }}" 
                                   class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-150 ease-in-out">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    Edit Data Profil Saya
                                </a>
                             
                            </div>
                        </div>
                    @endif {{-- PASTIKAN @endif INI ADA DAN MENUTUP @if PADA BARIS ATAS --}}

                </div>
            </div>
        </div>
    </div>
</x-app-layout>