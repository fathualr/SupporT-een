@extends('layouts.main_admin')

@section('main')

<div class="w-full p-5 rounded-2xl">

    <a href="/super-admin/pendapatan" class="btn btn-sm bg-color-3 text-color-putih hover:bg-opacity-75 border-0">
        <img class="w-6 h-6" src="{{ asset("icons/back.svg") }}" alt="">
        Kembali
    </a>

    <h1 class="font-bold text-3xl text-center">Persetujuan Permintaan Penarikan Pendapatan</h1>

    <form action="{{ route('pendapatan.update', $penarikan->id) }}" method="POST" enctype="multipart/form-data" class="p-10">
        @csrf
        @method('PUT')

        <!-- ID Penarikan (readonly) -->
        <label class="form-control w-full pt-5">
            <span class="label-text font-medium text-base pb-1">ID Penarikan</span>
            <input readonly value="{{ $penarikan->id }}" class="input input-bordered input-md w-full outline outline-1 outline-color-5 bg-color-6 rounded-lg" />
        </label>

        <!-- Email User (readonly) -->
        <label class="form-control w-full pt-5">
            <span class="label-text font-medium text-base pb-1">Email User</span>
            <input readonly value="{{ $penarikan->user->email ?? 'Tidak Diketahui' }}" class="input input-bordered input-md w-full outline outline-1 outline-color-5 bg-color-6 rounded-lg" />
        </label>

        <!-- Status Penarikan -->
        <label class="form-control w-full pt-5">
            <span class="label-text font-medium text-base pb-1">Status Penarikan</span>
            <select name="status" class="select select-bordered w-full outline outline-1 outline-color-5 bg-color-6 rounded-lg">
                <option value="menunggu" {{ $penarikan->status == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                <option value="disetujui" {{ $penarikan->status == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                <option value="ditolak" {{ $penarikan->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
            </select>
        </label>
        @error('status')
            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
        @enderror

        <!-- Bukti Transfer -->
        <label class="form-control w-full pt-5">
            <span class="label-text font-medium text-base pb-1">Bukti Transfer</span>
            <input type="file" name="bukti_transfer" class="file:bg-color-3 file:text-white file:text-sm file:border-none file:h-[3rem] file:mr-4 file:px-4 file:rounded-l-lg file:font-semibold file:uppercase border border-color-5 rounded-lg w-full bg-color-6">
            <small class="text-xs text-gray-500">*Opsional, hanya diunggah jika status disetujui</small>
            @if ($penarikan->bukti_transfer)
                <div class="pt-2">
                    <a href="{{ asset('storage/' . $penarikan->bukti_transfer) }}" class="text-blue-600 hover:underline" target="_blank">Lihat Bukti Transfer yang Diupload</a>
                </div>
            @endif
        </label>
        @error('bukti_transfer')
            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
        @enderror
        
        <div class="flex justify-center items-center mt-5">
            <button class="btn bg-color-3 text-white w-48">Perbarui</button>
        </div>

    </form>

</div>

@endsection
