@extends('layouts.main_admin')

@section('main')

<div class="w-full p-5 rounded-2xl">

    <a href="/super-admin/transaksi" class="btn btn-sm bg-color-3 text-color-putih hover:bg-opacity-75 border-0">
        <img class="w-6 h-6" src="{{ asset("icons/back.svg") }}" alt="">
        Kembali
    </a>

    <h1 class="font-bold text-3xl text-center">Detail Transaksi Langganan</h1>

    <div class="p-10">

        <!-- ID Transaksi -->
        <label class="form-control w-full pt-5">
            <span class="label-text font-medium text-base pb-1">ID Transaksi</span>
            <input readonly value="{{ $transaksi->id }}" class="input input-bordered input-md w-full outline outline-1 outline-color-5 bg-color-6 rounded-lg" />
        </label>

        <!-- Nama User -->
        <label class="form-control w-full pt-5">
            <span class="label-text font-medium text-base pb-1">Email User</span>
            <input readonly value="{{ $transaksi->user->email ?? 'Tidak Diketahui' }}" class="input input-bordered input-md w-full outline outline-1 outline-color-5 bg-color-6 rounded-lg" />
        </label>

        <!-- Snap Token -->
        <label class="form-control w-full pt-5">
            <span class="label-text font-medium text-base pb-1">Snap Token</span>
            <input readonly value="{{ $transaksi->snap_token }}" class="input input-bordered input-md w-full outline outline-1 outline-color-5 bg-color-6 rounded-lg" />
        </label>

        <!-- Jumlah Pembayaran -->
        <label class="form-control w-full pt-5">
            <span class="label-text font-medium text-base pb-1">Biaya Tenaga Ahli</span>
            <input readonly value="Rp. {{ number_format($transaksi->amount * 0.9, 2, ',', '.') }}" class="input input-bordered input-md w-full outline outline-1 outline-color-5 bg-color-6 rounded-lg" />
        </label>

        <!-- Metode Pembayaran -->
        <label class="form-control w-full pt-5">
            <span class="label-text font-medium text-base pb-1">Metode Pembayaran</span>
            <input readonly value="{{ $transaksi->payment_method ?? 'Belum Ditentukan' }}" class="input input-bordered input-md w-full outline outline-1 outline-color-5 bg-color-6 rounded-lg" />
        </label>

        <!-- Jumlah Pembayaran -->
        <label class="form-control w-full pt-5">
            <span class="label-text font-medium text-base pb-1">Biaya Admin</span>
            <input readonly value="Rp. {{ number_format($transaksi->amount *0.1, 2, ',', '.') }}" class="input input-bordered input-md w-full outline outline-1 outline-color-5 bg-color-6 rounded-lg" />
        </label>

        <!-- Status -->
        <label class="form-control w-full pt-5">
            <span class="label-text font-medium text-base pb-1">Status</span>
            <input readonly value="{{ ucfirst($transaksi->status) }}" class="input input-bordered input-md w-full outline outline-1 outline-color-5 bg-color-6 rounded-lg" />
        </label>
        
        <!-- Tanggal Dibuat -->
        <label class="form-control w-full pt-5">
            <span class="label-text font-medium text-base pb-1">Tanggal Dibuat</span>
            <input readonly value="{{ $transaksi->created_at->format('d-m-Y H:i:s') }}" class="input input-bordered input-md w-full outline outline-1 outline-color-5 bg-color-6 rounded-lg" />
        </label>

        <!-- Tanggal Diperbarui -->
        <label class="form-control w-full pt-5">
            <span class="label-text font-medium text-base pb-1">Tanggal Diperbarui</span>
            <input readonly value="{{ $transaksi->updated_at->format('d-m-Y H:i:s') }}" class="input input-bordered input-md w-full outline outline-1 outline-color-5 bg-color-6 rounded-lg" />
        </label>

    </div>
</div>
@endsection
