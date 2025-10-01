<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Daftar Hasil Pertanian') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a href="{{ route('hasil.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                        + Tambah
                    </a>

                    @if(session('success'))
                    <p style="color:green;">{{ session('success') }}</p>
                    @endif

                    <table class="w-full mt-5 border-collapse border border-gray-300">
                        <thead class="bg-gray-100 dark:bg-gray-700">
                            <tr>
                                <th class="border px-4 py-2">No</th>
                                <th class="border px-4 py-2">Nama Hasil</th>
                                <th class="border px-4 py-2">Stok</th>
                                <th class="border px-4 py-2">Tanggal Panen</th>
                                <th class="border px-4 py-2">Foto</th>
                                <th class="border px-4 py-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($hasil as $index => $item)
                            <tr>
                                <td class="border px-4 py-2">{{ $index + 1 }}</td>
                                <td class="border px-4 py-2">{{ $item->nama_hasil }}</td>
                                <td class="border px-4 py-2">{{ $item->stok }}</td>
                                <td class="border px-4 py-2">{{ $item->tanggal_panen }}</td>
                                <td class="border px-4 py-2">
                                    @if ($item->foto)
                                    <img src="{{ asset('storage/' . $item->foto) }}"
                                        alt="Foto {{ $item->nama_hasil }}"
                                        class="w-16 h-16 object-cover rounded">
                                    @else
                                    <span class="text-gray-500">Tidak ada</span>
                                    @endif
                                </td>
                                <td class="border px-4 py-2 space-x-2">
                                    <a href="{{ route('hasil.edit', $item) }}"
                                        class="px-3 py-1 bg-green-600 text-white rounded hover:bg-green-700">
                                        Edit
                                    </a>
                                    <form action="{{ route('hasil.destroy', $item) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            onclick="return confirm('Yakin ingin menghapus data ini?')"
                                            class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-3">Belum ada data hasil pertanian.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>