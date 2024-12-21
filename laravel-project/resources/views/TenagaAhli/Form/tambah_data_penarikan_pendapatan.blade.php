@extends('layouts.main')

@section('aside')

<div class="flex flex-col mx-auto w-full h-full pt-9 px-[50px] gap-6">

    <h1 class="text-4xl font-bold text-color-1 text-start">Pendapatan</h1>

    <div class="divider m-0"></div>

    <h1 class="text-4xl font-bold text-color-1 text-start">Riwayat Penarikan</h1>

    <div class="flex flex-col w-full h-full gap-1">

        @include('TenagaAhli.Components.riwayat_penarikan_saldo')

    </div>

</div>

@endsection

@section('main')
<div class="flex flex-col w-full h-full">

    <a href="/tenaga-ahli/pendapatan" class="btn btn-sm mb-3 bg-color-4 text-color-putih hover:bg-color-2 border-0 w-fit">
        <img class="w-6 h-6" src="{{ asset("icons/back.svg")}}" alt="">
        Kembali
    </a>
    
    <div class=" bg-color-8 p-4 border-[1px] border-color-4 rounded-2xl">
        <h1 class="font-bold text-3xl text-center">Ajukan Penarikan Pendapatan</h1>
    
        <form action="{{ route('pendapatan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="flex flex-col items-center gap-y-5 pt-10 p-10">
                
                <!-- Jumlah Penarikan -->
                <label class="form-control w-full">
                    <span class="label-text font-medium text-base pb-1">Jumlah Penarikan</span>
                    <input type="number" name="jumlah_penarikan" placeholder="Masukkan jumlah penarikan" step="0.01" class="input input-bordered input-md w-full outline outline-1 outline-color-5 bg-color-6 rounded-lg" />
                </label>
                @error('jumlah_penarikan')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
                <!-- Jumlah Penarikan -->
        
                <!-- Provider -->
                <label class="form-control w-full">
                    <span class="label-text font-medium text-base pb-1">Provider Bank/E-wallet</span>
                    <input type="text" name="provider" placeholder="Masukkan nama provider" class="input input-bordered input-md w-full outline outline-1 outline-color-5 bg-color-6 rounded-lg" />
                </label>
                @error('provider')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
                <!-- Provider -->
        
                <!-- Nomor Tujuan -->
                <label class="form-control w-full">
                    <span class="label-text font-medium text-base pb-1">Nomor Tujuan</span>
                    <input type="text" name="nomor_tujuan" placeholder="Masukkan nomor tujuan" class="input input-bordered input-md w-full outline outline-1 outline-color-5 bg-color-6 rounded-lg" />
                </label>
                @error('nomor_tujuan')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
                <!-- Nomor Tujuan -->
        
                <!-- Bukti Buku Tabungan -->
                <label class="form-control w-full">
                    <span class="label-text font-medium text-base pb-1">Unggah Bukti Buku Tabungan</span>
                    <input type="file" name="bukti_buku_tabungan" class="file:bg-color-3 file:text-white file:text-sm file:border-none file:h-[3rem] file:mr-4 file:px-4 file:rounded-l-lg file:font-semibold file:uppercase border border-color-5 rounded-lg w-full bg-color-6" />
                </label>
                @error('bukti_buku_tabungan')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
                <!-- Bukti Buku Tabungan -->
        
                <!-- Pesan Penarikan -->
                <label class="form-control w-full">
                    <span class="label-text font-medium text-base pb-1">Pesan Penarikan</span>
                    <textarea name="pesan_penarikan" class="textarea textarea-bordered h-40 outline outline-1 outline-color-5 bg-color-6 rounded-lg w-full" placeholder="Tambahkan pesan penarikan (opsional)"></textarea>
                </label>
                @error('pesan_penarikan')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
                <!-- Pesan Penarikan -->
        
                <!-- Tombol Ajukan -->
                <label class="flex justify-center items-center mt-5 w-fit">
                    <button type="submit" class="btn bg-color-3 text-white w-48">Ajukan</button>
                </label>
            </div>
        </form>
    </div>
    
</div>
@endsection