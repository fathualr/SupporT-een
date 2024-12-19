@extends('layouts.main_admin')

@section('main')

<!-- halaman dashboard super admin -->
<div class="flex flex-col gap-4 ">
    <h1 class="text-[2rem] text-color-1 font-bold">Dashboard</h1>

    <div class="grid grid-cols-12 gap-6">

        <div class="card card-compact col-span-4 bg-color-6 border-[1px] border-color-5">
            <div class="card-body">
                <img class="w-10 h-10" src="{{ asset('icons/Manager.svg') }}" alt="">
                <span class="text-base text-color-1">Total Admin</span>
                <div class="card-actions items-center justify-between">
                    <span class="text-[2.5rem] text-color-1 font-bold">
                        {{ $totalAdmin }}
                    </span>
                    <a href="{{ route('user-admin.index') }}" class="btn btn-ghost">
                        <img class="w-[30xp] h-[30px]" src="{{ asset('icons/arrow.svg') }}" alt="">
                    </a>
                </div>
            </div>
        </div>

        <div class="card card-compact col-span-4 bg-color-6 border-[1px] border-color-5">
            <div class="card-body">
                <img class="w-10 h-10" src="{{ asset('icons/Medical_Doctor.svg') }}" alt="">
                <span class="text-base text-color-1">Total Tenaga Ahli</span>
                <div class="card-actions items-center justify-between">
                    <span class="text-[2.5rem] text-color-1 font-bold">
                        {{ $totalTenagaAhli }}
                    </span>
                    <a href="{{ route('user-tenaga-ahli.index') }}" class="btn btn-ghost">
                        <img class="w-[30xp] h-[30px]" src="{{ asset('icons/arrow.svg') }}" alt="">
                    </a>
                </div>
            </div>
        </div>

        <div class="card card-compact col-span-4 bg-color-6 border-[1px] border-color-5">
            <div class="card-body">
                <img class="w-10 h-10" src="{{ asset('icons/People.svg') }}" alt="">
                <span class="text-base text-color-1">Total Pasien</span>
                <div class="card-actions items-center justify-between">
                    <span class="text-[2.5rem] text-color-1 font-bold">
                        {{ $totalPasien }}
                    </span>
                    <a href="{{ route('user-pasien.index') }}" class="btn btn-ghost">
                        <img class="w-[30xp] h-[30px]" src="{{ asset('icons/arrow.svg') }}" alt="">
                    </a>
                </div>
            </div>
        </div>

        <div class="card card-compact col-span-3 bg-color-6 border-[1px] border-color-5">
            <div class="card-body">
                <img class="w-10 h-10" src="{{ asset('icons/Membership.svg') }}" alt="">
                <span class="text-base text-color-1">Total Pelanggan Aktif</span>
                <div class="card-actions items-center justify-between">
                    <span class="text-[2.5rem] text-color-1 font-bold">
                        {{ $totalPelanggan }}
                    </span>
                    <a href="{{ route('subscription-user.index') }}" class="btn btn-ghost">
                        <img class="w-[30xp] h-[30px]" src="{{ asset('icons/arrow.svg') }}" alt="">
                    </a>
                </div>
            </div>
        </div>

        <div class="card card-compact col-span-3 bg-color-6 border-[1px] border-color-5">
            <div class="card-body">
                <img class="w-10 h-10" src="{{ asset('icons/Purchase_Order.svg') }}" alt="">
                <span class="text-base text-color-1">Total Transaksi Langganan</span>
                <div class="card-actions items-center justify-between">
                    <span class="text-[2.5rem] text-color-1 font-bold">
                        {{ $totalTransaksiLangganan }}
                    </span>
                    <a href="{{ route('subscription-transaction.index') }}" class="btn btn-ghost">
                        <img class="w-[30xp] h-[30px]" src="{{ asset('icons/arrow.svg') }}" alt="">
                    </a>
                </div>
            </div>
        </div>

        <div class="card card-compact col-span-3 bg-color-6 border-[1px] border-color-5">
            <div class="card-body">
                <img class="w-10 h-10" src="{{ asset('icons/Konsultasi.svg') }}" alt="">
                <span class="text-base text-color-1">Total Konsultasi Aktif</span>
                <div class="card-actions items-center justify-between">
                    <span class="text-[2.5rem] text-color-1 font-bold">
                        {{ $totalKonsultasi }}
                    </span>
                    <a href="{{ route('konsultasi.index') }}" class="btn btn-ghost">
                        <img class="w-[30xp] h-[30px]" src="{{ asset('icons/arrow.svg') }}" alt="">
                    </a>
                </div>
            </div>
        </div>

        <div class="card card-compact col-span-3 bg-color-6 border-[1px] border-color-5">
            <div class="card-body">
                <img class="w-10 h-10" src="{{ asset('icons/Purchase_Order.svg') }}" alt="">
                <span class="text-base text-color-1">Total Transaksi Konsultasi</span>
                <div class="card-actions items-center justify-between">
                    <span class="text-[2.5rem] text-color-1 font-bold">
                        {{ $totalTransaksiKonsultasi }}
                    </span>
                    <a href="{{ route('transaksi.index') }}" class="btn btn-ghost">
                        <img class="w-[30xp] h-[30px]" src="{{ asset('icons/arrow.svg') }}" alt="">
                    </a>
                </div>
            </div>
        </div>

        <div class="col-span-12 flex flex-col items-center bg-color-6 border-[1px] border-color-5 w-full rounded-2xl p-5 gap-2">
            <h1 class="text-3xl font-medium text-color-1">Total Pendapatan</h1>
            <p class="text-color-1 text-5xl font-bold">{{ $totalAmountPaid }}</p>
        </div>
    </div>
</div>

@endsection