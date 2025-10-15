<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profil Pedagang Anda') }} 📝
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    
                    <div class="flex justify-between items-center mb-6 border-b pb-3">
                        <h3 class="text-2xl font-bold text-gray-900">
                            Data Lengkap Pedagang
                        </h3>
                        {{-- Tombol Edit --}}
                        <a href="{{ route('dashboard.pedagang.edit', $detailPedagang) }}" 
                           class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                            Edit Profil
                        </a>
                    </div>

                    {{-- Bagian Informasi Kontak --}}
                    <div class="mb-8">
                        <h4 class="text-xl font-semibold text-green-700 mb-3">
                            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            Detail Kontak & Lokasi
                        </h4>
                        
                        <div class="ml-7 space-y-2 text-gray-700">
                            <p><strong>Nama Pengguna:</strong> {{ $detailPedagang->user->name ?? 'N/A' }}</p>
                            <p><strong>Nomor Telepon:</strong> {{ $detailPedagang->no_telepon }}</p>
                            <p><strong>Alamat Lengkap:</strong> {{ $detailPedagang->alamat_lengkap }}</p>
                            <p><strong>Email Tambahan:</strong> {{ $detailPedagang->emaill ?? '-' }}</p>
                        </div>
                    </div>

                    {{-- Bagian Informasi Pembayaran --}}
                    <div class="mb-8 pt-4 border-t border-gray-100">
                        <h4 class="text-xl font-semibold text-green-700 mb-3">
                            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                            Informasi Rekening Bank
                        </h4>
                        
                        <div class="ml-7 space-y-2 text-gray-700">
                            @if($detailPedagang->rekening_nomor)
                                <p><strong>Nama Bank:</strong> {{ $detailPedagang->bank_nama }}</p>
                                <p><strong>Nomor Rekening:</strong> {{ $detailPedagang->rekening_nomor }}</p>
                                <p><strong>Nama Pemilik:</strong> {{ $detailPedagang->rekening_nama }}</p>
                            @else
                                <p class="text-red-500">Anda belum memasukkan detail rekening bank.</p>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>