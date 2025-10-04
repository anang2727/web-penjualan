<x-app-layout>
    <div class="container mx-auto py-6 px-4">
        {{-- Margin (mb-6) di sini SANGAT MUNGKIN sudah berfungsi karena layout induk sudah benar. --}}
        <h2 class="text-2xl font-bold mb-6 flex items-center gap-2 text-gray-800">
            📦 Pengajuan Saya
        </h2>

        @if($pengajuans->count() > 0)
        {{-- Border dan Shadow diubah dari 700/gelap menjadi 300/terang --}}
        <div class="overflow-x-auto rounded-lg shadow-lg border border-gray-300">
            <table class="w-full border-collapse text-sm">
                {{-- Thead diberi latar belakang terang (bg-gray-200) agar teks hitam (text-gray-800) terlihat --}}
                <thead class="bg-gray-200 text-gray-800">
                    <tr>
                        {{-- Border diubah dari 700/gelap menjadi 300/terang --}}
                        <th class="px-4 py-3 border border-gray-300 text-left">Foto</th>
                        <th class="px-4 py-3 border border-gray-300 text-left">Nama Hasil</th>
                        <th class="px-4 py-3 border border-gray-300 text-left">Stok</th>
                        <th class="px-4 py-3 border border-gray-300 text-left">Tanggal Panen</th>
                        <th class="px-4 py-3 border border-gray-300 text-left">Untuk Penawaran</th>
                        <th class="px-4 py-3 border border-gray-300 text-center">Status</th>
                    </tr>
                </thead>
                {{-- Background tbody diubah dari 900/gelap menjadi white/terang --}}
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($pengajuans as $pengajuan)
                    {{-- Hover diubah dari 800/gelap menjadi 50/terang --}}
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-4 py-3 border border-gray-300">
                            @if($pengajuan->foto)
                            <img src="{{ asset('storage/'.$pengajuan->foto) }}"
                                alt="Foto {{ $pengajuan->nama_hasil }}"
                                {{-- Border diubah dari 600/gelap menjadi 300/terang --}}
                                class="w-16 h-16 object-cover rounded-md border border-gray-300">
                            @else
                            <img src="https://via.placeholder.com/100x100?text=No+Foto"
                                class="w-16 h-16 object-cover rounded-md border border-gray-300">
                            @endif
                        </td>
                        {{-- Warna teks diubah dari white/terang menjadi 900/gelap --}}
                        <td class="px-4 py-3 border border-gray-300 font-medium text-gray-900">
                            {{ $pengajuan->nama_hasil }}
                        </td>
                        {{-- Warna teks diubah dari 300/terang menjadi 600/gelap --}}
                        <td class="px-4 py-3 border border-gray-300 text-gray-600">
                            {{ $pengajuan->stok_ditawarkan }}
                        </td>
                        {{-- Warna teks diubah dari 300/terang menjadi 600/gelap --}}
                        <td class="px-4 py-3 border border-gray-300 text-gray-600">
                            {{ $pengajuan->tanggal_panen->format('d M Y') }}
                        </td>
                        {{-- Warna teks diubah dari 300/terang menjadi 600/gelap --}}
                        <td class="px-4 py-3 border border-gray-300 text-gray-600">
                            {{ $pengajuan->penawaran->judul }}
                        </td>
                        <td class="px-4 py-3 border border-gray-300 text-center">
                            {{-- Warna Border dan Text dalam badge dipertahankan (kecuali jika bertentangan) --}}
                            @if($pengajuan->status === 'diterima')
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold text-white shadow
                                bg-green-500 border border-green-700
                                md:px-3 md:py-1.5 md:text-sm
                                ">
                                ✅ <span class="ml-1 hidden sm:inline">Diterima</span>
                            </span>
                            @elseif($pengajuan->status === 'ditolak')
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold text-white shadow
                                bg-red-500 border border-red-700
                                md:px-3 md:py-1.5 md:text-sm
                                ">
                                ❌ <span class="ml-1 hidden sm:inline">Ditolak</span>
                            </span>
                            @else
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold text-black shadow
                                bg-yellow-400 border border-yellow-700
                                md:px-3 md:py-1.5 md:text-sm
                                ">
                                ⏳ <span class="ml-1 hidden sm:inline">Menunggu</span>
                            </span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        {{-- Background diubah dari 800/gelap menjadi 50/terang --}}
        <div class="bg-gray-50 p-6 rounded-lg text-center text-gray-600 border border-gray-300">
            Anda belum pernah mengajukan penawaran.
        </div>
        @endif
    </div>
</x-app-layout>