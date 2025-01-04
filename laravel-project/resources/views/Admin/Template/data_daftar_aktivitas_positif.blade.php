@extends('layouts.main_admin2')

@section('main')

<div class="w-full p-5 rounded-2xl">

    <a href="/content-admin/aktivitas-positif" class="btn btn-sm bg-color-3 text-color-putih hover:bg-opacity-75 border-0">
        <img class="w-6 h-6" src="{{ asset("icons/back.svg")}}" alt="">
        Kembali
    </a>

    <h1 class="font-bold text-3xl text-center">Detail Data Aktivitas Positif</h1>

    <div class="p-10">

        <!-- Nama Aktivitas -->
        <label class="form-control w-full pt-5">
            <span class="label-text font-medium text-base pb-1">Nama Aktivitas</span>
            <input readonly value="{{ $aktivitasPositif->nama }}" class="input input-bordered input-md w-full outline outline-1 outline-color-5 bg-color-6 rounded-lg" />
        </label>

        <!-- Gambar Aktivitas -->
        <label class="form-control w-full pt-5">
            <span class="label-text font-medium text-base pb-1">Gambar</span>
            <!-- Preview Gambar -->
            <div class="w-full p-3">
                <img src="{{ asset('storage/' . $aktivitasPositif->gambar) }}" alt="Gambar Aktivitas" class="w-32 h-32 object-cover rounded-lg" />
            </div>
        </label>

    </div>
</div>
@endsection
