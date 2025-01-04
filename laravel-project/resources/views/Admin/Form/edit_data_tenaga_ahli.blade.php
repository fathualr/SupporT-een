@extends('layouts.main_admin')

@section('main')

<div class="w-full p-5 rounded-2xl">

    <a href="/super-admin/user-tenaga-ahli" class="btn btn-sm bg-color-3 text-color-putih hover:bg-opacity-75 border-0">
        <img class="w-6 h-6" src="{{ asset("icons/back.svg")}}" alt="">
        Kembali
    </a>

    <h1 class="font-bold text-3xl text-center">Edit Data Tenaga Ahli</h1>
    <div class="pt-10 p-10">

        <form action="{{ route('user-tenaga-ahli.update', $tenagaAhli->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <input type="hidden" name="role" value="tenaga ahli">

            <label class="form-control w-full mt-5">
                <span class="label-text font-medium text-base pb-1">Email</span>
                <input type="email" name="email" value="{{ $tenagaAhli->user->email }}" class="input input-bordered input-md w-full outline outline-1 outline-color-5 bg-color-6 rounded-lg" />
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
                <input type="text" name="nama" value="{{ $tenagaAhli->user->nama }}" class="input input-bordered input-md w-full outline outline-1 outline-color-5 bg-color-6 rounded-lg" />
            </label>
            @error('nama')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror

            <label class="form-control w-full mt-5">
                <span class="label-text font-medium text-base pb-1">Jenis Kelamin</span>
                <select name="jenis_kelamin" class="select select-bordered w-full  outline outline-1 outline-color-5 bg-color-6 rounded-lg">
                    <option disabled selected>Pilih jenis kelamin</option>
                    <option value="laki laki" {{ $tenagaAhli->user->jenis_kelamin === 'laki laki' ? 'selected' : '' }}>Laki - Laki</option>
                    <option value="perempuan" {{ $tenagaAhli->user->jenis_kelamin === 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </label>
            @error('jenis_kelamin')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror

            <label class="form-control w-full mt-5">
                <span class="label-text font-medium text-base pb-1">Tanggal Lahir</span>
                <input type="date" name="tanggal_lahir" value="{{ $tenagaAhli->user->tanggal_lahir->format('Y-m-d') }}" class="input input-bordered input-md w-full outline outline-1 outline-color-5 bg-color-6 rounded-lg" />
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
			
			<label class="form-control w-full pt-5 ">
				<span class="label-text font-medium text-base pb-1">Nomor STR (Surat Tanda Registrasi )</span>
				<input type="text" name="nomor_str" value="{{ $tenagaAhli->nomor_str }}" class="input input-bordered input-md w-full outline outline-1 outline-color-5 bg-color-6 rounded-lg" />
			</label>
			@error('nomor_str')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror

			<label class="form-control w-full pt-5 ">
				<span class="label-text font-medium text-base pb-1">Spesialisasi</span>
				<input type="text" name="spesialisasi" value="{{ $tenagaAhli->spesialisasi }}" class="input input-bordered input-md w-full outline outline-1 outline-color-5 bg-color-6 rounded-lg" />
			</label>
			@error('spesialisasi')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror

			<label class="form-control w-full pt-5 ">
				<span class="label-text font-medium text-base pb-1">Jadwal Aktif</span>
				<input type="text" name="jadwal_aktif" value="{{ $tenagaAhli->jadwal_aktif }}" class="input input-bordered input-md w-full outline outline-1 outline-color-5 bg-color-6 rounded-lg" />
			</label>
			@error('jadwal_aktif')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror

			<label class="form-control w-full pt-5 ">
				<span class="label-text font-medium text-base pb-1">Lokasi Praktik</span>
				<input type="text" name="lokasi_praktik" value="{{ $tenagaAhli->lokasi_praktik }}" class="input input-bordered input-md w-full outline outline-1 outline-color-5 bg-color-6 rounded-lg" />
			</label>
			@error('lokasi_praktik')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror

            <label class="form-control w-full pt-5">
				<span class="label-text font-medium text-base pb-1">Biaya Konsultasi</span>
				<input type="number" name="biaya_konsultasi" value="{{ $tenagaAhli->biaya_konsultasi }}" class="input input-bordered input-md w-full outline outline-1 outline-color-5 bg-color-6 rounded-lg" />
            </label>
			@error('biaya_konsultasi')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
            
            <input type="hidden" name="tabungan" value="{{ $tenagaAhli->tabungan }}">
            
            <div class="flex justify-center items-center mt-5">
                <button class="btn bg-color-3 text-white w-48">Perbarui</button>
            </div>
            
        </form>
        <div class="divider"></div>

        <label class="form-control w-full pt-5 ">
            <span class="label-text font-medium text-base pb-1">Riwayat Pendidikan</span>

            @foreach ($tenagaAhli->riwayatPendidikan as $key => $riwayatPendidikan)
            <div class="flex gap-x-3">
                <input readonly value="{{ $riwayatPendidikan->keterangan }}" class="input input-bordered input-md w-full outline outline-1 outline-color-5 bg-color-6 rounded-lg mb-5" />
                <form action="{{ route('riwayat-pendidikan-tenaga-ahli.destroy', $riwayatPendidikan->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn bg-red-100 text-red-500 border-red-500">
                        <img class="w-6 h-6" src="{{ asset('icons/Waste.svg') }}" alt="">
                    </button>
                </form>
            </div>
            @endforeach

            <form action="{{ route('riwayat-pendidikan-tenaga-ahli.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('POST')

                <label class="form-control w-full">
                    <input type="hidden" name="id_tenaga_ahli" value="{{ $tenagaAhli->id }}">
                    <input type="text" name="keterangan" placeholder="Masukkan riwayat pendidikan" class="input input-bordered input-md w-full outline outline-1 outline-color-5 bg-color-6 rounded-lg" />
                </label>
                @error('keterangan')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror

                <div class="flex justify-center items-center mt-5">
                    <button class="btn bg-color-3 text-white w-48">Tambah</button>
                </div>

            </form>
        </label>
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