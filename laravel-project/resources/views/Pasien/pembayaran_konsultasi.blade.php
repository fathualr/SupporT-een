@extends('layouts.main')

@section('aside')
<div class="flex flex-col mx-auto w-full h-auto mt-9 px-12 gap-y-6">
    <h1 class="text-2xl xl:text-4xl font-bold text-color-1 w-full">Konsultasi</h1>
    <div class="divider m-0"></div>

    <h1 class="text-2xl xl:text-4xl font-bold text-color-1">Riwayat Konsultasi</h1>

    <div class="w-full h-full overflow-x-hidden">
        @include('pasien.Components.riwayat_konsultasi')
    </div>
</div>
@endsection

@section('main')
<div class="w-full h-full">
    <div class="bg-color-8 p-8 border-[1px] border-color-4 rounded-2xl">
        <a href="/konsultasi" class="btn btn-sm mb-3 bg-color-4 text-color-putih hover:bg-color-2 border-0 w-fit">
            <img class="w-6 h-6" src="{{ asset('icons/back.svg') }}" alt="">
            Kembali
        </a>

        <h2 class="text-2xl font-bold text-color-1 mb-4">Pembayaran Konsultasi</h2>
        
        {{-- Tambahkan div untuk loading state --}}
        <div id="loading-payment" class="hidden">
            <div class="flex items-center justify-center">
                <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-color-3"></div>
                <span class="ml-2">Memproses pembayaran...</span>
            </div>
        </div>

        <div id="payment-form">
            <label class="form-control w-full mt-5">
                <span class="label-text font-medium text-base pb-1">Email Anda</span>
                <input type="text" name="email" value="{{ Auth::user()->email }}" readonly 
                    class="input input-bordered input-md w-full outline outline-1 outline-color-5 bg-color-6 rounded-lg" />
            </label>
            <label class="form-control w-full mt-5">
                <span class="label-text font-medium text-base pb-1">Nama Tenaga Ahli</span>
                <input type="text" name="nama_tenaga_ahli" value="{{ $tenagaAhli->user->nama }}" readonly 
                    class="input input-bordered input-md w-full outline outline-1 outline-color-5 bg-color-6 rounded-lg" />
            </label>
            <label class="form-control w-full mt-5">
                <span class="label-text font-medium text-base pb-1">Durasi Konsultasi</span>
                <input type="text" value="30 menit" readonly 
                    class="input input-bordered input-md w-full outline outline-1 outline-color-5 bg-color-6 rounded-lg" />
            </label>
            <label class="form-control w-full mt-5">
                <span class="label-text font-medium text-base pb-1">Biaya Konsultasi</span>
                <input type="text" name="amount" value="Rp.{{ number_format($tenagaAhli->biaya_konsultasi, 0, ',', '.') }}" readonly 
                    class="input input-bordered input-md w-full outline outline-1 outline-color-5 bg-color-6 rounded-lg" />
            </label>
            <button type="button" id="pay-consultation" 
                class="btn btn-lg bg-color-3 text-white w-full mt-4 hover:bg-color-2 transition-colors">
                Lanjutkan Pembayaran
            </button>
        </div>
    </div>
</div>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.clientKey') }}"></script>
<script type="text/javascript">
    document.getElementById('pay-consultation').onclick = function () {
        // Tampilkan loading
        document.getElementById('loading-payment').classList.remove('hidden');
        document.getElementById('payment-form').classList.add('opacity-50');
        this.disabled = true;

        const idTenagaAhli = '{{ $tenagaAhli->id }}';

        fetch('{{ route("konsultasi.generate.snaptoken") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: JSON.stringify({ id_tenaga_ahli: idTenagaAhli }),
        })
        .then((response) => {
            if (!response.ok) {
                return response.json().then((data) => {
                    throw new Error(data.error || 'Gagal mendapatkan Snap Token');
                });
            }
            return response.json();
        })
        .then((data) => {
            // Sembunyikan loading
            document.getElementById('loading-payment').classList.add('hidden');
            document.getElementById('payment-form').classList.remove('opacity-50');
            document.getElementById('pay-consultation').disabled = false;

            if (data.snap_token) {
                snap.pay(data.snap_token, {
                    onSuccess: function (result) {
                        fetch(`{{ url('/process-konsultasi-payment') }}/${data.transaction_id}`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            },
                            body: JSON.stringify({ payment_result: result }),
                        })
                        .then((response) => response.json())
                        .then((response) => {
                            if (response.success) {
                                const konsultasiId = response.konsultasi_id;
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: 'Anda akan diarahkan ke halaman percakapan konsultasi.',
                                    confirmButtonText: 'OK',
                                }).then(() => {
                                    window.location.href = `/konsultasi/chat/${konsultasiId}`;
                                });
                            } else {
                                throw new Error(response.message || 'Pembayaran gagal diproses.');
                            }
                        });
                    },
                    onPending: function (result) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Pending',
                            text: 'Silakan selesaikan pembayaran Anda.',
                            confirmButtonText: 'OK',
                        }).then(() => {
                            window.location.reload();
                        });
                    },
                    onError: function (result) {
                        fetch(`{{ url('/cancel-transaction') }}/${data.transaction_id}`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            },
                        })
                        .then((response) => response.json())
                        .then(() => {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: 'Pembayaran gagal. Status transaksi diperbarui.',
                                confirmButtonText: 'OK',
                            }).then(() => {
                                window.location.reload();
                            });
                        });
                    },
                    onClose: function () {
                        Swal.fire({
                            icon: 'info',
                            title: 'Dibatalkan',
                            text: 'Anda menutup pembayaran. Anda dapat melanjutkannya nanti.',
                            confirmButtonText: 'OK',
                        }).then(() => {
                            window.location.reload();
                        });
                    },
                });
            }
        })
        .catch((error) => {
            // Sembunyikan loading dan tampilkan pesan kesalahan
            document.getElementById('loading-payment').classList.add('hidden');
            document.getElementById('payment-form').classList.remove('opacity-50');
            document.getElementById('pay-consultation').disabled = false;

            Swal.fire({
                icon: 'error',
                title: 'Kesalahan',
                text: error.message,
                confirmButtonText: 'OK',
            }).then(() => {
                window.location.reload();
            });
        });
    };
</script>
@endsection