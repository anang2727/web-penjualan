<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        
        <div class="min-h-screen flex justify-center items-center py-12 bg-gray-100">
            <div class="w-full max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex bg-white shadow-2xl rounded-xl overflow-hidden">
                    
                    {{-- KIRI: Bagian Foto --}}
                    <div class="hidden lg:block w-1/2 bg-gray-200">
                        {{-- Menggunakan URL online Anda --}}
                        <img src="https://images.pexels.com/photos/29639325/pexels-photo-29639325.jpeg" 
                            alt="Background Makanan Segar"
                            class="w-full h-full object-cover">
                    </div>

                    {{-- KANAN: Bagian Form --}}
                    <div class="w-full lg:w-1/2 p-6 sm:p-10 flex flex-col justify-center">

                        {{-- Bagian Logo DIHAPUS (sebelumnya ada div dengan x-application-logo) --}}
                        {{-- <div class="mb-6 flex justify-center lg:justify-start">...</div> --}}
                        
                        {{-- SLOT FORM --}}
                        <div class="w-full">
                            {{ $slot }}
                        </div>

                    </div>
                    
                </div>
            </div>
        </div>
    </body>
</html>