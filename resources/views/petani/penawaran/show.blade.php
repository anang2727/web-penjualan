<x-app-layout>
    <div class="max-w-3xl mx-auto py-10 px-6">
        
        <!-- Card Penawaran -->
        <div class="bg-white rounded-2xl shadow-lg p-6 mb-6">
            <h2 class="text-2xl font-bold text-green-700">{{ $penawaran->judul }}</h2>
            <p class="text-gray-600 mt-2">{{ $penawaran->deskripsi }}</p>
        </div>

        <!-- Card Form Pengajuan -->
        <div class="bg-white rounded-2xl shadow-lg p-6">
            <h3 class="text-xl font-semibold text-gray-700 mb-4 border-b pb-2">Form Pengajuan</h3>

            <form action="{{ route('pengajuan.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf
                <input type="hidden" name="penawaran_id" value="{{ $penawaran->id }}">

                <div>
                    <label class="block text-gray-700 font-medium mb-1">Nama Hasil</label>
                    <input type="text" name="nama_hasil" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-green-500 focus:outline-none" placeholder="Masukkan nama hasil pertanian" required>
                </div>

                <div>
                    <label class="block text-gray-700 font-medium mb-1">Stok Ditawarkan</label>
                    <input type="number" name="stok_ditawarkan" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-green-500 focus:outline-none" placeholder="Jumlah stok (kg/ton)" required>
                </div>

                <div>
                    <label class="block text-gray-700 font-medium mb-1">Tanggal Panen</label>
                    <input type="date" name="tanggal_panen" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-green-500 focus:outline-none" required>
                </div>

                <div>
                    <label class="block text-gray-700 font-medium mb-1">Deskripsi</label>
                    <textarea name="deskripsi" rows="3" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-green-500 focus:outline-none" placeholder="Tambahkan keterangan tambahan..."></textarea>
                </div>

                <div>
                    <label class="block text-gray-700 font-medium mb-1">Foto (opsional)</label>
                    <input type="file" name="foto" class="w-full border border-gray-300 rounded-lg p-2 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-green-100 file:text-green-700 hover:file:bg-green-200">
                </div>

                <div>
                    <button type="submit" class="w-full bg-green-600 text-white py-3 rounded-lg text-lg font-semibold hover:bg-green-700 transition duration-300">
                        Kirim Pengajuan
                    </button>
                </div>
            </form>
        </div>

    </div>
</x-app-layout>
