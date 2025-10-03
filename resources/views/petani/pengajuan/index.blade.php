<x-app-layout>
    <div class="container mx-auto py-6 px-4">
        <h2 class="text-2xl font-bold mb-6 flex items-center gap-2">
            📦 Pengajuan Saya
        </h2>

        @if($pengajuans->count() > 0)
        <div class="overflow-x-auto rounded-lg shadow-lg border border-gray-700">
            <table class="w-full border-collapse text-sm">
                <thead class="bg-gray-800 text-gray-200">
                    <tr>
                        <th class="px-4 py-3 border border-gray-700 text-left">Foto</th>
                        <th class="px-4 py-3 border border-gray-700 text-left">Nama Hasil</th>
                        <th class="px-4 py-3 border border-gray-700 text-left">Stok</th>
                        <th class="px-4 py-3 border border-gray-700 text-left">Tanggal Panen</th>
                        <th class="px-4 py-3 border border-gray-700 text-left">Untuk Penawaran</th>
                        <th class="px-4 py-3 border border-gray-700 text-center">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-gray-900 divide-y divide-gray-700">
                    @foreach($pengajuans as $pengajuan)
                    <tr class="hover:bg-gray-800 transition">
                        <td class="px-4 py-3 border border-gray-700">
                            @if($pengajuan->foto)
                            <img src="{{ asset('storage/'.$pengajuan->foto) }}"
                                alt="Foto {{ $pengajuan->nama_hasil }}"
                                class="w-16 h-16 object-cover rounded-md border border-gray-600">
                            @else
                            <img src="https://via.placeholder.com/100x100?text=No+Foto"
                                class="w-16 h-16 object-cover rounded-md border border-gray-600">
                            @endif
                        </td>
                        <td class="px-4 py-3 border border-gray-700 font-medium text-white">
                            {{ $pengajuan->nama_hasil }}
                        </td>
                        <td class="px-4 py-3 border border-gray-700 text-gray-300">
                            {{ $pengajuan->stok_ditawarkan }}
                        </td>
                        <td class="px-4 py-3 border border-gray-700 text-gray-300">
                            {{ $pengajuan->tanggal_panen->format('d M Y') }}
                        </td>
                        <td class="px-4 py-3 border border-gray-700 text-gray-300">
                            {{ $pengajuan->penawaran->judul }}
                        </td>
                        <td class="px-4 py-3 border border-gray-700 text-center">
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
        <div class="bg-gray-800 p-6 rounded-lg text-center text-gray-300 border border-gray-700">
            Anda belum pernah mengajukan penawaran.
        </div>
        @endif
    </div>
</x-app-layout>