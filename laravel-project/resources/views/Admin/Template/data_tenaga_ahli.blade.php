@extends('layouts.main_admin')

@section('main')

<div class="w-full p-5 rounded-2xl">

    <a href="/super-admin/user-tenaga-ahli" class="btn btn-sm bg-color-3 text-color-putih hover:bg-opacity-75 border-0">
        <img class="w-6 h-6" src="{{ asset("icons/back.svg")}}" alt="">
        Kembali
    </a>

    <h1 class="font-bold text-3xl text-center">Detail Data Tenaga Ahli</h1>

    <div class="p-10">

        <label class="form-control w-full pt-5">
            <span class="label-text font-medium text-base pb-1">Role</span>
            <input readonly value="{{ $tenagaAhli->user->role }}" class="input input-bordered input-md w-full outline outline-1 outline-color-5 bg-color-6 rounded-lg" />
        </label>

        <label class="form-control w-full pt-5">
            <span class="label-text font-medium text-base pb-1">Email</span>
            <input readonly value="{{ $tenagaAhli->user->email }}" class="input input-bordered input-md w-full outline outline-1 outline-color-5 bg-color-6 rounded-lg" />
        </label>

        <label class="form-control w-full pt-5">
            <span class="label-text font-medium text-base pb-1">Nama</span>
            <input readonly value="{{ $tenagaAhli->user->nama }}" class="input input-bordered input-md w-full outline outline-1 outline-color-5 bg-color-6 rounded-lg" />
        </label>

        <label class="form-control w-full pt-5">
            <span class="label-text font-medium text-base pb-1">Jenis Kelamin</span>
            <input readonly value="{{ $tenagaAhli->user->jenis_kelamin }}" class="input input-bordered input-md w-full outline outline-1 outline-color-5 bg-color-6 rounded-lg" />
        </label>

        <label class="form-control w-full pt-5">
            <span class="label-text font-medium text-base pb-1">Tanggal Lahir</span>
            <input readonly value="{{ $tenagaAhli->user->tanggal_lahir }}" class="input input-bordered input-md w-full outline outline-1 outline-color-5 bg-color-6 rounded-lg" />
        </label>

        <label class="form-control w-full pt-5">
            <span class="label-text font-medium text-base pb-1">Foto Profil</span>
            <!-- Preview -->
            <div class="w-full p-3">
                <img src="{{ $tenagaAhli->user->foto_profil ? asset('storage/' . $tenagaAhli->user->foto_profil) : asset('images/dummy.png') }}" alt="Thumbnail Konten" class="w-32 h-32 object-cover rounded-lg" />
            </div>
        </label>

        <label class="form-control w-full pt-5 ">
            <span class="label-text font-medium text-base pb-1">Nomor STR (Surat Tanda Registrasi )</span>
            <input readonly value="{{ $tenagaAhli->nomor_str }}" class="input input-bordered input-md w-full outline outline-1 outline-color-5 bg-color-6 rounded-lg" />
        </label>

        <label class="form-control w-full pt-5 ">
            <span class="label-text font-medium text-base pb-1">Spesialisasi</span>
            <input readonly value="{{ $tenagaAhli->spesialisasi }}" class="input input-bordered input-md w-full outline outline-1 outline-color-5 bg-color-6 rounded-lg" />
        </label>

        <label class="form-control w-full pt-5 ">
            <span class="label-text font-medium text-base pb-1">Jadwal Aktif</span>
            <input readonly value="{{ $tenagaAhli->jadwal_aktif }}" class="input input-bordered input-md w-full outline outline-1 outline-color-5 bg-color-6 rounded-lg" />
        </label>

        <label class="form-control w-full pt-5 ">
            <span class="label-text font-medium text-base pb-1">Lokasi Praktik</span>
            <input readonly value="{{ $tenagaAhli->lokasi_praktik }}" class="input input-bordered input-md w-full outline outline-1 outline-color-5 bg-color-6 rounded-lg" />
        </label>

        <label class="form-control w-full pt-5 ">
            <span class="label-text font-medium text-base pb-1">Riwayat Pendidikan</span>

            @foreach ($tenagaAhli->riwayatPendidikan as $key => $riwayatPendidikan)
                <input readonly value="{{ $riwayatPendidikan->keterangan }}" class="input input-bordered input-md w-full outline outline-1 outline-color-5 bg-color-6 rounded-lg mb-5" />
            @endforeach

        </label>

        <label class="form-control w-full">
            <span class="label-text font-medium text-base pb-1">Biaya Konsultasi</span>
            <input readonly value="{{ $tenagaAhli->biaya_konsultasi }}" class="input input-bordered input-md w-full outline outline-1 outline-color-5 bg-color-6 rounded-lg" />
        </label>

        <label class="form-control w-full pt-5">
            <span class="label-text font-medium text-base pb-1">Tanggal Dibuat</span>
            <input readonly value="{{ $tenagaAhli->user->created_at->format('d M Y, H:i') }}" class="input input-bordered input-md w-full outline outline-1 outline-color-5 bg-color-6 rounded-lg" />
        </label>

        <label class="form-control w-full pt-5">
            <span class="label-text font-medium text-base pb-1">Terakhir Update</span>
            <input readonly value="{{ $tenagaAhli->user->updated_at->format('d M Y, H:i') }}" class="input input-bordered input-md w-full outline outline-1 outline-color-5 bg-color-6 rounded-lg" />
        </label>

    </div>

</div>

@endsection