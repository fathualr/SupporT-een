@extends('layouts.main')

@section('aside')
    <!-- halaman jurnal harian -->
    <div class="flex flex-col mx-auto w-full h-auto mt-9 px-12 gap-y-6">
        <h1 class="text-2xl xl:text-4xl font-bold text-color-1 w-full">Jurnal Harian</h1>

        <!-- tombol tambah jurnal -->
        <a href="{{ route('jurnalHarian.index') }}" class="btn flex justify-start bg-color-6 hover:bg-color-5 hover:border-color-3 text-color-1">
            <img src="{{ asset('icons/Plus.svg') }}" alt="Plus">
            Tulis Jurnal Baru
        </a>
        <!-- tombol tambah jurnal -->

        <div class="flex flex-col w-full h-full gap-4 mt-4">

            <!-- Looping jurnal harian -->
            @foreach ($jurnalHarianList as $jurnal)
                <button type="button" onclick="window.location='{{ route('jurnalHarian.index', $jurnal->id) }}';" 
                        class="flex flex-row items-center justify-between h-[50px] border-[1px] border-color-4 rounded-2xl p-3 gap-2 hover:bg-color-6">
                    <span class="text-color-1 font-semibold truncate">
                        {{ $jurnal->judul ? $jurnal->judul : Str::limit($jurnal->isi, 50, '...') }}
                    </span>
                    <div class="flex justify-center gap-2">
                        <!-- Tombol Hapus -->
                        <a class="btn btn-square btn-md btn-ghost" 
                        onclick="event.stopPropagation(); document.getElementById('delete-modal-{{ $jurnal->id }}').showModal();">
                            <img class="w-6 h-6" src="{{ asset('icons/Waste-dark.svg') }}" alt="Hapus">
                        </a>
                    </div>
                </button>
            @endforeach

            <!-- Jika tidak ada jurnal -->
            @if ($jurnalHarianList->isEmpty())
                <div class="text-center py-4 text-color-2">
                    <p>Belum ada jurnal harian. Mulai tulis jurnal Anda hari ini!</p>
                </div>
            @endif

        </div>

    </div>
    <!-- halaman jurnal harian -->
@endsection

@section('main')
    <!-- offcanvas -->
    <div 
        id="hs-offcanvas-example" 
        class="hs-overlay hidden fixed inset-y-0 left-0 transform -translate-x-full transition-all duration-500 ease-in-out z-[80] min-h-screen bg-white shadow-lg max-w-xs w-full" 
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
                <h1 class="text-2xl xl:text-4xl font-bold text-color-1 w-full">Jurnal Harian</h1>

                <!-- tombol tambah jurnal -->
                <a href="{{ route('jurnalHarian.index') }}" class="btn flex justify-start w-full bg-color-6 hover:bg-color-5 hover:border-color-3 text-color-1">
                    <img src="{{ asset('icons/Plus.svg') }}" alt="Plus">
                    Tulis Jurnal Baru
                </a>
                <!-- tombol tambah jurnal -->

                <div class="flex flex-col w-full h-full gap-4 max-h-[calc(100vh-170px)] overflow-y-auto overflow-x-hidden">

                    <!-- Looping jurnal harian -->
                    @foreach ($jurnalHarianList as $jurnal)

                        <button type="button" onclick="window.location='{{ route('jurnalHarian.index', $jurnal->id) }}';" 
                                class="flex flex-row items-center justify-between h-[50px] border-[1px] border-color-4 rounded-2xl p-3 gap-2 hover:bg-color-6">
                            <span class="text-color-1 font-semibold truncate">
                                {{ $jurnal->judul ? $jurnal->judul : Str::limit($jurnal->isi, 50, '...') }}
                            </span>
                            <div class="flex justify-center gap-2">
                                <!-- Tombol Hapus -->
                                <a class="btn btn-square btn-md btn-ghost" 
                                onclick="event.stopPropagation(); document.getElementById('delete-modal-{{ $jurnal->id }}').showModal();">
                                    <img class="w-6 h-6" src="{{ asset('icons/Waste-dark.svg') }}" alt="Hapus">
                                </a>
                            </div>
                        </button>

                    @endforeach

                    <!-- Jika tidak ada jurnal -->
                    @if ($jurnalHarianList->isEmpty())
                        <div class="text-center py-4 text-color-2">
                            <p>Belum ada jurnal harian. Mulai tulis jurnal Anda hari ini!</p>
                        </div>
                    @endif

                </div>

            </div>

        </div>
        <!-- End Content Offcanvas -->
    </div>
    <!-- End Offcanvas -->

    @foreach ($jurnalHarianList as $jurnal)

<!-- Modal Konfirmasi Hapus -->
<dialog id="delete-modal-{{ $jurnal->id }}" class="modal duration-0">
    <div class="modal-box bg-color-8">
        <h3 class="text-lg font-bold">Konfirmasi Penghapusan</h3>
        <p>Apakah Anda yakin ingin menghapus jurnal ini?</p>
        <div class="modal-action">
            <button type="button" class="btn bg-color-7 hover:bg-color-8" onclick="this.closest('dialog').close()">Batal</button>
            <form method="POST" action="{{ route('jurnal-harian.destroy', $jurnal->id) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn bg-red-500 text-white hover:bg-red-700">Hapus</button>
            </form>
        </div>
    </div>
