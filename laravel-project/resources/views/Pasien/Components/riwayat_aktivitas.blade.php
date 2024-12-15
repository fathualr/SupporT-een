<!-- Daftar Riwayat Aktivitas -->
<div class="flex flex-col w-full h-full gap-4">
    
    @foreach ($riwayatAktivitas as $tanggal => $aktivitasHarian)
        <label class="btn space-y-2 h-[50px] bg-color-8 rounded-xl outline outline-1 outline-color-4 px-3"
            onclick="document.getElementById('riwayat-aktivitas-{{ $tanggal }}').checked = true">
            <div class="flex flex-col justify-between text-left w-full h-full">
                <p class="text-base font-semibold text-color-1">
                    {{ $aktivitasHarian->count() }} aktivitas diselesaikan
                </p>
                <p class="text-xs font-medium text-color-1">
                    {{ \Carbon\Carbon::parse($tanggal)->translatedFormat('d F Y') }}
                </p>
            </div>
        </label>

        <!-- Modal untuk waktu tertentu -->
        <input type="checkbox" id="riwayat-aktivitas-{{ $tanggal }}" class="modal-toggle" />
        <div class="modal select-none" role="dialog">
            <div class="modal-box bg-color-8">
                <h3 class="text-lg font-bold">Daftar Aktivitas</h3>

                <ul role="list" class="space-y-4 my-6">
                    @foreach ($aktivitasHarian as $aktivitas)
                        <li class="flex items-center">
                            <svg class="flex-shrink-0 w-5 h-5 text-color-3" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                            </svg>
                            <span class="font-normal text-color-1 ml-3">
                                {{ $aktivitas->aktivitasPositif->nama }}
                            </span>
                        </li>
                    @endforeach
                </ul>

                <div class="flex justify-center">
                    <label for="riwayat-aktivitas-{{ $tanggal }}" class="btn btn-sm text-color-1 bg-color-7 border-0 hover:bg-color-putih">Kembali</label>
                </div>
            </div>
            <label class="modal-backdrop" for="riwayat-aktivitas-{{ $tanggal }}">Close</label>
        </div>
    @endforeach

    @if ($riwayatAktivitas->isEmpty())
        <div class="text-center py-4 text-color-2">
            <p>Tidak ada riwayat aktivitas</p>
        </div>
    @endif
</div>
