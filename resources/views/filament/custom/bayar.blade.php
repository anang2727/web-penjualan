<div class="space-y-4">
    {{-- Header Section --}}
    <div class="text-center mb-4">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Pilih Metode Pembayaran</h3>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Silakan pilih metode pembayaran yang Anda inginkan</p>
    </div>

    {{-- E-Wallet Section --}}
    <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-4">
        <div class="flex items-center gap-2 mb-3">
            <div class="bg-blue-100 dark:bg-blue-900 p-1.5 rounded">
                <svg class="w-4 h-4 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                </svg>
            </div>
            <h4 class="text-sm font-semibold text-gray-900 dark:text-white">E-Wallet</h4>
        </div>
        <div class="grid grid-cols-4 gap-2">
            <button type="button" class="p-3 border border-gray-300 dark:border-gray-600 rounded-lg hover:border-blue-500 hover:bg-blue-50 dark:hover:bg-blue-900/20 transition-colors">
                <div class="bg-blue-100 dark:bg-blue-900 p-2 rounded-full mx-auto w-fit mb-1">
                    <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M21 18v1c0 1.1-.9 2-2 2H5c-1.11 0-2-.9-2-2V5c0-1.1.89-2 2-2h14c1.1 0 2 .9 2 2v1h-9c-1.11 0-2 .9-2 2v8c0 1.1.89 2 2 2h9zm-9-2h10V8H12v8zm4-2.5c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5z"/>
                    </svg>
                </div>
                <span class="text-xs font-medium text-gray-700 dark:text-gray-300">DANA</span>
            </button>
            
            <button type="button" class="p-3 border border-gray-300 dark:border-gray-600 rounded-lg hover:border-purple-500 hover:bg-purple-50 dark:hover:bg-purple-900/20 transition-colors">
                <div class="bg-purple-100 dark:bg-purple-900 p-2 rounded-full mx-auto w-fit mb-1">
                    <svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M21 18v1c0 1.1-.9 2-2 2H5c-1.11 0-2-.9-2-2V5c0-1.1.89-2 2-2h14c1.1 0 2 .9 2 2v1h-9c-1.11 0-2 .9-2 2v8c0 1.1.89 2 2 2h9zm-9-2h10V8H12v8zm4-2.5c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5z"/>
                    </svg>
                </div>
                <span class="text-xs font-medium text-gray-700 dark:text-gray-300">OVO</span>
            </button>
            
            <button type="button" class="p-3 border border-gray-300 dark:border-gray-600 rounded-lg hover:border-green-500 hover:bg-green-50 dark:hover:bg-green-900/20 transition-colors">
                <div class="bg-green-100 dark:bg-green-900 p-2 rounded-full mx-auto w-fit mb-1">
                    <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M21 18v1c0 1.1-.9 2-2 2H5c-1.11 0-2-.9-2-2V5c0-1.1.89-2 2-2h14c1.1 0 2 .9 2 2v1h-9c-1.11 0-2 .9-2 2v8c0 1.1.89 2 2 2h9zm-9-2h10V8H12v8zm4-2.5c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5z"/>
                    </svg>
                </div>
                <span class="text-xs font-medium text-gray-700 dark:text-gray-300">GoPay</span>
            </button>
            
            <button type="button" class="p-3 border border-gray-300 dark:border-gray-600 rounded-lg hover:border-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors">
                <div class="bg-red-100 dark:bg-red-900 p-2 rounded-full mx-auto w-fit mb-1">
                    <svg class="w-5 h-5 text-red-600 dark:text-red-400" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M21 18v1c0 1.1-.9 2-2 2H5c-1.11 0-2-.9-2-2V5c0-1.1.89-2 2-2h14c1.1 0 2 .9 2 2v1h-9c-1.11 0-2 .9-2 2v8c0 1.1.89 2 2 2h9zm-9-2h10V8H12v8zm4-2.5c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5z"/>
                    </svg>
                </div>
                <span class="text-xs font-medium text-gray-700 dark:text-gray-300">LinkAja</span>
            </button>
        </div>
    </div>

    {{-- Bank Transfer Section --}}
    <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-4">
        <div class="flex items-center gap-2 mb-3">
            <div class="bg-green-100 dark:bg-green-900 p-1.5 rounded">
                <svg class="w-4 h-4 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                </svg>
            </div>
            <h4 class="text-sm font-semibold text-gray-900 dark:text-white">Transfer Bank</h4>
        </div>
        <div class="grid grid-cols-3 gap-2">
            <button type="button" class="p-3 border border-gray-300 dark:border-gray-600 rounded-lg hover:border-blue-600 hover:bg-blue-50 dark:hover:bg-blue-900/20 transition-colors">
                <div class="bg-blue-100 dark:bg-blue-900 p-2 rounded-full mx-auto w-fit mb-1">
                    <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M11.5 1L2 6v2h19V6m-5 4v7h3v-7M2 22h19v-3H2m8-9v7h3v-7m-9 0v7h3v-7H4z"/>
                    </svg>
                </div>
                <span class="text-xs font-medium text-gray-700 dark:text-gray-300">BCA</span>
            </button>
            
            <button type="button" class="p-3 border border-gray-300 dark:border-gray-600 rounded-lg hover:border-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors">
                <div class="bg-red-100 dark:bg-red-900 p-2 rounded-full mx-auto w-fit mb-1">
                    <svg class="w-5 h-5 text-red-600 dark:text-red-400" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M11.5 1L2 6v2h19V6m-5 4v7h3v-7M2 22h19v-3H2m8-9v7h3v-7m-9 0v7h3v-7H4z"/>
                    </svg>
                </div>
                <span class="text-xs font-medium text-gray-700 dark:text-gray-300">Mandiri</span>
            </button>
            
            <button type="button" class="p-3 border border-gray-300 dark:border-gray-600 rounded-lg hover:border-green-600 hover:bg-green-50 dark:hover:bg-green-900/20 transition-colors">
                <div class="bg-green-100 dark:bg-green-900 p-2 rounded-full mx-auto w-fit mb-1">
                    <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M11.5 1L2 6v2h19V6m-5 4v7h3v-7M2 22h19v-3H2m8-9v7h3v-7m-9 0v7h3v-7H4z"/>
                    </svg>
                </div>
                <span class="text-xs font-medium text-gray-700 dark:text-gray-300">BRI</span>
            </button>
            
            <button type="button" class="p-3 border border-gray-300 dark:border-gray-600 rounded-lg hover:border-orange-500 hover:bg-orange-50 dark:hover:bg-orange-900/20 transition-colors">
                <div class="bg-orange-100 dark:bg-orange-900 p-2 rounded-full mx-auto w-fit mb-1">
                    <svg class="w-5 h-5 text-orange-600 dark:text-orange-400" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M11.5 1L2 6v2h19V6m-5 4v7h3v-7M2 22h19v-3H2m8-9v7h3v-7m-9 0v7h3v-7H4z"/>
                    </svg>
                </div>
                <span class="text-xs font-medium text-gray-700 dark:text-gray-300">BNI</span>
            </button>
            
            <button type="button" class="p-3 border border-gray-300 dark:border-gray-600 rounded-lg hover:border-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors">
                <div class="bg-red-100 dark:bg-red-900 p-2 rounded-full mx-auto w-fit mb-1">
                    <svg class="w-5 h-5 text-red-500 dark:text-red-400" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M11.5 1L2 6v2h19V6m-5 4v7h3v-7M2 22h19v-3H2m8-9v7h3v-7m-9 0v7h3v-7H4z"/>
                    </svg>
                </div>
                <span class="text-xs font-medium text-gray-700 dark:text-gray-300">CIMB</span>
            </button>
            
            <button type="button" class="p-3 border border-gray-300 dark:border-gray-600 rounded-lg hover:border-yellow-600 hover:bg-yellow-50 dark:hover:bg-yellow-900/20 transition-colors">
                <div class="bg-yellow-100 dark:bg-yellow-900 p-2 rounded-full mx-auto w-fit mb-1">
                    <svg class="w-5 h-5 text-yellow-600 dark:text-yellow-400" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M11.5 1L2 6v2h19V6m-5 4v7h3v-7M2 22h19v-3H2m8-9v7h3v-7m-9 0v7h3v-7H4z"/>
                    </svg>
                </div>
                <span class="text-xs font-medium text-gray-700 dark:text-gray-300">Permata</span>
            </button>
        </div>
    </div>

    {{-- Other Payment Methods --}}
    <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-4">
        <div class="flex items-center gap-2 mb-3">
            <div class="bg-orange-100 dark:bg-orange-900 p-1.5 rounded">
                <svg class="w-4 h-4 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
            </div>
            <h4 class="text-sm font-semibold text-gray-900 dark:text-white">Metode Lainnya</h4>
        </div>
        <div class="grid grid-cols-4 gap-2">
            <button type="button" class="p-3 border border-gray-300 dark:border-gray-600 rounded-lg hover:border-indigo-500 hover:bg-indigo-50 dark:hover:bg-indigo-900/20 transition-colors">
                <div class="bg-indigo-100 dark:bg-indigo-900 p-2 rounded-full mx-auto w-fit mb-1">
                    <svg class="w-5 h-5 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                    </svg>
                </div>
                <span class="text-xs font-medium text-gray-700 dark:text-gray-300">Kartu Kredit</span>
            </button>
            
            <button type="button" class="p-3 border border-gray-300 dark:border-gray-600 rounded-lg hover:border-purple-500 hover:bg-purple-50 dark:hover:bg-purple-900/20 transition-colors">
                <div class="bg-purple-100 dark:bg-purple-900 p-2 rounded-full mx-auto w-fit mb-1">
                    <svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <span class="text-xs font-medium text-gray-700 dark:text-gray-300">COD</span>
            </button>
            
            <button type="button" class="p-3 border border-gray-300 dark:border-gray-600 rounded-lg hover:border-yellow-500 hover:bg-yellow-50 dark:hover:bg-yellow-900/20 transition-colors">
                <div class="bg-yellow-100 dark:bg-yellow-900 p-2 rounded-full mx-auto w-fit mb-1">
                    <svg class="w-5 h-5 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                </div>
                <span class="text-xs font-medium text-gray-700 dark:text-gray-300">Indomaret</span>
            </button>
            
            <button type="button" class="p-3 border border-gray-300 dark:border-gray-600 rounded-lg hover:border-orange-500 hover:bg-orange-50 dark:hover:bg-orange-900/20 transition-colors">
                <div class="bg-orange-100 dark:bg-orange-900 p-2 rounded-full mx-auto w-fit mb-1">
                    <svg class="w-5 h-5 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                </div>
                <span class="text-xs font-medium text-gray-700 dark:text-gray-300">Alfamart</span>
            </button>
        </div>
    </div>

    {{-- Payment Summary --}}
    <div class="bg-gradient-to-br from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 rounded-lg border-2 border-green-200 dark:border-green-700 p-4">
        <div class="flex items-center gap-2 mb-4">
            <div class="bg-green-500 p-1.5 rounded">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
            </div>
            <h4 class="text-base font-bold text-gray-900 dark:text-white">Ringkasan Pembayaran</h4>
        </div>
        
        <div class="space-y-2 mb-4">
            <div class="flex justify-between items-center py-2 border-b border-green-200 dark:border-green-700">
                <span class="text-sm text-gray-600 dark:text-gray-400">Produk</span>
                <span class="text-sm font-semibold text-gray-900 dark:text-white">{{ $record->nama_hasil }}</span>
            </div>
            <div class="flex justify-between items-center py-2 border-b border-green-200 dark:border-green-700">
                <span class="text-sm text-gray-600 dark:text-gray-400">Jumlah</span>
                <span class="text-sm font-semibold text-gray-900 dark:text-white">{{ $record->stok_ditawarkan }} kg</span>
            </div>
            <div class="flex justify-between items-center py-2 border-b border-green-200 dark:border-green-700">
                <span class="text-sm text-gray-600 dark:text-gray-400">Harga Perkiraan</span>
                <span class="text-sm font-semibold text-gray-900 dark:text-white">Rp {{ number_format(5000, 0, ',', '.') }}/kg</span>
            </div>
        </div>
        
        <div class="bg-white dark:bg-gray-800 rounded-lg p-3 border border-green-300 dark:border-green-600">
            <div class="flex justify-between items-center">
                <span class="text-base font-bold text-gray-900 dark:text-white">Total Pembayaran</span>
                <span class="text-xl font-bold text-green-600 dark:text-green-400">
                    Rp {{ number_format($record->stok_ditawarkan * 5000, 0, ',', '.') }}
                </span>
            </div>
        </div>
    </div>

    {{-- Security Info --}}
    <div class="flex items-center justify-center gap-2 text-gray-500 dark:text-gray-400 text-xs">
        <svg class="w-4 h-4 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
        </svg>
        <span>Pembayaran 100% Aman & Terenkripsi</span>
    </div>
</div>