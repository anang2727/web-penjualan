<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Profil Petani') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 sm:p-8">
                
                <div class="flex justify-between items-center mb-6 border-b pb-4">
                    <h3 class="text-2xl font-bold text-gray-900">Profil Anda</h3>
                    <a href="{{ route('petani.datapetani.edit', $detailPetani) }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        Edit Profil
                    </a>
                </div>

                {{-- 1. Informasi Kontak & Logistik --}}
                <div class="mb-8">
                    <h4 class="text-lg font-semibold text-gray-700 mb-4 border-b-2 border-green-500 pb-1">Kontak & Lokasi</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-8 text-sm">
                        
                        <div>
                            <p class="text-gray-500 font-medium">Nomor Telepon:</p>
                            <p class="text-gray-900 text-base font-semibold">{{ $detailPetani->no_telepon }}</p>
                        </div>
                        
                        <div>
                            <p class="text-gray-500 font-medium">Email Opsional:</p>
                            <p class="text-gray-900 text-base">{{ $detailPetani->email_opsional ?? '-' }}</p>
                        </div>
                        
                        <div class="md:col-span-2">
                            <p class="text-gray-500 font-medium">Alamat Lengkap Penjemputan:</p>
                            <p class="text-gray-900 text-base whitespace-pre-wrap">{{ $detailPetani->alamat_lengkap }}</p>
                            <p class="text-xs text-gray-500 mt-1">Ini adalah alamat yang digunakan untuk penjemputan COD.</p>
                        </div>
                        
                        <div>
                            <p class="text-gray-500 font-medium">Komoditas Utama:</p>
                            <p class="text-gray-900 text-base">{{ $detailPetani->komoditas_utama ?? 'Belum Ditentukan' }}</p>
                        </div>

                    </div>
                </div>

                {{-- 2. Informasi Pembayaran --}}
                <div class="mb-8 pt-6 border-t">
                    <h4 class="text-lg font-semibold text-gray-700 mb-4 border-b-2 border-green-500 pb-1">Detail Pembayaran (Transfer Bank)</h4>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-y-4 gap-x-8 text-sm">
                        
                        <div>
                            <p class="text-gray-500 font-medium">Nama Bank:</p>
                            <p class="text-gray-900 text-base font-semibold">{{ $detailPetani->bank_nama ?? '-' }}</p>
                        </div>
                        
                        <div>
                            <p class="text-gray-500 font-medium">Nomor Rekening:</p>
                            <p class="text-gray-900 text-base">{{ $detailPetani->rekening_nomor ?? '-' }}</p>
                        </div>
                        
                        <div>
                            <p class="text-gray-500 font-medium">Nama Pemilik Rekening:</p>
                            <p class="text-gray-900 text-base">{{ $detailPetani->rekening_nama ?? '-' }}</p>
                        </div>

                    </div>
                    <p class="text-xs text-gray-500 mt-4">Data ini opsional dan hanya diperlukan jika transaksi menggunakan metode Transfer Bank.</p>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>