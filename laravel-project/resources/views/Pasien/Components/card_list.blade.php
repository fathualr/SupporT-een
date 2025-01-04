@foreach ($diskusiList as $diskusi)
    <button onclick="window.location.href='{{ route('forum.index', $diskusi->id) }}'" class="flex items-center border-[1px] border-color-4 rounded-2xl p-2 gap-2">
        <!-- Gambar -->
        <div class="flex-none w-16 h-16">
            <img class="w-full h-full rounded-xl" 
                src="{{ $diskusi->gambarDiskusi->first() ? asset('storage/' . $diskusi->gambarDiskusi->first()->gambar) : asset('images/dummy.png') }}" 
                alt="Gambar Diskusi">
        </div>
        <!-- Isi Diskusi -->
        <div class="flex-1">
            <p class="text-color-1 font-semibold text-left text-sm xl:text-base line-clamp-2">
                {{ $diskusi->judul }} <!-- Potong judul jika terlalu panjang -->
            </p>
        </div>
        <!-- Tombol Aksi -->
        <div class="flex justify-center gap-2">
            <!-- Tombol Edit -->
            <a href="{{ route('forum-diskusi.edit', $diskusi->id) }}" class="btn btn-square btn-md btn-ghost">
                <img class="w-6 h-6" src="{{ asset('icons/Edit-dark.svg') }}" alt="Edit">
            </a>
            <!-- Tombol Hapus -->
            <a class="btn btn-square btn-md btn-ghost" 
                onclick="event.stopPropagation(); document.getElementById('delete-diskusi-modal-{{ $diskusi->id }}').showModal();">
                <img class="w-6 h-6" src="{{ asset('icons/Waste-dark.svg') }}" alt="Hapus">
            </a>
        </div>
    </button>

@endforeach

@if ($diskusiList->isEmpty())
    <div class="text-center py-4 text-color-2">
        <p>Tidak ada diskusi milik mu. Mulai diskusi baru!</p>
    </div>
@endif

<div class="divider m-0"></div>

<div class="pb-3 flex justify-center">
    <!-- Pagination container -->
    <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px">
        <!-- Previous Page Button -->
        @if ($diskusiList->onFirstPage())
            <span class="inline-flex items-center px-4 py-2 text-sm font-medium text-color-2 bg-color-6 border border-color-4 cursor-not-allowed">
                Previous
            </span>
        @else
            <a href="{{ $diskusiList->previousPageUrl() . '&' . http_build_query(request()->except('page_diskusiList')) }}" 
                class="inline-flex items-center px-4 py-2 text-sm font-medium text-color-3 bg-color-6 border border-color-4 rounded-l-md hover:bg-color-5">
                Previous
            </a>
        @endif

        <!-- Page Numbers -->
        @foreach ($diskusiList->links()->elements as $element)
            @if (is_string($element))
                <span class="inline-flex items-center px-4 py-2 text-sm font-medium text-color-2 bg-color-6 border border-color-4">
                    {{ $element }}
                </span>
            @endif
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    <a href="{{ $url . '&' . http_build_query(request()->except('page_diskusiList')) }}" 
                        class="inline-flex items-center px-4 py-2 text-sm font-medium 
                        {{ $page == $diskusiList->currentPage() ? 'text-color-1 bg-color-3 border-color-3' : 'text-color-2 bg-color-6 border-color-4 hover:bg-color-5' }} border">
                        {{ $page }}
                    </a>
                @endforeach
            @endif
        @endforeach

        <!-- Next Page Button -->
        @if ($diskusiList->hasMorePages())
            <a href="{{ $diskusiList->nextPageUrl() . '&' . http_build_query(request()->except('page_diskusiList')) }}" 
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
