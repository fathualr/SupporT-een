@extends('layouts.main')

@section('aside')

<div class="flex flex-col mx-auto w-full h-full pt-9 px-[50px] gap-6">

    <h1 class="text-4xl font-bold text-color-1 text-start">Pendapatan</h1>
    <a href="{{ route('pendapatan.create') }}" class="btn flex justify-start bg-color-6 hover:bg-color-5 hover:border-color-3 text-base">
        <img src="{{ asset('icons/Request_Money.svg') }}" alt="">
        Penarikan
    </a>

    <h1 class="text-4xl font-bold text-color-1 text-start">Riwayat Penarikan</h1>

    <div class="flex flex-col w-full h-full gap-1">

        @include('TenagaAhli.Components.riwayat_penarikan_saldo')

    </div>

</div>

@endsection

@section('main')

<div class="flex flex-col w-full h-full gap-4">

    <a href="/tenaga-ahli/" class="btn btn-sm mb-3 bg-color-4 text-color-putih hover:bg-color-2 border-0 w-fit">
        <img class="w-6 h-6" src="{{ asset("icons/back.svg")}}" alt="">
        Kembali
    </a>
    
    <div class="flex flex-col items-center bg-color-6 border-[1px] border-color-5 w-full py-16 rounded-2xl">
        <h1 class="text-[32px] font-medium text-color-1">Total Pendapatan</h1>
        <p class="text-color-1 text-[64px] font-bold">Rp. {{ number_format(Auth::user()->tenagaAhli->tabungan) }}</p>
    </div>
    <div class="bg-color-8 border-[1px] border-color-4 w-full p-5 rounded-2xl">
        <div class="overflow-y-auto h-[calc(100vh-460px)]">
            <table class="table table-xs text-center">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Pasien</th>
                        <th>Pendapatan</th>
                        <th>Waktu</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($transaksi as $key => $item)
                        <tr>
                            <th>{{ ($transaksi->currentPage() - 1) * $transaksi->perPage() + $key + 1 }}</th>
                            <td>{{ $item->konsultasi->pasien->user->nama }}</td>
                            <td>Rp. {{ number_format($item->amount * 0.9, 2) }}</td>
                            <td>{{ $item->created_at->format('d-m-Y H:i:s') }}</td>
                        </tr>
                    @endforeach
                
                    @if ($transaksi->isEmpty())
                        <div class="text-center py-4 text-color-2">
                            <p>Belum ada pendapatan!</p>
                        </div>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>


@endsection