<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lengkapi Profil Pedagang') }} 🛒
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form method="POST" action="{{ route('dashboard.pedagang.store') }}">
                    @csrf
                    
                    <h3 class="text-lg font-medium text-gray-900 mb-4 border-b pb-2">Informasi Kontak</h3>
                    
                    <div>
                        <x-input-label for="no_telepon" :value="__('Nomor Telepon')" />
                        <x-text-input id="no_telepon" name="no_telepon" type="text" class="mt-1 block w-full" :value="old('no_telepon')" required autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('no_telepon')" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="alamat_lengkap" :value="__('Alamat Pengiriman Lengkap')" />
                        <textarea id="alamat_lengkap" name="alamat_lengkap" class="border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm mt-1 block w-full" rows="3" required>{{ old('alamat_lengkap') }}</textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('alamat_lengkap')" />
                    </div>

                    <h3 class="text-lg font-medium text-gray-900 mt-8 mb-4 border-b pb-2">Data Pembayaran (Penerima)</h3>
                    
                    <div class="mt-4">
                        <x-input-label for="bank_nama" :value="__('Nama Bank')" />
                        <x-text-input id="bank_nama" name="bank_nama" type="text" class="mt-1 block w-full" :value="old('bank_nama')" />
                        <x-input-error class="mt-2" :messages="$errors->get('bank_nama')" />
                    </div>
                    
                    <div class="mt-4">
                        <x-input-label for="rekening_nomor" :value="__('Nomor Rekening')" />
                        <x-text-input id="rekening_nomor" name="rekening_nomor" type="text" class="mt-1 block w-full" :value="old('rekening_nomor')" />
                        <x-input-error class="mt-2" :messages="$errors->get('rekening_nomor')" />
                    </div>
                    
                    <div class="mt-4">
                        <x-input-label for="rekening_nama" :value="__('Nama Pemilik Rekening')" />
                        <x-text-input id="rekening_nama" name="rekening_nama" type="text" class="mt-1 block w-full" :value="old('rekening_nama')" />
                        <x-input-error class="mt-2" :messages="$errors->get('rekening_nama')" />
                    </div>

                    <div class="flex items-center justify-end mt-6">
                        <x-primary-button>
                            {{ __('Simpan Profil') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>