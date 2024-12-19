@extends('layouts.main')

@section('aside')

    <div class="flex flex-col mx-auto items-center w-full h-auto mt-9 px-8 gap-6">
        <h1 class="text-2xl xl:text-4xl font-bold text-color-1 w-full">Kelola Konten Edukatif</h1>

        <div class="flex flex-col w-full h-full gap-4">

            <div class="divider m-0"></div>
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

<div class="flex flex-col w-full h-full">

    <a href="/tenaga-ahli/kelola-konten-edukatif" class="btn btn-sm mb-3 bg-color-4 text-color-putih hover:bg-color-2 border-0 w-fit">
        <img class="w-6 h-6" src="{{ asset("icons/back.svg")}}" alt="">
        Kembali
    </a>
    
    <div class=" bg-color-8 p-4 border-[1px] border-color-4 rounded-2xl">
        <h1 class="font-bold text-3xl text-center">Tambah Data Konten Edukatif</h1>

        <form action="{{ route('kelola-konten-edukatif.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="flex flex-col items-center gap-y-5pt-10 p-10">
                
                <!-- judul -->
                <label class="form-control w-full">
                    <span class="label-text font-medium text-base pb-1">Judul</span>
                    <input type="text" name="judul" placeholder="Masukkan judul anda" class="input input-bordered input-md w-full outline outline-1 outline-color-5 bg-color-6 rounded-lg" />
                </label>
                @error('judul')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
                <!-- judul -->
        
                <!-- tipe konten -->
                <label class="form-control w-full">
                    <span class="label-text font-medium text-base pb-1">Tipe</span>
                    <select name="tipe" id="tipe" class="select select-bordered w-full outline outline-1 outline-color-5 bg-color-6 rounded-lg">
                        <option disabled selected>Pilih tipe konten</option>
                        <option value="artikel">Artikel</option>
                        <option value="video">Video</option>
                    </select>
                </label>
                @error('tipe')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
                <!-- tipe konten -->
        
                <!-- thumbnail -->
                <label class="form-control w-full">
                    <div class="label">
                        <span class="label-text font-medium text-base">Thumbnail</span>
                    </div>
                    <input type="file" name="thumbnail" class="file:bg-color-3 file:text-white file:text-sm file:border-none file:h-[3rem] file:mr-4 file:px-4 file:rounded-l-lg file:font-semibold file:uppercase border border-color-5 rounded-lg w-full bg-color-6">
                </label>
                @error('thumbnail')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
                <!-- thumbnail -->
        
                <!-- kata kunci -->
                <label class="form-control w-full">
                    <span class="label-text font-medium text-base pb-1">Kata Kunci</span>
                    <input type="text" name="kata_kunci" placeholder="Kata kunci" class="input input-bordered input-md w-full outline outline-1 outline-color-5 bg-color-6 rounded-lg" />
                </label>
                @error('kata_kunci')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
                <!-- kata kunci -->
                
                <!-- Sumber -->
                <label class="form-control w-full">
                    <span class="label-text font-medium text-base pb-1">Sumber</span>
                    <input type="text" name="sumber" placeholder="Masukkan link youtube" class="input input-bordered input-md w-full outline outline-1 outline-color-5 bg-color-6 rounded-lg" />
                </label>
                @error('sumber')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
                <!-- Sumber -->
                
                <!-- link youtube -->
                <label class="form-control w-full" id="link_youtube_div" style="display:none;">
                    <span class="label-text font-medium text-base pb-1">Link Youtube</span>
                    <input type="text" name="link_youtube" placeholder="Masukkan link youtube" class="input input-bordered input-md w-full outline outline-1 outline-color-5 bg-color-6 rounded-lg" />
                </label>
                @error('link_youtube')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
                <!-- link youtube -->
        
                <!-- isi artikel -->
                <label class="form-control w-full" id="isi_artikel_div" style="display:none;">
                    <span class="label-text font-medium text-base pb-1">Isi Artikel</span>
                    <textarea name="isi_artikel" class="textarea textarea-bordered h-40 outline outline-1 outline-color-5 bg-color-6 rounded-lg w-full" placeholder="Deskripsi"></textarea>
                </label>
                @error('isi_artikel')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
                <!-- isi artikel -->
        
                <!-- tombol tambah -->
                <label class="flex justify-center items-center mt-5 w-fit">
                    <button type="submit" class="btn bg-color-3 text-white w-48">Tambah</button>
                </label>

            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tipeKontenSelect = document.getElementById('tipe');
        const isiArtikelDiv = document.getElementById('isi_artikel_div');
        const linkYoutubeDiv = document.getElementById('link_youtube_div');
        const isiArtikelInput = document.querySelector('[name="isi_artikel"]');
        const linkYoutubeInput = document.querySelector('[name="link_youtube"]');

        // Fungsi untuk mengupdate tampilan berdasarkan tipe konten yang dipilih
        function updateFormFields() {
            const tipeKonten = tipeKontenSelect.value;

            if (tipeKonten === 'artikel') {
                // Tampilkan input Isi Artikel, sembunyikan Link Youtube
                isiArtikelDiv.style.display = 'block';
                linkYoutubeDiv.style.display = 'none';
                linkYoutubeInput.disabled = true;
                isiArtikelInput.disabled = false;
            } else if (tipeKonten === 'video') {
                // Tampilkan input Link Youtube, sembunyikan Isi Artikel
                linkYoutubeDiv.style.display = 'block';
                isiArtikelDiv.style.display = 'none';
                isiArtikelInput.disabled = true;
                linkYoutubeInput.disabled = false;
            }
        }

        // Panggil fungsi awal untuk menyesuaikan tampilan berdasarkan pilihan default
        updateFormFields();

        // Tambahkan event listener untuk perubahan tipe konten
        tipeKontenSelect.addEventListener('change', updateFormFields);
    });

</script>
@endsection