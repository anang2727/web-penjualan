<x-app-layout>
    <div class="max-w-3xl mx-auto py-10 px-6">

        <div class="bg-white rounded-2xl shadow-lg p-6 mb-6">
            <h2 class="text-2xl font-bold text-green-700">{{ $penawaran->judul }}</h2>
            <p class="text-gray-600 mt-2">{{ $penawaran->deskripsi }}</p>

            <div class="mt-6">
                @php
                $terkumpul = $penawaran->jumlah_target - $penawaran->jumlah_kebutuhan;
                $persen = ($penawaran->jumlah_target > 0) ? ($terkumpul / $penawaran->jumlah_target) * 100 : 0;
                @endphp

                <div class="flex justify-between items-end mb-2">
                    <span class="text-sm font-medium text-gray-700">Progres Kebutuhan</span>
                    <span class="text-sm font-bold text-green-700">
                        {{ number_format($terkumpul, 0, ',', '.') }} / {{ number_format($penawaran->jumlah_target, 0, ',', '.') }} Kg
                    </span>
                </div>

                <div class="w-full bg-gray-200 rounded-full h-4">
                    <div class="bg-green-600 h-4 rounded-full transition-all duration-500" style="width: {{ $persen }}%"></div>
                </div>

                <p class="text-xs text-gray-500 mt-2 italic">
                    *Sisa kuota yang masih dibutuhkan: <strong>{{ number_format($penawaran->jumlah_kebutuhan, 0, ',', '.') }} Kg</strong>
                </p>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-lg p-6">
            <h3 class="text-xl font-semibold text-gray-700 mb-4 border-b pb-2">Form Pengajuan</h3>

            @if($penawaran->jumlah_kebutuhan > 0)
            <form action="{{ route('pengajuan.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf
                <input type="hidden" name="penawaran_id" value="{{ $penawaran->id }}">

                <div>
                    <label class="block text-gray-700 font-medium mb-1">Nama Hasil</label>
                    <input type="text" name="nama_hasil"
                        value="{{ $penawaran->judul }}"
                        class="w-full border border-gray-200 bg-gray-100 text-gray-500 rounded-lg p-2 cursor-not-allowed"
                        readonly>
                </div>

                <div>
                    <label class="block text-gray-700 font-medium mb-1">Stok Ditawarkan (Kg)</label>
                    <input type="number" name="stok_ditawarkan"
                        min="1"
                        max="{{ $penawaran->jumlah_kebutuhan }}"
                        class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-green-500 focus:outline-none"
                        placeholder="Maksimal input: {{ $penawaran->jumlah_kebutuhan }} kg"
                        required>
                    <p class="text-xs text-gray-500 mt-1 italic">*Anda tidak dapat menawarkan lebih dari sisa kebutuhan pengepul.</p>
                </div>

                <div>
                    <label class="block text-gray-700 font-medium mb-1">Tanggal Panen</label>
                    <input type="date" name="tanggal_panen" class="w-full border border-gray-300 rounded-lg p-2 required">
                </div>

                <div>
                    <label class="block text-gray-700 font-medium mb-1">Deskripsi</label>
                    <textarea name="deskripsi" rows="3" class="w-full border border-gray-300 rounded-lg p-2"></textarea>
                </div>

                <div>
                    <label class="block text-gray-700 font-medium mb-1">Foto</label>
                    <input type="file" name="foto" class="w-full border border-gray-300 rounded-lg p-2">
                </div>

                <button type="submit" class="w-full bg-green-600 text-white py-3 rounded-lg text-lg font-semibold hover:bg-green-700 transition">
                    Kirim Pengajuan
                </button>
            </form>
            @else
            <div class="text-center py-10 text-gray-500">
                <p>Maaf, penawaran ini sudah memenuhi kuota atau telah ditutup.</p>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>