<!-- Daftar Riwayat Aktivitas -->
<div class="flex flex-col w-full h-full p-2 gap-4">
    
    @foreach ($riwayatKonsultasi as $riwayat)
    <!-- Card Konsultasi -->
    <a href="{{ route('chat.index', $riwayat->id) }}" class="flex items-center border-[1px] border-color-4 rounded-2xl p-2 gap-2">
        <div class="flex-none w-16 h-16">
            <img
                class="w-full h-full rounded-xl"
                src="{{ $riwayat->tenagaAhli->user->foto_profil ? asset($riwayat->tenagaAhli->user->foto_profil) : asset('images/dummy.png') }}"
                alt="Profile Picture" />
        </div>
        <div class="flex-1 justify-between">
            <span class="text-color-1 font-semibold">
                {{ optional($riwayat->tenagaAhli->user)->nama ?? 'Nama tidak tersedia' }}
            </span>
            <!-- Status Konsultasi -->
            <div class="flex gap-1">
                <span class="text-xs font-semibold py-1 px-3 rounded-full 
                    {{ $riwayat->status === 'done' ? 'bg-color-7 text-color-1' : 'bg-color-6 text-color-1' }}">
                    {{ $riwayat->status === 'done' ? 'Selesai' : 'Berlangsung' }}
                </span>
                @if ($riwayat->pesan_tenaga_ahli)
                    <span class="text-xs font-semibold py-1 px-3 rounded-full bg-color-7 text-color-1">
                        Pesan diberikan
                    </span>
                @endif
            </div>
            <div class="flex justify-start items-center">
                <span class="text-color-2 text-sm">
                    {{ $riwayat->started_at ? $riwayat->started_at->translatedFormat('l, d F Y H:i:s') : 'Tanggal tidak tersedia' }}
                </span>
            </div>
        </div>

        <!-- Tombol Hapus -->
        @if ($riwayat->status === 'done')
            <button type="button" class="btn btn-square btn-ghost" onclick="event.stopPropagation(); event.preventDefault(); document.getElementById('delete-modal-{{ $riwayat->id }}').showModal()">
                <img class="size-5 xl:size-6" src="{{ asset('icons/Waste-dark.svg') }}" alt="Hapus">
            </button>
        @endif
    </a>

    <!-- Modal Konfirmasi Hapus -->
    <dialog id="delete-modal-{{ $riwayat->id }}" class="modal duration-0">
        <div class="modal-box bg-color-8">
            <h3 class="text-lg font-bold">Konfirmasi Penghapusan</h3>
            <p>Apakah Anda yakin ingin menghapus percakapan ini?</p>
            <div class="modal-action">
                <button type="button" class="btn bg-color-7 hover:bg-color-8" onclick="this.closest('dialog').close()">Batal</button>
                <form method="POST" action="{{ route('konsultasi.destroy', $riwayat->id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn bg-red-500 text-white hover:bg-red-700">Hapus</button>
                </form>
            </div>
        </div>
    </dialog>
@endforeach


    @if ($riwayatKonsultasi->isEmpty())
        <div class="text-center py-4 text-color-2">
            <p>Tidak ada riwayat konsultasi</p>
        </div>
    @endif
</div>
