@extends('layouts.main_admin2')

@section('main')

<!-- halaman tambah data aktivitas positif -->
<div class="w-full p-5 rounded-2xl">

    <a href="/content-admin/aktivitas-positif" class="btn btn-sm bg-color-3 text-color-putih hover:bg-opacity-75 border-0">
        <img class="w-6 h-6" src="{{ asset("icons/back.svg")}}" alt="">
        Kembali
    </a>

    <h1 class="font-bold text-3xl text-center">Tambah Data Aktivitas Positif</h1>

    <!-- form tambah aktivitas -->
    <form action="{{ route('aktivitas-positif.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')

        <div class="flex flex-col gap-y-5 pt-10 p-10">

            <!-- nama -->
            <label class="form-control w-full">
                <span class="label-text font-medium text-base pb-1">Nama</span>
                <input type="text" name="nama" placeholder="Masukkan nama aktivitas" class="input input-bordered input-md w-full outline outline-1 outline-color-5 bg-color-6 rounded-lg" />
            </label>
            @error('nama')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
            <!-- nama -->

            <!-- gambar -->
            <label class="form-control w-full">
                <span class="label-text font-medium text-base pb-1">Gambar</span>
                <input type="file" name="gambar" class="file:bg-color-3 file:text-white file:text-sm file:border-none file:h-[3rem] file:mr-4 file:px-4 file:rounded-l-lg file:font-semibold file:uppercase border border-color-5 rounded-lg w-full bg-color-6" />
            </label>
            @error('gambar')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
            <!-- gambar -->

            <!-- tombol tambah -->
            <label class="flex justify-center items-center pt-5">
                <button type="submit" class="btn bg-color-3 text-white w-48">Tambah</button>
            </label>
            <!-- tombol tambah -->
    
        </div>
    </form>

</div>

@endsection
