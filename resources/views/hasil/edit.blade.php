<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Hasil Pertanian') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <form action="{{ route('hasil.update', $hasil) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label class="block text-sm font-medium">Nama Hasil</label>
                            <input type="text" name="nama_hasil" value="{{ old('nama_hasil', $hasil->nama_hasil) }}" 
                                class="w-full border rounded px-3 py-2" required>
                            @error('nama_hasil') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium">Stok</label>
                            <input type="number" name="stok" value="{{ old('stok', $hasil->stok) }}" 
                                class="w-full border rounded px-3 py-2" required>
                            @error('stok') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium">Tanggal Panen</label>
                            <input type="date" name="tanggal_panen" value="{{ old('tanggal_panen', $hasil->tanggal_panen) }}" 
                                class="w-full border rounded px-3 py-2">
                            @error('tanggal_panen') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium">Deskripsi</label>
                            <textarea name="deskripsi" rows="4" class="w-full border rounded px-3 py-2">{{ old('deskripsi', $hasil->deskripsi) }}</textarea>
                            @error('deskripsi') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium">Foto</label>
                            @if($hasil->foto)
                                <img src="{{ asset('storage/' . $hasil->foto) }}" alt="Foto" class="w-32 h-32 mb-2">
                            @endif
                            <input type="file" name="foto" class="w-full">
                            @error('foto') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                        </div>

                        <div class="flex justify-end">
                            <a href="{{ route('hasil.index') }}" 
                               class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600 me-2">
                                Batal
                            </a>
                            <button type="submit" 
                                    class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                                Update
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
