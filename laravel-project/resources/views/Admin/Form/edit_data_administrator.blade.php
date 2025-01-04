@extends('layouts.main_admin')


@section('main')

<div class="w-full p-5 rounded-2xl">

    <a href="/super-admin/user-admin" class="btn btn-sm bg-color-3 text-color-putih hover:bg-opacity-75 border-0">
        <img class="w-6 h-6" src="{{ asset("icons/back.svg")}}" alt="">
        Kembali
    </a>
    
    <h1 class="font-bold text-3xl text-center">Edit Data Administrator</h1>
    <div class="pt-10 p-10">
        <form action="{{ route('user-admin.update', $admin->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <input type="hidden" name="role" value="admin">

            <label class="form-control w-full mt-5">
                <span class="label-text font-medium text-base pb-1">Email</span>
                <input type="email" name="email" value="{{ $admin->user->email }}" placeholder="Masukkan email Anda" class="input input-bordered input-md w-full outline outline-1 outline-color-5 bg-color-6 rounded-lg" />
            </label>
            @error('email')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror

            <label class="form-control w-full mt-5">
                <span class="label-text font-medium text-base pb-1">Password</span>
                <input type="password" name="password" id="passwordInput" placeholder="Isi jika ingin diubah" class="input input-bordered input-md w-full outline outline-1 outline-color-5 bg-color-6 rounded-lg hidden" />
            </label>
            <button type="button" id="toggleButton" class="btn outline outline-1 outline-color-5 bg-color-6 rounded-lg mt-2 w-full">
                Tampilkan Input
            </button>
            @error('password')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
            
            <label class="form-control w-full mt-5">
                <span class="label-text font-medium text-base pb-1">Nama</span>
                <input type="text" name="nama" value="{{ $admin->user->nama }}" placeholder="Masukkan nama lengkap Anda" class="input input-bordered input-md w-full outline outline-1 outline-color-5 bg-color-6 rounded-lg" />
            </label>
            @error('nama')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror

            <label class="form-control w-full mt-5">
                <span class="label-text font-medium text-base pb-1">Jenis Kelamin</span>
                <select name="jenis_kelamin" class="select select-bordered w-full  outline outline-1 outline-color-5 bg-color-6 rounded-lg">
                    <option disabled selected>Pilih jenis kelamin</option>
                    <option value="laki laki" {{ $admin->user->jenis_kelamin === 'laki laki' ? 'selected' : '' }}>Laki - Laki</option>
                    <option value="perempuan" {{ $admin->user->jenis_kelamin === 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </label>
            @error('jenis_kelamin')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror

            <label class="form-control w-full mt-5">
                <span class="label-text font-medium text-base pb-1">Tanggal Lahir</span>
                <input type="date" name="tanggal_lahir" value="{{ $admin->user->tanggal_lahir->format('Y-m-d') }}" placeholder="Type here" class="input input-bordered input-md w-full outline outline-1 outline-color-5 bg-color-6 rounded-lg" />
            </label>
            @error('tanggal_lahir')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror

            <label class="form-control w-full pt-5">
                <div class="label">
                    <span class="label-text font-medium text-base">Foto Profil</span>
                </div>
                <input type="file" name="foto_profil" class="file:bg-color-3 file:text-white file:text-sm file:border-none file:h-[3rem] file:mr-4 file:px-4 file:rounded-l-lg file:font-semibold file:uppercase border border-color-5 rounded-lg w-full bg-color-6">
            </label>
            @error('foto_profil')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
            
            <label class="form-control w-full mt-5">
                <span class="label-text font-medium text-base pb-1">Admin Role</span>
                <select name="admin_role" class="select select-bordered w-full  outline outline-1 outline-color-5 bg-color-6 rounded-lg">
                    <option disabled selected>Pilih role admin</option>
                    <option value="superadmin" {{ $admin->admin_role === 'superadmin' ? 'selected' : '' }}>Super Admin</option>
                    <option value="content admin" {{ $admin->admin_role === 'content admin' ? 'selected' : '' }}>Content Admin</option>
                </select>
            </label>
            @error('admin_role')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror

            <div class="flex justify-center items-center mt-5">
                <button class="btn bg-color-3 text-white w-48">Perbarui</button>
            </div>

        </form>
    </div>

</div>

<script>
    // Tangkap elemen tombol dan input
    const toggleButton = document.getElementById('toggleButton');
    const passwordInput = document.getElementById('passwordInput');

    // Tambahkan event listener ke tombol
    toggleButton.addEventListener('click', () => {
        if (passwordInput.classList.contains('hidden')) {
            passwordInput.classList.remove('hidden'); // Tampilkan input
            toggleButton.textContent = 'Sembunyikan Input'; // Ubah teks tombol
        } else {
            passwordInput.classList.add('hidden'); // Sembunyikan input
            toggleButton.textContent = 'Tampilkan Input'; // Kembalikan teks tombol
        }
    });
</script>

@endsection