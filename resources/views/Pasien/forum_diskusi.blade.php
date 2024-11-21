<!-- halaman forum diskusi -->
@extends('layouts.main')

@section('aside')

<div class="flex flex-col mx-auto w-full h-full pt-9 px-[50px] gap-6">
    <a href="{{ route('forum-diskusi.create') }}" class="btn flex justify-start bg-color-6 hover:bg-color-5 hover:border-color-3 text-base">
        <img src="{{ asset('icons/Plus.svg') }}" alt="Plus">
        Buat Diskusi
    </a>
    <h1 class="text-4xl font-bold text-color-1 text-start">Diskusi Anda</h1>
    <div class="flex flex-col w-full h-full gap-4">

        @include('pasien.components.card_list')

    </div>
</div>

@endsection

@section('main')

<!-- konten utama forum diskusi -->
<div class="flex flex-col items-center w-full h-full select-text">
    <div class="flex flex-col gap-4 pb-8 w-full">
        
        @if ($selectedDiskusi)
            <a href="/forum" class="btn btn-sm bg-color-3 text-color-putih hover:bg-opacity-75 border-0 w-fit">
                <img class="w-6 h-6" src="{{ asset('icons/back.svg') }}" alt="">
                Kembali
            </a>
            <!-- Tampilan diskusi yang dipilih -->
            <div class="bg-color-8 p-8 border-[1px] border-color-4 rounded-2xl w-full">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <img class="w-16 h-16 rounded-full mr-4" 
                            src="{{ $selectedDiskusi->pasien->profile_picture ?? asset('storage/image/dummy.png') }}" 
                            alt="Profil " />
                        <div class="flex flex-col">
                            <span class="text-xl text-color-1 font-semibold">{{ $selectedDiskusi->pasien ? $selectedDiskusi->pasien->user->nama : '#DeletedUser' }}</span>
                            <span class="text-color-1">{{ $selectedDiskusi->created_at->format('d F Y, H:i:s') }}</span>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col pl-20">
                    <h1 class="text-3xl font-bold text-color-1 text-center my-4">{{ $selectedDiskusi->judul }}</h1>
                    <p class="text-color-1 text-justify">
                        {{ $selectedDiskusi->isi }}
                    </p>
                    <div class="grid gap-2">
                        @foreach ($selectedDiskusi->gambarDiskusi as $gambar)
                            <img class="rounded-2xl object-cover w-full aspect-square" 
                                src="{{ asset('storage/' . $gambar->gambar) }}" 
                                alt="Gambar Diskusi">
                        @endforeach
                    </div>
                    <div class="divider m-0"></div>
                    <h2 class="text-gray-400 text-xl text-center">Balasan</h2>
                    <!-- Bubble komentar -->
                    <div class="flex flex-col gap-4 mt-4">
                        @foreach ($selectedDiskusi->balasan as $balasan)
                        <div class="bg-gray-100 p-4 rounded-lg relative">
                            <!-- Nama pengguna -->
                            <span class="font-semibold">{{ $balasan->pasien ? $balasan->pasien->user->nama : '#DeletedUser' }}</span>
                            <p>{{ $balasan->isi }}</p>
                            <span class="text-sm text-gray-500">{{ $balasan->created_at->format('d F Y, H:i:s') }}</span>
                    
                            <!-- Tampilkan tombol hapus jika balasan milik user -->
                            @if ($balasan->pasien && $balasan->pasien->user->id === Auth::id())
                                <!-- Tombol hapus (ikon silang) -->
                                <button class="absolute top-2 right-2 rounded-xl bg-color-putih text-red-600 hover:text-red-300" 
                                        onclick="document.getElementById('delete-balasan-modal-{{ $balasan->id }}').showModal();">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                    
                                <!-- Modal Konfirmasi Hapus -->
                                <dialog id="delete-balasan-modal-{{ $balasan->id }}" class="modal">
                                    <div class="modal-box bg-color-8">
                                        <h3 class="text-lg font-bold">Konfirmasi Penghapusan</h3>
                                        <p>Apakah Anda yakin ingin menghapus balasan ini?</p>
                                        <div class="modal-action">
                                            <!-- Tombol Batal -->
                                            <button type="button" class="btn bg-color-7 hover:bg-color-8" onclick="this.closest('dialog').close()">Batal</button>
                                            
                                            <form method="POST" action="{{ route('pasien.balasan.destroy', $balasan->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn bg-red-500 text-white hover:bg-red-700">Hapus</button>
                                            </form>
                                            
                                        </div>
                                    </div>
                                </dialog>
                            @endif
                        </div>
                    @endforeach
                    
                    </div>
                    <!-- Form untuk menambah balasan -->
                    <form action="{{ route('balasan.store') }}" method="POST" class="mt-4">
                        @csrf
                        <!-- Input hidden untuk id_diskusi -->
                        <input type="hidden" name="id_diskusi" value="{{ $selectedDiskusi->id }}">
                        <div class="flex gap-3">
                            <input type="text" name="isi" class="input input-bordered input-md w-full outline outline-1 outline-color-5 bg-color-6 rounded-lg" placeholder="Tulis komentar..."></input>
                            <button type="submit" class="btn border-0 outline outline-1 outline-color-5 bg-color-6">Kirim</button>
                        </div>
                    </form>
                </div>
            </div>
        @else
            <a href="/" class="btn btn-sm bg-color-3 text-color-putih hover:bg-opacity-75 border-0 w-fit">
                <img class="w-6 h-6" src="{{ asset('icons/back.svg') }}" alt="">
                Kembali
            </a>
                <div class="flex flex-col w-full h-full gap-5">
                    
                    @foreach ($diskusis as $diskusi)
                    <div class="bg-color-8 p-8 border-[1px] border-color-4 rounded-2xl">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <!-- Gambar profil pasien -->
                                <img class="w-16 h-16 rounded-full mr-4" 
                                    src="{{ $diskusi->pasien->profile_picture ?? asset('storage/image/dummy.png') }}" 
                                    alt="Profil" />
                                <div class="flex flex-col">
                                    <!-- Nama pasien -->
                                    <span class="text-xl text-color-1 font-semibold">{{ $diskusi->pasien ? $diskusi->pasien->user->nama : '#DeletedUser' }}</span>
                                    <!-- Tanggal diskusi -->
                                    <span class="text-color-1">{{ $diskusi->created_at->format('d F Y, H:i:s') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col pl-20">
                            <!-- Judul diskusi -->
                            <h1 class="text-3xl font-bold text-color-1 text-center my-4">{{ $diskusi->judul }}</h1>
                            <!-- Isi diskusi -->
                            <p class="text-color-1 text-justify">
                                {{ $diskusi->isi }}
                            </p>
                            <!-- Gambar diskusi -->
                            @php
                                $gambarCount = count($diskusi->gambarDiskusi);
                            @endphp
                            <div class="grid gap-2">
                                @if ($gambarCount === 1)
                                    <div class="grid grid-cols-1">
                                        <img class="rounded-2xl object-cover w-full aspect-square" 
                                            src="{{ asset('storage/' . $diskusi->gambarDiskusi[0]->gambar) }}" 
                                            alt="Gambar Diskusi">
                                    </div>
                                @elseif ($gambarCount === 2)
                                    <div class="grid grid-cols-2 gap-2">
                                        @foreach ($diskusi->gambarDiskusi as $gambar)
                                            <img class="rounded-2xl object-cover w-full aspect-square" 
                                                src="{{ asset('storage/' . $gambar->gambar) }}" 
                                                alt="Gambar Diskusi">
                                        @endforeach
                                    </div>
                                @elseif ($gambarCount === 3)
                                    <div class="grid grid-cols-2 gap-2">
                                        <!-- Gambar pertama dengan rasio 2:1 -->
                                        <img class="rounded-2xl object-cover w-full aspect-[2/1] col-span-2" 
                                            src="{{ asset('storage/' . $diskusi->gambarDiskusi->first()->gambar) }}" 
                                            alt="Gambar Diskusi">
                                        @foreach ($diskusi->gambarDiskusi->skip(1) as $gambar)
                                            <img class="rounded-2xl object-cover w-full aspect-square" 
                                                src="{{ asset('storage/' . $gambar->gambar) }}" 
                                                alt="Gambar Diskusi">
                                        @endforeach
                                    </div>
                                @elseif ($gambarCount === 4)
                                    <div class="grid grid-cols-2 gap-2">
                                        @foreach ($diskusi->gambarDiskusi as $gambar)
                                            <img class="rounded-2xl object-cover w-full aspect-square" 
                                                src="{{ asset('storage/' . $gambar->gambar) }}" 
                                                alt="Gambar Diskusi">
                                        @endforeach
                                    </div>
                                @elseif ($gambarCount === 5)
                                    <div class="grid grid-cols-3 gap-2">
                                        <!-- Gambar pertama dengan rasio 2:1 -->
                                        <img class="rounded-2xl object-cover w-full aspect-[2/1] col-span-2" 
                                            src="{{ asset('storage/' . $diskusi->gambarDiskusi->first()->gambar) }}" 
                                            alt="Gambar Diskusi">
                                        @foreach ($diskusi->gambarDiskusi->skip(1) as $gambar)
                                            <img class="rounded-2xl object-cover w-full aspect-square" 
                                                src="{{ asset('storage/' . $gambar->gambar) }}" 
                                                alt="Gambar Diskusi">
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                            <div class="divider m-0"></div>
                            <a href="{{ route('forum.index', $diskusi->id) }}" class="btn btn-sm bg-color-6 text-gray-400 border-0 hover:bg-color-putih">
                                Balasan
                            </a>
                        </div>
                    </div>
                    @endforeach            

                </div>
            </div>
    
            <div class="pb-3 flex justify-center">
                <!-- Pagination container -->
                <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px">
                    <!-- Previous Page Button -->
                    @if ($diskusis->onFirstPage())
                        <span class="inline-flex items-center px-4 py-2 text-sm font-medium text-color-2 bg-color-6 border border-color-4 cursor-not-allowed">
                            Previous
                        </span>
                    @else
                        <a href="{{ $diskusis->previousPageUrl() . '&' . http_build_query(request()->except('page_diskusis')) }}" 
                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-color-3 bg-color-6 border border-color-4 rounded-l-md hover:bg-color-5">
                            Previous
                        </a>
                    @endif
            
                    <!-- Page Numbers -->
                    @foreach ($diskusis->links()->elements as $element)
                        @if (is_string($element))
                            <span class="inline-flex items-center px-4 py-2 text-sm font-medium text-color-2 bg-color-6 border border-color-4">
                                {{ $element }}
                            </span>
                        @endif
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                <a href="{{ $url . '&' . http_build_query(request()->except('page_diskusis')) }}" 
                                    class="inline-flex items-center px-4 py-2 text-sm font-medium 
                                    {{ $page == $diskusis->currentPage() ? 'text-color-1 bg-color-3 border-color-3' : 'text-color-2 bg-color-6 border-color-4 hover:bg-color-5' }} border">
                                    {{ $page }}
                                </a>
                            @endforeach
                        @endif
                    @endforeach
            
                    <!-- Next Page Button -->
                    @if ($diskusis->hasMorePages())
                        <a href="{{ $diskusis->nextPageUrl() . '&' . http_build_query(request()->except('page_diskusis')) }}" 
                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-color-3 bg-color-6 border border-color-4 rounded-r-md hover:bg-color-5">
                            Next
                        </a>
                    @else
                        <span class="inline-flex items-center px-4 py-2 text-sm font-medium text-color-2 bg-color-6 border border-color-4 cursor-not-allowed">
                            Next
                        </span>
                    @endif
                </nav>
            </div>            
        @endif

    </div>
</div>
<!-- konten utama forum diskusi -->

@endsection