</dialog>
@endforeach

<div class="w-full h-full">
    <a href="/" class="btn btn-sm mb-3 bg-color-4 text-color-putih hover:bg-color-2 border-0 w-fit">
        <img class="w-6 h-6" src="{{ asset("icons/back.svg")}}" alt="">
        Kembali
    </a>
    <!-- Jurnal -->
    <div class="bg-white max-w-7xl rounded-2xl w-full h-full mb-10 p-8">

        @if($selectedJurnal)
        
            <!-- tombol analisis emosi -->
            <div class="flex justify-center w-full">
                <label class="btn btn-sm text-color-1 bg-color-7 border-0 hover:bg-color-putih w-fit" 
                onclick="
                    if({{ Auth::user()->isPremium() ? 'true' : 'false' }}) {
                        document.getElementById('analisis-emosi').checked = true; // Tampilkan modal Analisis Emosi
                    } else {
                        document.getElementById('membership').checked = true; // Tampilkan modal Membership
                    }
                ">
                    Analisis Emosi
                </label>
            </div>

            <!-- form jurnal harian -->
            <form id="text-form" action="{{ route('jurnal-harian.update', $selectedJurnal->id) }}" method="POST" class="flex flex-col max-w-7xl w-full h-full gap-y-4 relative">
                @csrf
                @method('PATCH')
                
                <!-- Judul -->
                <input type="text" name="judul" autocomplete="off"
                value="{{ old('judul', $selectedJurnal->judul) }}"
                placeholder="Judul Jurnal"
                class="font-bold text-lg py-3 bg-transparent block w-full rounded-lg outline-none focus:border-none" />

                <hr class="border-slate-200 my-4">

                <!-- isi -->
                <textarea name="isi" class="py-1 textarea textarea-bordered bg-transparent outline-none h-full resize-none" style="
                        background-image: linear-gradient(to bottom, rgba(0, 0, 0, 0.1) 1px, transparent 1px);
                        background-size: 100% 32px;
                        line-height: 32px;
                        padding: 10px;
                        border: 1px solid #ccc;
                        border-radius: 5px;"
                        >{{ old('isi', $selectedJurnal->isi) }}</textarea>

                <!-- tombol simpan -->
                <div class="flex justify-center w-full">
                    <button type="submit" class="btn border-0 bg-color-3 text-white">
                        Simpan
                    </button>
                </div>

            </form>

            @if(Auth::user()->isPremium())
                <input type="checkbox" id="analisis-emosi" class="modal-toggle" />
                <div class="modal select-none" role="dialog">
                    <div class="modal-box bg-color-8 border border-gray-200 rounded-lg shadow-lg relative">
                        <!-- Tombol Tutup -->
                        <label for="analisis-emosi" class="btn btn-sm btn-circle btn-ghost absolute right-4 top-4">✕</label>
                
                        <!-- Header Modal -->
                        <div class="text-center">
                            <h3 class="text-lg font-bold">Analisis Emosi</h3>
                        </div>
                
                        <!-- Diagram -->
                        <div class="my-4">
                            @include('pasien.components.diagram_emotion')
                        </div>
                
                        <!-- Tombol Kembali -->
                        <div class="flex justify-center mt-6">
                            <label for="analisis-emosi" class="btn btn-sm text-color-1 bg-color-7 border-0 hover:bg-color-putih">Kembali</label>
                        </div>
                    </div>
                    <label class="modal-backdrop" for="analisis-emosi">Close</label>
                </div>                
            @endif
        @else

            <!-- form jurnal harian -->
            <form id="text-form" action="{{ route('jurnal-harian.store') }}" method="POST" class="flex flex-col max-w-7xl w-full h-full gap-y-4 relative">
                @csrf
                
                <!-- judul -->
                <input type="text" name="judul" placeholder="Judul Jurnal" autocomplete="off" class="font-bold text-lg py-3 bg-transparent block w-full rounded-lg outline-none focus:border-none" />
                @error('judul')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror

                <hr class="border-slate-200">

                <!-- isi -->
                <textarea name="isi" class="py-1 textarea textarea-bordered bg-transparent outline-none h-full resize-none" style="
                            background-image: linear-gradient(to bottom, rgba(0, 0, 0, 0.1) 1px, transparent 1px);
                            background-size: 100% 32px;
                            line-height: 32px;
                            padding: 10px;
                            border: 1px solid #ccc;
                            border-radius: 5px;"></textarea>
                @error('isi')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror

                <!-- tombol simpan -->
                <div class="flex justify-center w-full">
                    <button type="submit" class="btn border-0 bg-color-3 text-white">
                        Simpan
                    </button>
                </div>

            </form>
            @endif

        </div>
    </div>
</div>
    <!-- End jurnal -->

@endsection