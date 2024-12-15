@extends('layouts.main')

@section('aside')
<!-- konten sidebar -->
    <div class="flex flex-col mx-auto w-full h-auto mt-9 px-12 gap-y-6">
        <h1 class="text-2xl xl:text-4xl font-bold text-color-1 w-full">Daftar Aktivitas</h1>

        <!-- tombol kustomisasi aktivitas -->
        <a href="/daftar-aktivitas-pribadi/kustomisasi" class="btn flex justify-start bg-color-6 hover:bg-color-5 hover:border-color-3 text-base">
            <img src="{{ asset('icons/Plus.svg') }}" alt="Plus">
            Kustomisasi Aktivitas
        </a>
        <!-- tombol kustomisasi aktivitas -->

        <h1 class="text-2xl xl:text-4xl font-bold text-color-1">Riwayat Aktivitas</h1>

        <div class="w-full h-full  max-h-[calc(100vh-250px)] overflow-y-auto overflow-x-hidden">
            @include('pasien.Components.riwayat_aktivitas')
        </div>
    
    </div>
<!-- konten sidebar -->
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
                <h1 class="text-2xl xl:text-4xl font-bold text-color-1 w-full">Daftar Aktivitas</h1>

            <!-- tombol kustomisasi aktivitas -->
            <a href="/daftar-aktivitas-pribadi/kustomisasi" class="btn flex w-full justify-start bg-color-6 hover:bg-color-5 hover:border-color-3 text-base">
                <img src="{{ asset('icons/Plus.svg') }}" alt="Plus">
                Kustomisasi Aktivitas
            </a>
            <!-- tombol kustomisasi aktivitas -->

            <h1 class="text-2xl xl:text-4xl font-bold text-color-1 text-left w-full">Riwayat Aktivitas</h1>

            <div class="w-full h-full max-h-[calc(100vh-220px)] overflow-y-auto overflow-x-hidden">
                @include('pasien.Components.riwayat_aktivitas')
            </div>

</div>
        </div>
        <!-- End Content Offcanvas -->
    </div>
    <!-- End Offcanvas -->

<!-- list aktivitas positif -->
<div class="w-full h-full max-w-7xl">

    <a href="/" class="btn btn-sm  bg-color-4 text-color-putih hover:bg-color-2 border-0 w-fit">
        <img class="w-6 h-6" src="{{ asset("icons/back.svg")}}" alt="">
        Kembali
    </a>

    <p class="text-sm">Berikut adalah aktivitas yang telah kamu pilih untuk dilakukan setiap harinya.</p>

    <form action="{{ route('aktivitas-pribadi.store') }}" method="POST">
        @csrf
        <div class="flex gap-4 items-center">
            <button type="submit" class="px-4 py-2 bg-color-3 text-white rounded-md mt-3">
                Simpan Perubahan
            </button>
            <button 
                type="button" 
                id="select-all-btn" 
                class="px-4 py-2 border border-color-1 bg-color-putih text-color-1 rounded-md mt-3 hover:bg-color-8">
                Pilih Semua
            </button>
        </div>


        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-3 xl:grid-cols-4 gap-4 mt-4 pb-8">

            @foreach($aktivitasPribadi as $aktivitasItem)
            <div class="flex flex-col bg-color-8 border border-color-4 rounded-3xl">
                <div class="flex flex-col items-center p-2">
                    <img class="w-full h-auto aspect-square rounded-2xl" src="{{ $aktivitasItem->aktivitasPositif->gambar ? asset('storage/' . $aktivitasItem->aktivitasPositif->gambar) : asset('images/dummy.png') }}" alt="Card Image">
                    <h3 class="text-sm md:text-lg lg:text-sm xl:text-base font-semibold md:font-bold text-color-1 text-center">
                        {{ $aktivitasItem->aktivitasPositif->nama }}
                    </h3>
                    <label class="label cursor-pointer">
                        <input 
                            type="checkbox" 
                            name="aktivitas[]" 
                            value="{{ $aktivitasItem->id }}" 
                            {{ $aktivitasItem->is_completed ? 'checked' : '' }}
                            class="checkbox checkbox-lg border-color-1 [--chkbg:theme(colors.color-3)] [--chkfg:white] checked:border-color-3"
                        />
                    </label>
                </div>
            </div>
            @endforeach

        </div>
    </form>

</div>
<!-- End list aktivitas positif -->

<script>
    // JavaScript untuk mencentang/menghilangkan centang semua checkbox
    document.getElementById('select-all-btn').addEventListener('click', function() {
        const checkboxes = document.querySelectorAll('input[type="checkbox"][name="aktivitas[]"]');
        const allChecked = Array.from(checkboxes).every(checkbox => checkbox.checked); // Cek apakah semua sudah dicentang

        checkboxes.forEach(checkbox => {
            checkbox.checked = !allChecked; // Toggle status checkbox
        });
    });
</script>

@endsection