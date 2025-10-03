<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900">
        <div class="container mx-auto py-8 px-4 sm:px-6 lg:px-8">
            
            {{-- Header Section --}}
            <div class="mb-8 sm:mb-12">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-white mb-2 flex items-center gap-3">
                            <span class="text-4xl sm:text-5xl">📋</span>
                            <span class="bg-gradient-to-r from-green-400 to-emerald-500 bg-clip-text text-transparent">
                                Daftar Penawaran
                            </span>
                        </h1>
                        <p class="text-gray-400 text-sm sm:text-base">Temukan peluang terbaik untuk produk Anda</p>
                    </div>
                    
                    {{-- Stats Badge --}}
                    @if($penawarans->count() > 0)
                        <div class="bg-green-500/10 border border-green-500/30 rounded-full px-4 py-2 sm:px-6 sm:py-3">
                            <p class="text-green-400 font-semibold text-sm sm:text-base">
                                {{ $penawarans->count() }} Penawaran Aktif
                            </p>
                        </div>
                    @endif
                </div>
            </div>

            @if($penawarans->count() > 0)
                {{-- Grid Layout --}}
                <div class="grid gap-6 sm:gap-8 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                    @foreach($penawarans as $penawaran)
                        <div class="group bg-gray-800/50 backdrop-blur-sm rounded-2xl shadow-xl overflow-hidden border border-gray-700/50 hover:border-green-500/50 transition-all duration-300 hover:shadow-2xl hover:shadow-green-500/10 hover:-translate-y-2 flex flex-col">
                            
                            {{-- Image Container --}}
                            <div class="relative overflow-hidden h-40">
                                @if($penawaran->foto)
                                    <img src="{{ asset('storage/'.$penawaran->foto) }}"
                                         alt="Foto {{ $penawaran->judul }}"
                                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-gray-700 to-gray-800 flex items-center justify-center">
                                        <svg class="w-12 h-12 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                @endif
                                
                                {{-- Overlay Gradient --}}
                                <div class="absolute inset-0 bg-gradient-to-t from-gray-900/80 via-transparent to-transparent"></div>
                                
                                {{-- Status Badge --}}
                                <div class="absolute top-2 right-2">
                                    <span class="bg-green-500 text-white text-xs font-bold px-2 py-1 rounded-full shadow-lg">
                                        ✨ AKTIF
                                    </span>
                                </div>
                            </div>

                            {{-- Content --}}
                            <div class="p-4 flex flex-col flex-grow">
                                
                                {{-- Title --}}
                                <h3 class="text-base font-bold text-white mb-2 line-clamp-1 group-hover:text-green-400 transition-colors">
                                    {{ $penawaran->judul }}
                                </h3>

                                {{-- Description --}}
                                <p class="text-gray-400 text-xs leading-relaxed mb-3 line-clamp-2">
                                    {{ Str::limit($penawaran->deskripsi, 80) }}
                                </p>

                                {{-- Info Cards --}}
                                <div class="space-y-2 mb-4">
                                    {{-- Kebutuhan --}}
                                    <div class="flex items-center gap-2 bg-gray-700/30 rounded-lg p-2">
                                        <div class="bg-blue-500/20 rounded-lg p-1.5">
                                            <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                            </svg>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-xs text-gray-500">Kebutuhan</p>
                                            <p class="text-white font-semibold text-xs truncate">{{ $penawaran->jumlah_kebutuhan }}</p>
                                        </div>
                                    </div>

                                    {{-- Harga --}}
                                    <div class="flex items-center gap-2 bg-gray-700/30 rounded-lg p-2">
                                        <div class="bg-green-500/20 rounded-lg p-1.5">
                                            <svg class="w-4 h-4 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-xs text-gray-500">Harga</p>
                                            <p class="text-green-400 font-bold text-xs truncate">Rp {{ number_format($penawaran->harga_perkiraan, 0, ',', '.') }}</p>
                                        </div>
                                    </div>

                                    {{-- Deadline --}}
                                    <div class="flex items-center gap-2 bg-gray-700/30 rounded-lg p-2">
                                        <div class="bg-orange-500/20 rounded-lg p-1.5">
                                            <svg class="w-4 h-4 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-xs text-gray-500">Batas</p>
                                            <p class="text-orange-400 font-semibold text-xs">{{ $penawaran->tanggal_batas->format('d M Y') }}</p>
                                        </div>
                                    </div>
                                </div>

                                {{-- Action Button --}}
                                <div class="mt-auto">
                                    <a href="{{ route('petani.penawaran.show', $penawaran->id) }}"
                                       class="block w-full text-center bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white font-bold py-2.5 px-4 rounded-xl transition-all duration-300 shadow-lg hover:shadow-green-500/50 group-hover:scale-105 text-sm">
                                        <span class="flex items-center justify-center gap-2">
                                            🚀 Ajukan
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                {{-- Empty State --}}
                <div class="flex flex-col items-center justify-center py-16 sm:py-24">
                    <div class="bg-gray-800/50 backdrop-blur-sm rounded-3xl p-8 sm:p-12 text-center border border-gray-700/50 max-w-md mx-auto">
                        <div class="bg-gray-700/50 rounded-full w-20 h-20 sm:w-24 sm:h-24 flex items-center justify-center mx-auto mb-6">
                            <svg class="w-10 h-10 sm:w-12 sm:h-12 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl sm:text-2xl font-bold text-white mb-3">Belum Ada Penawaran</h3>
                        <p class="text-gray-400 text-sm sm:text-base">Saat ini belum ada penawaran aktif. Silakan cek kembali nanti.</p>
                    </div>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>