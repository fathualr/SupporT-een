<!-- Daftar Riwayat Aktivitas -->
<div class="flex flex-col w-full h-full p-2 gap-4">
    
    @foreach ($riwayatKonsultasi as $riwayat)
        <button class="btn space-y-2 h-20 bg-color-8 rounded-2xl outline outline-1 outline-color-4 p-3"
            onclick="">
            <div class="flex flex-col justify-between text-left w-full h-full">
                <p class="text-base font-semibold text-color-1">
                    {{ $riwayat->id_tenaga_ahli->user->nama }}
                </p>
                <p class="text-xs font-medium text-color-1">
                </p>
            </div>
        </button>
    @endforeach

    @if ($riwayatKonsultasi->isEmpty())
        <div class="text-center py-4 text-color-2">
            <p>Tidak ada riwayat konsultasi</p>
        </div>
    @endif
</div>
