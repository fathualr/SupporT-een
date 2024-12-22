@extends('layouts.main_admin')

@section('main')

<div class="w-full p-5 rounded-2xl">

    <a href="/super-admin/data-konsultasi" class="btn btn-sm bg-color-3 text-color-putih hover:bg-opacity-75 border-0">
        <img class="w-6 h-6" src="{{ asset("icons/back.svg") }}" alt="">
        Kembali
    </a>

    <h1 class="font-bold text-3xl text-center">Detail Konsultasi</h1>

    <div class="p-10">

        <!-- ID Konsultasi -->
        <label class="form-control w-full pt-5">
            <span class="label-text font-medium text-base pb-1">ID Konsultasi</span>
            <input readonly value="{{ $konsultasi->id }}" class="input input-bordered input-md w-full outline outline-1 outline-color-5 bg-color-6 rounded-lg" />
        </label>

        <!-- Pasien -->
        <label class="form-control w-full pt-5">
            <span class="label-text font-medium text-base pb-1">Email Pasien</span>
            <input readonly value="{{ $konsultasi->pasien->user->email ?? 'Tidak Diketahui' }}" class="input input-bordered input-md w-full outline outline-1 outline-color-5 bg-color-6 rounded-lg" />
        </label>

        <!-- Tenaga Ahli -->
        <label class="form-control w-full pt-5">
            <span class="label-text font-medium text-base pb-1">Email Tenaga Ahli</span>
            <input readonly value="{{ $konsultasi->tenagaAhli->user->email ?? 'Tidak Diketahui' }}" class="input input-bordered input-md w-full outline outline-1 outline-color-5 bg-color-6 rounded-lg" />
        </label>

        <!-- Pesan Tenaga Ahli -->
        <label class="form-control w-full pt-5">
            <span class="label-text font-medium text-base pb-1">Pesan Tenaga Ahli</span>
            <textarea readonly class="textarea textarea-bordered w-full outline outline-1 outline-color-5 bg-color-6 rounded-lg">{{ $konsultasi->pesan_tenaga_ahli ?? 'Tidak Ada Pesan' }}</textarea>
        </label>

        <!-- Status Konsultasi -->
        <label class="form-control w-full pt-5">
            <span class="label-text font-medium text-base pb-1">Status</span>
            <input readonly value="{{ ucfirst($konsultasi->status) }}" class="input input-bordered input-md w-full outline outline-1 outline-color-5 bg-color-6 rounded-lg" />
        </label>

        <!-- Waktu Mulai -->
        <label class="form-control w-full pt-5">
            <span class="label-text font-medium text-base pb-1">Waktu Mulai</span>
            <input readonly value="{{ $konsultasi->started_at ? $konsultasi->started_at->format('d-m-Y H:i:s') : '-' }}" class="input input-bordered input-md w-full outline outline-1 outline-color-5 bg-color-6 rounded-lg" />
        </label>

        <!-- Waktu Selesai -->
        <label class="form-control w-full pt-5">
            <span class="label-text font-medium text-base pb-1">Waktu Selesai</span>
            <input readonly value="{{ $konsultasi->ends_at ? $konsultasi->ends_at->format('d-m-Y H:i:s') : '-' }}" class="input input-bordered input-md w-full outline outline-1 outline-color-5 bg-color-6 rounded-lg" />
        </label>

    </div>
</div>
@endsection
