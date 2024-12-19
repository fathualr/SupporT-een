@extends('layouts.main')

@section('aside')

    <div class="flex flex-col mx-auto items-center w-full h-auto mt-9 px-8 gap-6">
        <h1 class="text-2xl xl:text-4xl font-bold text-color-1 w-full">Konten Edukatif</h1>

        <!-- Search Bar with Clear Button (X) -->
        <form method="GET" action="{{ route('kontenEdukatif') }}" class="w-full">
            <label class="input flex items-center gap-2 w-full bg-color-6 py-4 outline-color-3 rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="h-5 w-5 opacity-70 text-color-2">
                    <path fill-rule="evenodd" d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z" clip-rule="evenodd" />
                </svg>
                <input type="text" name="search" autocomplete="off" value="{{ request()->search }}" class="grow text-color-2" placeholder="Cari berdasarkan judul, tipe, nama pengguna, atau kata kunci" />
                
                <!-- Clear Search Button (X) -->
                @if(request()->search)
                    <a href="{{ route('kontenEdukatif') }}" class="ml-2 text-color-2 hover:text-color-3">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="h-5 w-5">
                            <path fill-rule="evenodd" d="M11.3 4.7a1 1 0 0 0-1.4 0L8 6.6 5.1 3.7a1 1 0 0 0-1.4 1.4L6.6 8 3.7 10.9a1 1 0 0 0 1.4 1.4L8 9.4l2.9 2.9a1 1 0 0 0 1.4-1.4L9.4 8l2.9-2.9a1 1 0 0 0 0-1.4z" clip-rule="evenodd"/>
                        </svg>
                    </a>
                @endif
            </label>
        </form>

        <div class="flex flex-col w-full h-full gap-4">
            <div class="divider m-0"></div>

            @foreach($kontenList as $item)
                <a href="{{ route('kontenEdukatif', ['id' => $item->id] + request()->all()) }}" class="flex border-[1px] border-color-4 rounded-2xl p-4 gap-2">
                    <div class="flex-none">
                        <img class="size-20 xl:size-[6.25rem] object-cover rounded-xl" src="{{ asset('storage/' . $item->thumbnail) }}" alt="Thumbnail" />
                    </div>
                    <div class="flex flex-col w-full">
                        <!-- tipe -->
                        <span class="text-color-2 text-xs xl:text-sm">{{ ucfirst($item->tipe) }}</span>
                        <!-- judul -->
                        <h1 class="text-sm xl:text-xl font-bold text-ellipsis line-clamp-2">{{ $item->judul }}</h1>
                        
                        <div class="flex justify-between items-center mt-auto text-xs xl:text-sm">
                            <div class="flex items-center max-w-full">
                                <!-- profile -->
                                <img class="size-5 rounded-full" src="{{ $item->user->foto_profil ? asset('storage/' . $item->user->foto_profil) : asset('images/dummy.png') }}" alt="Album" />
                                <span class="truncate ml-2 overflow-hidden text-ellipsis max-w-16 xl:max-w-32">{{ $item->user->nama }}</span>
                            </div>
                            <span class="whitespace-nowrap ml-4">{{ \Carbon\Carbon::parse($item->created_at)->format('d F Y') }}</span>
                        </div>
                    </div>
                </a>
            @endforeach

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
        <h1 class="text-2xl xl:text-4xl font-bold text-color-1 w-full">Konten Edukatif</h1>

            <!-- Search Bar with Clear Button (X) -->
            <form method="GET" action="{{ route('kontenEdukatif') }}" class="w-full">
                <label class="input flex items-center gap-2 w-full bg-color-6 py-4 outline-color-3 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-5 opacity-70 text-color-2">
                        <path fill-rule="evenodd" d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z" clip-rule="evenodd" />
                    </svg>
                    <input type="text" name="search" autocomplete="off" value="{{ request()->search }}" class="grow text-color-2" placeholder="Cari berdasarkan judul, tipe, nama pengguna, atau kata kunci" />
                    
                    <!-- Clear Search Button (X) -->
                    @if(request()->search)
                        <a href="{{ route('kontenEdukatif') }}" class="ml-2 text-color-2 hover:text-color-3">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="h-5 w-5">
                                <path fill-rule="evenodd" d="M11.3 4.7a1 1 0 0 0-1.4 0L8 6.6 5.1 3.7a1 1 0 0 0-1.4 1.4L6.6 8 3.7 10.9a1 1 0 0 0 1.4 1.4L8 9.4l2.9 2.9a1 1 0 0 0 1.4-1.4L9.4 8l2.9-2.9a1 1 0 0 0 0-1.4z" clip-rule="evenodd"/>
                            </svg>
                        </a>
                    @endif
                </label>
            </form>
            
            <div class="divider m-0"></div>

            <div class="flex flex-col w-full h-full gap-4 max-h-[calc(100vh-270px)] overflow-y-auto overflow-x-hidden">
    
                @foreach($kontenList as $item)
                    <a href="{{ route('kontenEdukatif', ['id' => $item->id] + request()->all()) }}" class="flex border-[1px] border-color-4 rounded-2xl p-2 gap-2">

                        <!-- thumbnail -->
                        <div class="flex-none">
                            <img class="size-[6.25rem] object-cover rounded-xl" src="{{ asset('storage/' . $item->thumbnail) }}" alt="Thumbnail" />
                        </div>

                        <div class="flex flex-col w-full">
                            <!-- tipe -->
                            <span class="text-color-2 text-sm lg:text-base">{{ ucfirst($item->tipe) }}</span>

                            <!-- title -->
                            <h1 class="text-base lg:text-xl font-bold overflow-hidden text-ellipsis whitespace-normal line-clamp-2">{{ $item->judul }}</h1>
                            
                            <div class="flex justify-between items-center mt-auto">
                                <!-- profile -->
                                <div class="flex items-center w-full text-xs lg:text-base">
                                    <img class="size-5 rounded-full" src="{{ $item->user->foto_profil ? asset('storage/' . $item->user->foto_profil) : asset('images/dummy.png') }}" alt="Album" />
                                    <span class="truncate ml-2 overflow-hidden text-ellipsis whitespace-nowrap max-w-14">{{ $item->user->nama }}</span>
                                </div>

                                <!-- tanggal -->
                                <span class="whitespace-nowrap ml-4 text-xs lg:text-base">{{ \Carbon\Carbon::parse($item->created_at)->format('d F Y') }}</span>
                            </div>
                        </div>
                    </a>
                @endforeach
    
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
            
                <a href="/konten-edukatif" class="btn btn-sm mb-3 bg-color-4 text-color-putih hover:bg-color-2 border-0 w-fit">
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
                        <span class="text-color-2 text-sm md:text-base text-center">{{ \Carbon\Carbon::parse($item->created_at)->format('d F Y, H:i:s') }}</span>
                        <img class="rounded-2xl object-cover" src="{{ asset('storage/' . $selectedKonten->thumbnail) }}" alt="ilustrasi artikel">
                        <p class="text-color-1 text-justify text-xs lg:text-base md:text-base">
                            {{ $selectedKonten->isi_artikel }}
                        </p>
                    </div>
                </div>

            @elseif ($selectedKonten->tipe === 'video')
            
                <a href="/konten-edukatif" class="btn btn-sm mb-3 bg-color-4 text-color-putih hover:bg-color-2 border-0 w-fit">
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
                        <span class="text-color-2 text-sm md:text-base text-center">{{ \Carbon\Carbon::parse($item->created_at)->format('d F Y, H:i:s') }}</span>
                        <iframe class="w-full aspect-video rounded-lg shadow-lg" src="{!! empty($selectedKonten->link_youtube) ? 'https://www.youtube.com/embed/' : $selectedKonten->link_youtube !!}"></iframe>
                    </div>
                </div>

            @endif
        @else
        
            <a href="/" class="btn btn-sm mb-3 bg-color-4 text-color-putih hover:bg-color-2 border-0 w-fit">
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