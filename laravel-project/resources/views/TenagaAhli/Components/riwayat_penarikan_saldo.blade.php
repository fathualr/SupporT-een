@foreach ($riwayatPenarikan as $riwayat)
    <label class="flex items-center border-[1px] border-color-4 rounded-2xl p-4 mb-4 cursor-pointer" 
            onclick="document.getElementById('riwayat-penarikan-{{ $riwayat->id }}').checked = true">
        <div class="flex-1">
            <!-- Jumlah Penarikan -->
            <div class="flex justify-between items-center">
                <span class="text-color-1 font-bold text-lg">Rp. {{ number_format($riwayat->jumlah_penarikan, 2, ',', '.') }}</span>
                <span class="text-xs font-semibold py-1 px-3 rounded-full 
                    {{ $riwayat->status === 'menunggu' ? 'bg-yellow-200 text-yellow-800' : 
                        ($riwayat->status === 'ditolak' ? 'bg-red-200 text-red-800' : 'bg-green-200 text-green-800') }}">
                    {{ ucfirst($riwayat->status) }}
                </span>
            </div>
            <!-- Pesan dan Waktu -->
            <div class="mt-2 text-sm text-color-2">
                <span>{{ $riwayat->created_at->translatedFormat('l, d F Y H:i:s') }}</span>
            </div>
        </div>
    </label>

    <!-- Modal untuk Penarikan -->
    <input type="checkbox" id="riwayat-penarikan-{{ $riwayat->id }}" class="modal-toggle" />
    <div class="modal select-none" role="dialog">
        <div class="modal-box bg-color-8">
            <h3 class="text-lg font-bold">Detail Penarikan</h3>
            
            <ul class="space-y-4 my-6 text-color-1">
                <li><strong>Jumlah Penarikan:</strong> Rp. {{ number_format($riwayat->jumlah_penarikan, 2, ',', '.') }}</li>
                <li><strong>Provider:</strong> {{ $riwayat->provider }}</li>
                <li><strong>Nomor Tujuan:</strong> {{ $riwayat->nomor_tujuan }}</li>
                <li><strong>Status:</strong> {{ ucfirst($riwayat->status) }}</li>
                <li><strong>Diajukan Pada:</strong> {{ $riwayat->created_at->translatedFormat('l, d F Y H:i:s') }}</li>

                @if ($riwayat->status === 'disetujui')
                    <li><strong>Disetujui Pada:</strong> {{ $riwayat->approved_at->translatedFormat('l, d F Y H:i:s') }}</li>
                    @if ($riwayat->bukti_transfer)
                        <li><strong>Bukti Pembayaran:</strong></li>
                        <div class="flex justify-center mt-4">
                            <img src="{{ asset('storage/' . $riwayat->bukti_transfer) }}" 
                                alt="Bukti Transfer" class="rounded-lg max-w-full h-auto">
                        </div>
                        <a href="{{ asset('storage/' . $riwayat->bukti_transfer) }}" class="text-blue-600 hover:underline" target="_blank">Lihat Bukti Transfer</a>
                    @endif
                @elseif ($riwayat->status === 'ditolak')
                    <li><strong>Pesan Penolakan:</strong> {{ $riwayat->pesan_penarikan }}</li>
                @endif
            </ul>

            <div class="flex justify-center">
                <label for="riwayat-penarikan-{{ $riwayat->id }}" class="btn btn-sm text-color-1 bg-color-7 border-0 hover:bg-color-putih">Kembali</label>
            </div>
        </div>
        <label class="modal-backdrop" for="riwayat-penarikan-{{ $riwayat->id }}">Close</label>
    </div>
@endforeach
