@extends('layouts.main')

@section('aside')

    <div class="flex flex-col mx-auto items-center w-full h-auto mt-9 px-8 gap-6">
        <h1 class="text-2xl xl:text-4xl font-bold text-color-1 w-full">Kelola Konten Edukatif</h1>

        <a href="{{ route('kelola-konten-edukatif.create') }}" class="btn w-full flex justify-start bg-color-6 hover:bg-color-5 hover:border-color-3 text-base">
            <img src="{{ asset('icons/Plus.svg') }}" alt="">
            Buat Konten
        </a>

        <div class="divider m-0"></div>

        <div class="flex flex-col w-full h-full gap-4">

            @include('TenagaAhli.Components.card_list')

            <div class="divider m-0"></div>

            <div class="mb-3 flex justify-center">
                <!-- Pagination container -->
                <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px">
                    <!-- Previous Page Button -->
                    @if ($kontenList->onFirstPage())
                        <span class="inline-flex items-center px-4 py-2 text-sm font-medium text-color-2 bg-color-6 border border-color-4 cursor-not-allowed">
                            Previous
                        </span>
                    @else
                        <a href="{{ $kontenList->previousPageUrl() . (request()->search ? '&search=' . request()->search : '') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-color-3 bg-color-6 border border-color-4 rounded-l-md hover:bg-color-5">
                            Previous
                        </a>
                    @endif
            
                    <!-- Page Numbers -->
                    @foreach ($kontenList->links()->elements[0] as $page => $url)
                        <a href="{{ $url . (request()->search ? '&search=' . request()->search : '') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium 
                            {{ $page == $kontenList->currentPage() ? 'text-color-1 bg-color-3 border-color-3' : 'text-color-2 bg-color-6 border-color-4 hover:bg-color-5' }} border">
                            {{ $page }}
                        </a>
                    @endforeach
            
                    <!-- Next Page Button -->
                    @if ($kontenList->hasMorePages())
                        <a href="{{ $kontenList->nextPageUrl() . (request()->search ? '&search=' . request()->search : '') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-color-3 bg-color-6 border border-color-4 rounded-r-md hover:bg-color-5">
                            Next
                        </a>
                    @else
                        <span class="inline-flex items-center px-4 py-2 text-sm font-medium text-color-2 bg-color-6 border border-color-4 cursor-not-allowed">
                            Next
                        </span>
                    @endif
                </nav>
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

        <div class="flex flex-col mx-auto items-center w-full h-fit gap-6">
            <h1 class="text-2xl xl:text-4xl font-bold text-color-1 w-full">Kelola Konten Edukatif</h1>

            <a href="{{ route('kelola-konten-edukatif.create') }}" class="btn w-full flex justify-start bg-color-6 hover:bg-color-5 hover:border-color-3 text-base">
                <img src="{{ asset('icons/Plus.svg') }}" alt="">
                Buat Konten
            </a>

            <div class="divider m-0"></div>

            <div class="flex flex-col w-full h-full gap-4 max-h-[calc(100vh-200px)] overflow-y-auto overflow-x-hidden">

                @include('TenagaAhli.Components.card_list')
    
                <div class="divider m-0"></div>
    
                <div class="mb-3 flex justify-center">
                    <!-- Pagination container -->
                    <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px">
                        <!-- Previous Page Button -->
                        @if ($kontenList->onFirstPage())
                            <span class="inline-flex items-center px-4 py-2 text-sm font-medium text-color-2 bg-color-6 border border-color-4 cursor-not-allowed">
                                Previous
                            </span>
                        @else
                            <a href="{{ $kontenList->previousPageUrl() . (request()->search ? '&search=' . request()->search : '') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-color-3 bg-color-6 border border-color-4 rounded-l-md hover:bg-color-5">
                                Previous
                            </a>
                        @endif
                
                        <!-- Page Numbers -->
                        @foreach ($kontenList->links()->elements[0] as $page => $url)
                            <a href="{{ $url . (request()->search ? '&search=' . request()->search : '') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium 
                                {{ $page == $kontenList->currentPage() ? 'text-color-1 bg-color-3 border-color-3' : 'text-color-2 bg-color-6 border-color-4 hover:bg-color-5' }} border">
                                {{ $page }}
                            </a>
                        @endforeach
                
                        <!-- Next Page Button -->
                        @if ($kontenList->hasMorePages())
                            <a href="{{ $kontenList->nextPageUrl() . (request()->search ? '&search=' . request()->search : '') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-color-3 bg-color-6 border border-color-4 rounded-r-md hover:bg-color-5">
                                Next
                            </a>
                        @else
                            <span class="inline-flex items-center px-4 py-2 text-sm font-medium text-color-2 bg-color-6 border border-color-4 cursor-not-allowed">
                                Next
                            </span>
                        @endif
                    </nav>
                </div>        
                
            </div>

    </div>

        </div>
        <!-- End Content Offcanvas -->
    </div>
    <!-- End Offcanvas -->

    <!-- view konten edukatif -->
    <div class="flex flex-col w-full h-full">
        @if ($selectedKonten)

            @if ($selectedKonten->tipe === 'artikel')
            
                <a href="{{ route('kelola-konten-edukatif.index') }}" class="btn btn-sm mb-3 bg-color-4 text-color-putih hover:bg-color-2 border-0 w-fit">
                    <img class="w-6 h-6" src="{{ asset("icons/back.svg")}}" alt="">
                    Kembali
                </a>
                
                <!-- card artikel -->
                <div class="bg-color-8 p-8 border-[1px] border-color-4 rounded-2xl">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <img class="size-12 rounded-full mr-4" src="{{ $selectedKonten->user->foto_profil ? asset('storage/' . $selectedKonten->user->foto_profil) : asset('images/dummy.png') }}" alt="Album" />
                            <div class="flex flex-col">
                                <span class="text-base text-color-1 font-semibold">{{ $selectedKonten->user->nama }}</span>
                                <span class="text-color-2 text-base">{{ $selectedKonten->user->role }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col gap-1.5 md:gap-2">
                        <h1 class="text-base md:text-2xl xl:text-3xl font-bold text-color-1 mt-4">{{ $selectedKonten->judul }}</h1>
                        <span class="text-color-2 text-sm md:text-base text-center">{{ \Carbon\Carbon::parse($selectedKonten->created_at)->format('d F Y, H:i:s') }}</span>
                        <img class="rounded-2xl object-cover" src="{{ asset('storage/' . $selectedKonten->thumbnail) }}" alt="ilustrasi artikel">
                        <p class="text-color-1 text-justify text-xs lg:text-base md:text-base">
                            {{ $selectedKonten->isi_artikel }}
                        </p>
                    </div>
                </div>

            @elseif ($selectedKonten->tipe === 'video')
            
                <a href="{{ route('kelola-konten-edukatif.index') }}" class="btn btn-sm mb-3 bg-color-4 text-color-putih hover:bg-color-2 border-0 w-fit">
                    <img class="w-6 h-6" src="{{ asset("icons/back.svg")}}" alt="">
                    Kembali
                </a>

                <div class="bg-color-8 p-8 border-[1px] border-color-4 rounded-2xl">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <img class="size-12 rounded-full mr-4" src="{{ $selectedKonten->user->foto_profil ? asset('storage/' . $selectedKonten->user->foto_profil) : asset('images/dummy.png') }}" alt="Album" />
                            <div class="flex flex-col">
                                <span class="text-base text-color-1 font-semibold">{{ $selectedKonten->user->nama }}</span>
                                <span class="text-color-2 text-base">{{ $selectedKonten->user->role }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col gap-1.5 md:gap-2">
                        <h1 class="text-base md:text-2xl xl:text-3xl font-bold text-color-1 mt-4">{{ $selectedKonten->judul }}</h1>
                        <span class="text-color-2 text-sm md:text-base text-center">{{ \Carbon\Carbon::parse($selectedKonten->created_at)->format('d F Y, H:i:s') }}</span>
                        <iframe class="w-full aspect-video rounded-lg shadow-lg" src="{!! empty($selectedKonten->link_youtube) ? 'https://www.youtube.com/embed/' : $selectedKonten->link_youtube !!}"></iframe>
                    </div>
                </div>

            @endif
        @else
        
            <a href="/tenaga-ahli" class="btn btn-sm mb-3 bg-color-4 text-color-putih hover:bg-color-2 border-0 w-fit">
                <img class="w-6 h-6" src="{{ asset("icons/back.svg")}}" alt="">
                Kembali
            </a>

            <!-- Default Message When No Content Selected -->
            <div class="bg-color-8 h-full p-8 border-[1px] border-color-4 rounded-2xl">
                <div class="flex justify-center items-center w-full h-full">
                    Tidak ada konten yang dipilih.
                </div>
            </div>
        @endif
    </div>
    <!-- End View konten edukatif -->
@endsection