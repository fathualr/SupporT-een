@extends('layouts.main_admin')

@section('main')

<div class="w-full p-5 rounded-2xl">

    <a href="/super-admin/pendapatan" class="btn btn-sm bg-color-3 text-color-putih hover:bg-opacity-75 border-0">
        <img class="w-6 h-6" src="{{ asset("icons/back.svg") }}" alt="">
        Kembali
    </a>

    <h1 class="font-bold text-3xl text-center">Detail Permintaan Penarikan Pendapatan</h1>

    <div class="p-10">

        <!-- ID Penarikan -->
        <label class="form-control w-full pt-5">
            <span class="label-text font-medium text-base pb-1">ID Penarikan</span>
            <input readonly value="{{ $penarikan->id }}" class="input input-bordered input-md w-full outline outline-1 outline-color-5 bg-color-6 rounded-lg" />
        </label>

        <!-- Email User -->
        <label class="form-control w-full pt-5">
            <span class="label-text font-medium text-base pb-1">Email User</span>
            <input readonly value="{{ $penarikan->user->email ?? 'Tidak Diketahui' }}" class="input input-bordered input-md w-full outline outline-1 outline-color-5 bg-color-6 rounded-lg" />
        </label>

        <!-- Jumlah Penarikan -->
        <label class="form-control w-full pt-5">
            <span class="label-text font-medium text-base pb-1">Jumlah Penarikan</span>
            <input readonly value="Rp. {{ number_format($penarikan->jumlah_penarikan, 2, ',', '.') }}" class="input input-bordered input-md w-full outline outline-1 outline-color-5 bg-color-6 rounded-lg" />
        </label>

        <!-- Penyedia Pembayaran -->
        <label class="form-control w-full pt-5">
            <span class="label-text font-medium text-base pb-1">Penyedia Pembayaran</span>
            <input readonly value="{{ $penarikan->provider }}" class="input input-bordered input-md w-full outline outline-1 outline-color-5 bg-color-6 rounded-lg" />
        </label>

        <!-- Nomor Tujuan -->
        <label class="form-control w-full pt-5">
            <span class="label-text font-medium text-base pb-1">Nomor Tujuan</span>
            <input readonly value="{{ $penarikan->nomor_tujuan }}" class="input input-bordered input-md w-full outline outline-1 outline-color-5 bg-color-6 rounded-lg" />
        </label>

        <!-- Bukti Buku Tabungan -->
        <label class="form-control w-full pt-5">
            <span class="label-text font-medium text-base pb-1">Bukti Buku Tabungan</span>
            <input readonly value="{{ $penarikan->bukti_buku_tabungan }}" class="input input-bordered input-md w-full outline outline-1 outline-color-5 bg-color-6 rounded-lg" />
        </label>

        <!-- Pesan Penarikan -->
        <label class="form-control w-full pt-5">
            <span class="label-text font-medium text-base pb-1">Pesan Penarikan</span>
            <input readonly value="{{ $penarikan->pesan_penarikan ?? 'Tidak ada pesan tambahan' }}" class="input input-bordered input-md w-full outline outline-1 outline-color-5 bg-color-6 rounded-lg" />
        </label>

        <!-- Bukti Transfer -->
        <label class="form-control w-full pt-5">
            <span class="label-text font-medium text-base pb-1">Bukti Transfer</span>
            @if ($penarikan->bukti_transfer)
                <a href="{{ asset('storage/' . $penarikan->bukti_transfer) }}" class="text-blue-600 hover:underline" target="_blank">Lihat Bukti Transfer</a>
            @else
                <input readonly value="Tidak ada bukti transfer" class="input input-bordered input-md w-full outline outline-1 outline-color-5 bg-color-6 rounded-lg" />
            @endif
        </label>

        <!-- Status -->
        <label class="form-control w-full pt-5">
            <span class="label-text font-medium text-base pb-1">Status Penarikan</span>
            <input readonly value="{{ ucfirst($penarikan->status) }}" class="input input-bordered input-md w-full outline outline-1 outline-color-5 bg-color-6 rounded-lg" />
        </label>

        <!-- Waktu Persetujuan -->
        <label class="form-control w-full pt-5">
            <span class="label-text font-medium text-base pb-1">Waktu Persetujuan</span>
            <input readonly value="{{ $penarikan->approved_at ? $penarikan->approved_at->format('d-m-Y H:i:s') : 'Belum Disetujui' }}" class="input input-bordered input-md w-full outline outline-1 outline-color-5 bg-color-6 rounded-lg" />
        </label>

        <!-- Tanggal Dibuat -->
        <label class="form-control w-full pt-5">
            <span class="label-text font-medium text-base pb-1">Tanggal Dibuat</span>
            <input readonly value="{{ $penarikan->created_at->format('d-m-Y H:i:s') }}" class="input input-bordered input-md w-full outline outline-1 outline-color-5 bg-color-6 rounded-lg" />
        </label>

        <!-- Tanggal Diperbarui -->
        <label class="form-control w-full pt-5">
            <span class="label-text font-medium text-base pb-1">Tanggal Diperbarui</span>
            <input readonly value="{{ $penarikan->updated_at->format('d-m-Y H:i:s') }}" class="input input-bordered input-md w-full outline outline-1 outline-color-5 bg-color-6 rounded-lg" />
        </label>

    </div>
</div>
@endsection
