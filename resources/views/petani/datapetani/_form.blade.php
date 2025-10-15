{{-- resources/views/petani/datapetani/_form.blade.php --}}

@csrf

<div class="space-y-6">

    <h3 class="text-xl font-semibold text-gray-800 border-b pb-2">1. Kontak & Alamat Logistik (Wajib)</h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        {{-- Nomor Telepon --}}
        <div>
            <x-input-label for="no_telepon" :value="__('Nomor Telepon')" />
            <x-text-input id="no_telepon" name="no_telepon" type="text" class="mt-1 block w-full" :value="old('no_telepon', $detailPetani->no_telepon ?? '')" required autofocus />
            <x-input-error class="mt-2" :messages="$errors->get('no_telepon')" />
        </div>

        {{-- Email Opsional --}}
        <div>
            <x-input-label for="email_opsional" :value="__('Email Opsional')" />
            <x-text-input id="email_opsional" name="email_opsional" type="email" class="mt-1 block w-full" :value="old('email_opsional', $detailPetani->email_opsional ?? '')" />
            <x-input-error class="mt-2" :messages="$errors->get('email_opsional')" />
        </div>
    </div>

    {{-- Alamat Lengkap --}}
    <div>
        <x-input-label for="alamat_lengkap" :value="__('Alamat Lengkap (Untuk Penjemputan COD)')" />
        <textarea
            id="alamat_lengkap"
            name="alamat_lengkap"
            rows="4"
            class="border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm mt-1 block w-full"
            required
            placeholder="Contoh: Jl. Sukamaju No. 12, Desa Cikadongdong, Kec. Leles, Kab. Garut, Jawa Barat, 44171">{{ old('alamat_lengkap', $detailPetani->alamat_lengkap ?? '') }}</textarea>
        <x-input-error class="mt-2" :messages="$errors->get('alamat_lengkap')" />
        <p class="text-xs text-gray-500 mt-1">Mohon sertakan Jalan/Gang, Desa, Kecamatan, Kab/Kota, Provinsi, dan Kodepos agar Pengepul mudah menemukan lokasi Anda.</p>
    </div>

    <h3 class="text-xl font-semibold text-gray-800 border-b pt-6 pb-2">2. Komoditas & Pembayaran (Opsional)</h3>

    {{-- Komoditas Utama --}}
    <div>
        <x-input-label for="komoditas_utama" :value="__('Komoditas Utama yang Dijual')" />
        <x-text-input id="komoditas_utama" name="komoditas_utama" type="text" class="mt-1 block w-full" :value="old('komoditas_utama', $detailPetani->komoditas_utama ?? '')" placeholder="Cth: Padi, Bawang Merah, Cabai" />
        <x-input-error class="mt-2" :messages="$errors->get('komoditas_utama')" />
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        {{-- Nama Bank (Dropdown) --}}
        <div>
            <x-input-label for="bank_nama" :value="__('Nama Bank (Untuk Transfer)')" />
            <select id="bank_nama" name="bank_nama" class="border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm mt-1 block w-full">
                <option value="">Pilih Nama Bank (Opsional)</option>

                @php
                // Daftar Bank Umum di Indonesia
                $banks = [
                'BCA' => 'Bank Central Asia (BCA)',
                'BRI' => 'Bank Rakyat Indonesia (BRI)',
                'Mandiri' => 'Bank Mandiri',
                'BNI' => 'Bank Negara Indonesia (BNI)',
                'BSI' => 'Bank Syariah Indonesia (BSI)',
                'BAS' => 'Bank Aceh Syariah (BAS)',
                ];
                $selectedBank = old('bank_nama', $detailPetani->bank_nama ?? '');
                @endphp

                @foreach($banks as $value => $label)
                <option value="{{ $value }}" @if($selectedBank==$value || $selectedBank==$label) selected @endif>
                    {{ $label }}
                </option>
                @endforeach

            </select>
            <x-input-error class="mt-2" :messages="$errors->get('bank_nama')" />
        </div>

        {{-- Nomor Rekening --}}
        <div>
            <x-input-label for="rekening_nomor" :value="__('Nomor Rekening')" />
            <x-text-input id="rekening_nomor" name="rekening_nomor" type="text" class="mt-1 block w-full" :value="old('rekening_nomor', $detailPetani->rekening_nomor ?? '')" />
            <x-input-error class="mt-2" :messages="$errors->get('rekening_nomor')" />
        </div>

        {{-- Nama Pemilik Rekening --}}
        <div>
            <x-input-label for="rekening_nama" :value="__('Nama Pemilik Rekening')" />
            <x-text-input id="rekening_nama" name="rekening_nama" type="text" class="mt-1 block w-full" :value="old('rekening_nama', $detailPetani->rekening_nama ?? '')" />
            <x-input-error class="mt-2" :messages="$errors->get('rekening_nama')" />
        </div>
    </div>
</div>

<div class="flex items-center gap-4 mt-6">
    <x-primary-button>{{ isset($detailPetani) ? __('Perbarui Profil') : __('Simpan Profil') }}</x-primary-button>
</div>