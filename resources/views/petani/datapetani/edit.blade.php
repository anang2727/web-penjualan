<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Profil Petani') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <h3 class="text-lg font-medium text-gray-900 mb-4">Perbarui Profil Anda</h3>
                <p class="mt-1 text-sm text-gray-600 mb-6">
                    Pastikan nomor telepon dan lokasi Anda sudah akurat.
                </p>

                <form method="post" action="{{ route('petani.datapetani.update', $detailPetani) }}" class="mt-6 space-y-6">
                    @method('patch')
                    @include('petani.datapetani._form')
                </form>
                
            </div>
        </div>
    </div>
</x-app-layout>