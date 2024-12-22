@extends('layouts.main')

@section('aside')

<!-- konten sidebar -->
<div class="flex flex-col mx-auto w-full h-auto mt-9 px-12 gap-y-6">
    <h1 class="text-2xl xl:text-4xl font-bold text-color-1 w-full">Konsultasi</h1>
    <div class="divider m-0"></div>

    <h1 class="text-2xl xl:text-4xl font-bold text-color-1">Riwayat Konsultasi</h1>

    <div class="w-full h-full overflow-x-hidden">
        @include('pasien.Components.riwayat_konsultasi')
    </div>

</div>
<!-- konten sidebar -->

@endsection

@section('main')
<!-- daftar konsultasi tenaga ahli -->
<div class="w-full h-full">

        @if($selectedTenagaAhli)

        <a href="/konsultasi" class="btn btn-sm mb-3 bg-color-4 text-color-putih hover:bg-color-2 border-0 w-fit">
            <img class="w-6 h-6" src="{{ asset("icons/back.svg")}}" alt="">
            Kembali
        </a>
            <div class="card h-fit card-compact bg-color-6">
                <div class="flex flex-row gap-5 p-5">
                    <figure class="flex-none">
                        <img
                        class="w-[250px] h-[250px] rounded-2xl object-cover"
                        src="{{ $selectedTenagaAhli->user->foto_profil ? asset('storage/'.$selectedTenagaAhli->user->foto_profil) : asset('images/dummy.png') }}"
                        alt="Profile Image" />
                    </figure>
                    <div class="flex flex-col justify-around w-full">
                        <h2 class="card-title text-color-1 font-bold text-3xl">{{ $selectedTenagaAhli->user->nama }}</h2>
                        <table class="w-full text-left border-collapse">
                            <tr>
                                <td class="font-semibold text-color-2 text-lg">Nomor STR</td>
                                <td>:</td>
                                <td class="text-color-2 text-lg">{{ $selectedTenagaAhli->nomor_str }}</td>
                            </tr>
                            <tr>
                                <td class="font-semibold text-color-2 text-lg">Spesialisasi</td>
                                <td>:</td>
                                <td class="text-color-2 text-lg">{{ $selectedTenagaAhli->spesialisasi }}</td>
                            </tr>
                            <tr>
                                <td class="font-semibold text-color-2 text-lg">Lokasi Praktik</td>
                                <td>:</td>
                                <td class="text-color-2 text-lg">{{ $selectedTenagaAhli->lokasi_praktik }}</td>
                            </tr>
                            <tr>
                                <td class="font-semibold text-color-2 text-lg">Jadwal Aktif</td>
                                <td>:</td>
                                <td class="text-color-2 text-lg">{{ $selectedTenagaAhli->jadwal_aktif }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="divider m-0"></div>
                <div class="flex-1 card-body justify-between">
                    @if(!$selectedTenagaAhli->riwayatPendidikan->isEmpty())
                        <h3 class="text-color-1 font-bold text-xl">Riwayat Pendidikan</h3>
                        <ul class="list-disc pl-5">
                            @foreach($selectedTenagaAhli->riwayatPendidikan as $riwayat)
                            <li class="text-color-2 text-lg">{{ $riwayat->keterangan }}</li>
                            @endforeach
                        </ul>
                    @endif
            
                    <div class="bg-color-5 p-5">
                        <p class="font-semibold text-color-1 text-xl">Biaya Konsultasi: Rp.{{ number_format($selectedTenagaAhli->biaya_konsultasi, 0, ',', '.') }}</p>
                    </div>
            
                    <!-- Tombol -->
                    <div class="mt-4">
                        @if($selectedTenagaAhli->is_available)
                            <a href="{{ route('pembayaran.konsultasi', $selectedTenagaAhli->id) }}" class="btn btn-lg bg-color-3 border-[1px] border-color-5 text-white w-full">
                                Chat Sekarang
                            </a>
                        @else
                            <button class="btn btn-lg cursor-not-allowed bg-color-4 border-[1px] border-color-5 text-white w-full">
                                Offline
                            </button>
                        @endif
                    </div>
                </div>
            </div>

        @else

            <a href="/" class="btn btn-sm mb-3 bg-color-4 text-color-putih hover:bg-color-2 border-0 w-fit">
                <img class="w-6 h-6" src="{{ asset("icons/back.svg")}}" alt="">
                Kembali
            </a>
            <div class="grid grid-cols-2 gap-4 pb-8">

                @foreach ($tenagaAhli as $ahli)
                <button onclick="window.location.href='{{ route('konsultasi.index', $ahli->id) }}'" class="card card-side h-[180px] card-compact bg-color-6 pl-5">
                    <figure class="flex-none">
                        <img
                        class="w-[150px] h-[150px] rounded-2xl"
                        src="{{ $ahli->user->foto_profil ? asset('storage/'.$ahli->user->foto_profil) : asset('images/dummy.png') }}"
                        alt="Profile Image" />
                    </figure>
                    <div class="flex-1 card-body justify-between">
                        <h2 class="card-title text-color-1 font-bold">{{ Str::limit($ahli->user->nama,30,'...')}}</h2>
                        <p class="text-color-2">{{ $ahli->spesialisasi }}</p>
                        <div class=" justify-start">
                            <p class="font-semibold text-color-1">Rp.{{ number_format($ahli->biaya_konsultasi, 0, ',', '.') }}</p>

                            @if($ahli->is_available)
                                <a href="{{ route('pembayaran.konsultasi', $ahli->id) }}" class="btn btn-sm bg-color-3 border-[1px] border-color-5 text-white w-full">
                                    Chat
                                </a>
                            @else
                                <a onclick="event.stopPropagation();" type="button" 
                                        class="btn btn-sm cursor-not-allowed bg-color-4 border-[1px] border-color-5 text-white w-full">
                                    Offline
                                </a>
                            @endif

                        </div>
                    </div>
                </button>
                @endforeach

            </div>

        @endif

</div>
<!-- daftar konsultasi tenaga ahli -->

@endsection