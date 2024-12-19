@foreach($kontenList as $item)
<a href="{{ route('kelola-konten-edukatif.index', $item->id) }}" class="flex border-[1px] border-color-4 rounded-2xl p-4 gap-2">
    <div class="flex-none">
        <img class="size-20 xl:size-[6.25rem] object-cover rounded-xl" src="{{ asset('storage/' . $item->thumbnail) }}" alt="Thumbnail" />
    </div>
    <div class="flex flex-col w-full">
        <!-- tipe -->
        <span class="text-color-2 text-xs xl:text-sm">{{ ucfirst($item->tipe) }}</span>
        <!-- judul -->
        <div class="flex w-full gap-1">
            <span class="text-xl font-bold text-ellipsis break-all line-clamp-2 w-full">{{ $item->judul }}</span>
            <div class="flex gap-1 xl:gap-1">
                <button class="btn btn-square btn-md btn-ghost" onclick="event.stopPropagation(); event.preventDefault(); window.location.href='{{ route('kelola-konten-edukatif.edit', ['id' => $item->id]) }}'">
                    <img class="size-5 xl:size-6" src="{{ asset('icons/Edit-dark.svg') }}" alt="Edit">
                </button>
                <button class="btn btn-square btn-md btn-ghost" onclick="event.stopPropagation(); event.preventDefault(); document.getElementById('delete-modal-{{ $item->id }}').showModal()">
                    <img class="size-5 xl:size-6" src="{{ asset('icons/Waste-dark.svg') }}" alt="Hapus">
                </button>
            </div>
        </div>
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

<!-- Modal Konfirmasi Hapus -->
<dialog id="delete-modal-{{ $item->id }}" class="modal duration-0">
    <div class="modal-box bg-color-8">
        <h3 class="text-lg font-bold">Konfirmasi Penghapusan</h3>
        <p>Apakah Anda yakin ingin menghapus konten edukatif ini?</p>
        <div class="modal-action">
            <button type="button" class="btn bg-color-7 hover:bg-color-8" onclick="this.closest('dialog').close()">Batal</button>
            <form method="POST" action="{{ route('kelola-konten-edukatif.destroy', $item->id) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn bg-red-500 text-white hover:bg-red-700">Hapus</button>
            </form>
        </div>
    </div>
</dialog>
@endforeach