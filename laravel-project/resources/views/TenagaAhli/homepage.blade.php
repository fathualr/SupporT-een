@extends('layouts.main')

@section('aside')

<div class="flex flex-col px-4 mx-auto w-full h-full justify-center items-center lg:px-8 xl:px-4 xl:mb-[50px]">
    <img src="{{ asset('images/main-picture.svg') }} " class="size-64 lg:size-96" alt="">
    <div class="card bg-color-6 border border-color-5 text-color-9 mx-auto rounded-3xl max-w-96 md:max-w-[29.688rem] md:min-h-[12.5rem]">
        <div class="card-body">
            <p class="font-bold text-xl md:text-2xl lg:text-xl xl:text-2xl">Berbagi, Mendukung, Berkembang.</p>
            <p class="text-justify text-color-4 md:text-base lg:text-sm xl:text-base">Bersama, kita hadapi tantangan dan jaga kesehatan mental. Setiap langkah kecil membawa kita menuju masa depan yang lebih cerah!</p>
        </div>
    </div>
</div>

@endsection

@section('main')

<!-- offcanvas -->
<div 
        id="hs-offcanvas-example" 
        class="hs-overlay hidden fixed inset-y-0 left-0 transform -translate-x-full transition-all duration-500 ease-in-out z-[80] bg-white shadow-lg max-w-sm w-full lg:hidden" 
        role="dialog" 
        tabindex="-1" 
        aria-labelledby="hs-offcanvas-example-label">
        
        <!-- Header Offcanvas -->
        <div class="flex justify-between items-center py-3 px-4 border-b">
            <!-- logo -->
            <a href="{{ Auth::check() && Auth::user()->role === 'tenaga ahli' ? '/tenaga-ahli' : '/' }}" class="flex flex-row items-center">
                <img class="size-[1.875rem] me-0.5 md:size-12 xl:size-[3.125rem] md:me-2 xl:me-[0.938rem]" src=" {{ asset('images/logo-dark-blue.svg') }} " alt="SupporT-een Logo">
                <span class="my-auto text-xs md:text-2xl xl:text-[2rem]">SupporT-een</span>
            </a>

            <!-- tombol close -->
            <button 
                type="button" 
                class="inline-flex justify-center items-center rounded-full border bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-none focus:bg-gray-200" 
                aria-label="Close" 
                data-hs-overlay="#hs-offcanvas-example">
                <span class="sr-only">Close</span>
                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 6 6 18M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <!-- Content Offcanvas -->
        <div class="p-4">
            <div class="max-w-20 border-s-2 border-gray-200">
                <nav class="-ml-0.5 flex flex-col space-y-3">
                    <a class="py-1 ps-4 inline-flex items-center gap-2 border-s-2 border-transparent hover:border-cyan-500 focus:border-cyan-500 text-sm whitespace-nowrap text-gray-500 hover:text-color-3 focus:outline-none focus:text-color-3" 
                    href="/tenaga-ahli/kelola-konten-edukatif">
                    Kelola Konten Edukatif
                    </a>
                    <a class="py-1 ps-4 inline-flex items-center gap-2 border-s-2 border-transparent hover:border-cyan-500 focus:border-cyan-500 text-sm whitespace-nowrap text-gray-500 hover:text-color-3 focus:outline-none focus:text-color-3" 
                    href="/tenaga-ahli/percakapan-konsultasi">
                    Manajemen Konsultasi
                    </a>
                    <a class="py-1 ps-4 inline-flex items-center gap-2 border-s-2 border-transparent hover:border-cyan-500 focus:border-cyan-500 text-sm whitespace-nowrap text-gray-500 hover:text-color-3 focus:outline-none focus:text-color-3" 
                    href="/tenaga-ahli/pendapatan">
                    Pendapatan
                    </a>
                </nav>
            </div>
        </div>
        <!-- End Content Offcanvas -->
    </div>
    <!-- End Offcanvas -->

    <div class="flex flex-wrap gap-3 w-full md:max-w-2xl lg:max-w-none xl:max-w-5xl justify-content-center justify-center text-center">
        <div>
            <a href="/tenaga-ahli/kelola-konten-edukatif" class="flex flex-col justify-center items-center bg-color-8 border border-color-4 rounded-xl size-36 sm:size-44 xl:size-56">
                <img class="size-24 xl:size-[9.375rem]" src="{{ asset('icons/content-media-folder.svg') }}" alt="">
                <p class="font-semibold xl:text-base">Kelola Konten Edukatif</p>
            </a>
        </div>
        <div>
            <a href="/tenaga-ahli/percakapan-konsultasi" class="flex flex-col justify-center items-center bg-color-8 border border-color-4 rounded-xl size-36 sm:size-44 xl:size-56">
                <img class="size-24 xl:size-[9.375rem]" src="{{ asset('icons/Manajemen-konsultasi.png') }}" alt="">
                <p class="font-semibold xl:text-base">Manajemen Konsultasi</p>
            </a>
        </div>
        <div>
            <a href="/tenaga-ahli/pendapatan" class="flex flex-col justify-center items-center bg-color-8 border border-color-4 rounded-xl size-36 sm:size-44 xl:size-56">
                <img class="size-24 xl:size-[9.375rem]" src="{{ asset('icons/tabungan.png') }}" alt="">
                <p class="font-semibold xl:text-base">Pendapatan</p>
            </a>
        </div>
    </div>

@endsection