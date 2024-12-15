<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <title>{{ $title }}</title>
    <link rel="icon" type="image/svg+xml" href=" {{ asset('images/logo-icon.svg') }} ">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Space+Grotesk:wght@300..700&display=swap" rel="stylesheet">
</head>
<body class="font-poppins text-color-1 select-none">

    @include('Components.loader')

    <!-- Navbar -->
    <header class="sticky top-0 z-[70]">
        <div class="flex flex-row items-center justify-between h-12 px-1 md:h-20 xl:py-[0.938rem] xl:px-[3.125rem] bg-color-8 border-b border-color-4">
            <div class="flex items-center">
                <!-- Tombol Menu Burger -->
                <div class="lg:hidden">
                    <button 
                        type="button" 
                        class="py-3 px-1 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent text-black disabled:opacity-50 disabled:pointer-events-none" 
                        aria-haspopup="dialog" 
                        aria-expanded="false" 
                        aria-controls="hs-offcanvas-example" 
                        data-hs-overlay="#hs-offcanvas-example">
                        <img class="md:size-14" src="{{ asset('icons/burger-menu.svg') }}" alt="Menu">
                    </button>
                </div>

                <!-- nav link logo -->
                <div>
                    <a href="{{ Auth::check() && Auth::user()->role === 'tenaga ahli' ? '/tenaga-ahli' : '/' }}" class="flex flex-row items-center">
                        <img class="size-[1.875rem] me-0.5 md:size-12 xl:size-[3.125rem] md:me-2 xl:me-[0.938rem]" src=" {{ asset('images/logo-dark-blue.svg') }} " alt="SupporT-een Logo">
                        <span class="my-auto text-xs md:text-2xl xl:text-[2rem]">SupporT-een</span>
                    </a>
                </div>
            </div>

            <div class="flex items-center justify-center select-none" id="flash-message-place">
                @include('Components.flash-message')
                @auth
                    @if(Auth::user()->role === 'pasien' && !Auth::user()->isPremium() || Auth::user()->isPremium() && Auth::user()->premiumEndingSoon())
                        <div id="card" class="absolute -top-[17.375rem] md:-top-[317px] lg:-top-[332px] xl:-top-[320px] left-1/2 transform -translate-x-1/2 -translate-y-1 bg-color-1 shadow-lg rounded-lg p-3 w-full max-w-sm md:max-w-[31.25rem] text-center transition-all duration-300 text-color-putih hover:translate-y-80  md:hover:translate-y-[390px] z-20">
                            <!-- Konten Card -->
                            <!-- Badge atau Tagline -->
                            <div class="flex justify-center mb-4">
                                <span class="px-3 py-1 text-xs font-bold uppercase bg-color-3 text-color-putih rounded-full shadow-sm">
                                    Spesial Premium
                                </span>
                            </div>
                            <p class="mb-4 text-xs md:text-base xl:text">
                                Nikmati fitur eksklusif kami dengan berlangganan. Dapatkan akses premium hari ini dan tingkatkan pengalaman Anda!
                            </p>
                            <div class="flex justify-center mb-6">
                                <svg class="flex-shrink-0 size-12 md:size-16 lg:size-20 text-color-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                                </svg>
                            </div>
                            <label for="membership" class="btn w-full py-2 px-4 text-sm md:text-base lg:text-xl xl:text-2xl font-bold text-color-1 rounded-lg bg-color-6 hover:bg-color-5 transition duration-300">
                                Berlangganan Sekarang!
                            </label>
                            <div class="divider mb-0"></div>
                            <div class="flex absolute bg-color-1 -bottom-7 md:-bottom-10  lg:-bottom-12 left-1/2 transform -translate-x-1/2 px-3 pt-3 md:px-5 md:py-2 lg:pt-3 pb-1 rounded-lg shadow-lg">
                                <p class="flex font-medium text-sm md:text-xl lg:text-3xl items-center">PREM</p>
                                <img class="size-6 lg:size-10 xl:size-[3.125rem]" src="{{ asset('icons/Guarantee.svg') }}">
                                <p class="flex font-medium text-sm md:text-xl lg:text-3xl items-center">UM</p>
                            </div>
                        </div>
                        
                        @include('Components.subscription')
                    @endif
                @endauth
            </div>

            @if($title != "Login" && $title != "Registrasi")
                @guest
                <!-- button login -->
                    <a href="/login" class="btn btn-sm md:btn-md xl:w-[150px] text-white bg-color-3 border-0 hover:bg-color-6 hover:text-color-1 hover:border hover:border-color-4 text-sm">
                        <span class="font-medium text-base md:text-xl text-blue">Masuk</span>
                    </a>
                @else
                <!-- profile -->
                    <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown" xmlns="http://www.w3.org/2000/svg" class="btn btn-sm md:btn-md flex-col justify-center place-content-start justify w-full max-w-40 md:max-w-40 lg:max-w-[15.625rem] lg:px-[10px] text-color-1 bg-color-6 border border-color-6 hover:bg-color-6  hover:border hover:border-color-5 relative">
                        <div class="avatar self-center">
                            <div class="w-6 md:w-8 rounded-full">
                                <img src="{{ Auth::user()->foto_profil ? asset('storage/' . Auth::user()->foto_profil) : asset('images/dummy.png') }}" />
                            </div>
                        </div>
                        <div class="flex flex-col justify-around me-auto h-full grow text-left text-xs lg:text-base max-w-14 md:max-w-20 lg:max-w-40">
                            <p class="truncate text-ellipsis overflow-hidden whitespace-nowrap">
                                {{ Auth::user()->nama }}
                            </p>
                            <div class="flex justify-between items-center">
                                <span class="text-color-3">Online</span>
                                {!! Auth::user()->isPremium() ?'<span class="text-color-putih bg-color-3 px-2 rounded-lg">Premium</span>' : ''!!}
                            </div>
                        </div>
                    </button>
                    
                    <!-- Dropdown menu -->
                    <div id="dropdown" class="z-10 hidden bg-color-6 divide-y divide-gray-100 border border-color-6 rounded-lg shadow w-full max-w-28 md:max-w-40 lg:max-w-[15.625rem]">
                        <ul class="text-sm text-gray-700 font-medium" aria-labelledby="dropdownDefaultButton">
                            <li>
                                <!-- button profile -->
                                <a href="/profile" class="block px-4 py-2  hover:bg-gray-100 hover:rounded-lg w-full text-center">
                                    Profile
                                </a>
                            </li>
                            <li>
                                <!-- button logout -->
                                <form class="" action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="block px-4 py-2  hover:bg-gray-100 hover:rounded-lg w-full text-center">
                                        Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
    
                @endguest
            @else
                <!-- Div Placeholder -->
                <div class="w-[250px]"></div>
            @endif

        </div>
    </header>

    <main>
        
        <!-- offcanvas -->
        <div 
        id="hs-offcanvas-example" 
        class="hs-overlay hidden fixed inset-y-0 left-0 transform -translate-x-full transition-all duration-500 ease-in-out z-[80] bg-white shadow-lg max-w-sm w-full lg:hidden" 
        role="dialog" 
        tabindex="-1" 
        aria-labelledby="hs-offcanvas-example-label">

        <!-- Header Offcanvas -->
        <div class="flex justify-between items-center py-3 px-4 border-b">
            <!-- logo -->
            <a href="{{ Auth::check() && Auth::user()->role === 'tenaga ahli' ? '/tenaga-ahli' : '/' }}" class="flex flex-row items-center">
                <img class="size-[1.875rem] me-0.5 md:size-12 xl:size-[3.125rem] md:me-2 xl:me-[0.938rem]" src=" {{ asset('images/logo-dark-blue.svg') }} " alt="SupporT-een Logo">
                <span class="my-auto text-xs md:text-2xl xl:text-[2rem]">SupporT-een</span>
            </a>

            <!-- tombol close -->
            <button 
                type="button" 
                class="inline-flex justify-center items-center rounded-full border bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-none focus:bg-gray-200" 
                aria-label="Close" 
                data-hs-overlay="#hs-offcanvas-example">
                <span class="sr-only">Close</span>
                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 6 6 18M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <!-- Content Offcanvas -->
        <div class="p-4">
            <div class="max-w-20 border-s-2 border-gray-200">
                <nav class="-ml-0.5 flex flex-col space-y-3">
                    <a class="py-1 ps-4 inline-flex items-center gap-2 border-s-2 border-transparent hover:border-cyan-500 focus:border-cyan-500 text-sm whitespace-nowrap text-gray-500 hover:text-color-3 focus:outline-none focus:text-color-3" 
                    href="/chatbot">
                    Teman Bot
                    </a>
                    <a class="py-1 ps-4 inline-flex items-center gap-2 border-s-2 border-transparent hover:border-cyan-500 focus:border-cyan-500 text-sm whitespace-nowrap text-gray-500 hover:text-color-3 focus:outline-none focus:text-color-3" 
                    href="/jurnal-harian">
                    Jurnal Harian
                    </a>
                    <a class="py-1 ps-4 inline-flex items-center gap-2 border-s-2 border-transparent hover:border-cyan-500 focus:border-cyan-500 text-sm whitespace-nowrap text-gray-500 hover:text-color-3 focus:outline-none focus:text-color-3" 
                    href="/konten-edukatif">
                    Konten Edukatif
                    </a>
                    <a class="py-1 ps-4 inline-flex items-center gap-2 border-s-2 border-transparent hover:border-cyan-500 focus:border-cyan-500 text-sm whitespace-nowrap text-gray-500 hover:text-color-3 focus:outline-none focus:text-color-3" 
                    href="/daftar-aktivitas-pribadi">
                    Daftar Aktivitas
                    </a>
                    <a class="py-1 ps-4 inline-flex items-center gap-2 border-s-2 border-transparent hover:border-cyan-500 focus:border-cyan-500 text-sm whitespace-nowrap text-gray-500 hover:text-color-3 focus:outline-none focus:text-color-3" 
                    href="/forum">
                    Forum Diskusi
                    </a>
                </nav>
            </div>
        </div>
        <!-- End Content Offcanvas -->
        </div>
        <!-- End Offcanvas -->
        <div class="flex items-center justify-center w-full min-h-[calc(100vh-80px)] bg-color-8 text-color-1 py-10">
            <!-- profil -->
            <div class="md:max-w-2xl lg:max-w-4xl xl:max-w-5xl py-8 px-10 w-full bg-white border border-gray-200 rounded-3xl shadow-md">


                <h2 class="text-2xl py-3 font-medium">Detail Akun</h2>
                <hr class="border-gray-200">

                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="role" value="pasien">

                    <div class="flex justify-between my-4">
                        <div class="flex items-center gap-8">
                            <div class="flex flex-col items-center justify-center">
                                <div class="avatar pb-3">
                                    <div class="w-24 rounded-full">
                                        <img id="previewImage" src="{{ $user->foto_profil ? asset('storage/' . $user->foto_profil) : asset('images/dummy.png') }}" />
                                    </div>
                                </div>
                            </div>

                            <label class="btn btn-sm cursor-pointer hover:opacity-80 inline-flex items-center my-2 bg-color-6 text-color-3 border border-transparent
                                rounded-md font-semibold text-xs capitalize hover:bg-color-5 active:bg-sky-300 focus: focus:outline-none
                            focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150" for="restaurantImage">
                                ubah foto
                                <!-- input gambar -->
                                <input name="foto_profil" id="restaurantImage" class="text-sm cursor-pointer w-36 hidden" type="file">
                            </label>
                            @error('foto_profil')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                    <!-- End foto Profil -->

                    <!-- detail -->
                    
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-4 gap-y-2">

                    <div>
                        <label class="form-control w-full max-w-full">
                            <div class="label">
                                <span class="label-text">Nama</span>
                            </div>
                            <input type="text" name="nama" value="{{ $user->nama }}" class="input input-bordered w-full max-w-full outline outline-1 outline-color-5 bg-color-6 rounded-lg" />
                            @error('nama')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </label>
                    </div>

                    <div>
                        <label class="form-control w-full max-w-full">
                            <div class="label">
                                <span class="label-text">Email</span>
                            </div>
                            <input type="email" value="{{ $user->email }}"  class="input input-bordered w-full max-w-full outline outline-1 outline-color-5 bg-color-6 rounded-lg cursor-not-allowed" readonly/>
                            @error('email')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </label>
                    </div>

                    <div>
                        <label class="form-control w-full max-w-full">
                            <div class="label">
                                <span class="label-text">Jenis Kelamin</span>
                            </div>
                            <select name="jenis_kelamin" class="select select-bordered outline outline-1 outline-color-5 bg-color-6 rounded-lg" required>
                                <option value="laki laki" {{ $user->jenis_kelamin === 'laki laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="perempuan" {{ $user->jenis_kelamin === 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('jenis_kelamin')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </label>
                    </div>

                    <div>
                        <label class="form-control w-full max-w-full">
                            <div class="label">
                                <span class="label-text">Tanggal Lahir</span>
                            </div>
                            <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $user->tanggal_lahir->format('Y-m-d')) }}" class="input input-bordered w-full max-w-full outline outline-1 outline-color-5 bg-color-6 rounded-lg" />
                            @error('tanggal_lahir')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </label>
                    </div>

                    <div class="col-span-1 lg:col-span-2">
                        <label class="form-control">
                            <div class="label">
                                <span class="label-text">Deskripsi Diri</span>
                            </div>
                            <textarea class="textarea textarea-bordered h-24 outline outline-1 outline-color-5 bg-color-6 rounded-lg" name="deskripsi_diri" placeholder="Deskripsi Diri">{{ old('deskripsi_diri', $user->pasien->deskripsi_diri ?? '') }}</textarea>
                            @error('deskripsi_diri')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </label>
                    </div>

                    </div>

                    <div class="flex justify-center items-center col-span-2 mt-4">
                        <button type="submit" class="btn btn-primary bg-color-6 text-color-3 border border-transparent rounded-md font-semibold text-sm hover:bg-color-5 transition ease-in-out duration-150">
                            Simpan Perubahan
                        </button>
                    </div>  

                </form>

                <h2 class="text-2xl py-3 font-medium">Status</h2>
                <hr class="border-gray-200">
                
                <div class="flex justify-center">
                    @if(Auth::user()->role === 'pasien' && Auth::user()->isPremium())
                        <div class="bg-white max-w-sm w-full py-4 px-8 my-4 border border-gray-200 rounded-lg shadow-lg relative">
                            
                            <!-- status langganan -->
                            <div class="mb-2 flex items-center justify-between">
                                <h5 class="text-lg font-bold text-gray-800">Paket Langganan Premium</h5>
                                <span class="py-1 px-2 inline-flex items-center gap-x-1 text-xs font-medium bg-teal-100 text-teal-800 rounded-full dark:bg-teal-500/10 dark:text-teal-500">
                                    <svg class="shrink-0 size-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"></path>
                                    <path d="m9 12 2 2 4-4"></path>
                                    </svg>
                                    Aktif
                                </span>
                            </div>

                            <!-- Fitur-Fitur -->
                            <ul role="list" class="space-y-4 my-4">
                                <li class="flex items-center">
                                    <svg class="flex-shrink-0 w-5 h-5 text-color-3" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                                    </svg>
                                    <span class="text-sm font-normal text-gray-600 ml-3">
                                        Chatbot dengan akses berkali lipat.
                                    </span>
                                </li>
                                <li class="flex items-center">
                                    <svg class="flex-shrink-0 w-5 h-5 text-color-3" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                                    </svg>
                                    <span class="text-sm font-normal text-gray-600 ml-3">
                                        Analisis emosi harian dari jurnal.
                                    </span>
                                </li>
                                <li class="flex items-center">
                                    <svg class="flex-shrink-0 w-5 h-5 text-color-3" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                                    </svg>
                                    <span class="text-sm font-normal text-gray-600 ml-3">
                                        Forum diskusi online eksklusif.
                                    </span>
                                </li>
                                <li class="flex items-center">
                                    <svg class="flex-shrink-0 w-5 h-5 text-color-3" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                                    </svg>
                                    <span class="text-sm font-normal text-gray-600 ml-3">
                                        Dukungan teknis prioritas.
                                    </span>
                                </li>
                            </ul>

                            <div class="flex justify-center">
                                <p class="text-xs text-gray-800">Durasi langganan tersisa 
                                    <span class="text-color-3 font-bold">{{ $remainingTime }}</span>
                                </p>
                            </div>

                        </div>
                        <!-- End berlangganan -->
                    @else
                    <span class="p-3">Anda tidak memiliki langganan premium aktif.</span>
                    @endif
                </div>
        </div>
        <!-- End profil -->

    </main>

    <footer class="text-color-8">
        <div class="grid grid-cols-1 bg-color-1 min-h-96 h-fit py-7 px-6 gap-6 lg:grid-cols-4 lg:pt-12 lg:gap-4 xl:px-20">
            <!-- Tentang Aplikasi -->
            <div>
                <nav class="pr-0 text-center lg:text-start">
                    <p class="text-xl font-semibold mb-4">Tentang Aplikasi</p>
                    <div class="grid grid-cols-1 gap-y-4 lg:text-sm">
                        <div>
                            <h3 class="font-medium mb-1">Email</h3>
                            <p class="text-gray-300">pblif19@gmail.com</p>
                        </div>
                        <div>
                            <h3 class="font-medium mb-1">Alamat</h3>
                            <p class="text-gray-300">Jl. Ahmad Yani Batam Kota, Kota Batam, Kepulauan Riau, Indonesia</p>
                        </div>
                    </div>
                </nav>
            </div>
    
            <!-- Pintasan Aplikasi -->
            <div>
                <nav class="text-center lg:text-start">
                    <p class="text-xl font-semibold mb-4">Pintasan Aplikasi</p>
                    <div class="grid grid-cols-1 gap-4 lg:grid-cols-2 lg:text-sm">
                        <div class="flex flex-col gap-4">
                            <a href="/chatbot" class="link link-hover hover:text-white text-gray-300">Chatbot</a>
                            <a href="/jurnal-harian" class="link link-hover hover:text-white text-gray-300">Jurnal Harian</a>
                            <a href="/konten-edukatif" class="link link-hover hover:text-white text-gray-300">Konten Edukatif</a>
                        </div>
                        <div class="flex flex-col gap-4">
                            <a href="/daftar-aktivitas-pribadi" class="link link-hover hover:text-white text-gray-300">Daftar Aktivitas</a>
                            <a href="/forum" class="link link-hover hover:text-white text-gray-300">Forum Diskusi</a>
                        </div>
                    </div>
                </nav>
            </div>
    
            <!-- Sosial Media -->
            <div class="lg:col-start-4">
                <ul class="flex flex-col text-center gap-3">
                    <li>
                        <p class="text-xl font-semibold mb-2">Sosial Media</p>
                        <div class="flex justify-center gap-2">
                            <a href=""><img src="{{ asset('icons/instagram.png') }}" alt="Instagram" class="h-10 w-10"></a>
                            <a href=""><img src="{{ asset('icons/twitter.png') }}" alt="Twitter" class="h-10 w-10"></a>
                            <a href=""><img src="{{ asset('icons/facebook.png') }}" alt="Facebook" class="h-10 w-10"></a>
                            <a href=""><img src="{{ asset('icons/youtube.png') }}" alt="YouTube" class="h-10 w-10"></a>
                        </div>
                    </li>
                    <li class="flex flex-col items-center">
                        <p class="text-base font-semibold mb-1">Anda seorang tenaga ahli kejiwaan?</p>
                        <a href="/mitra" class="btn btn-xs flex h-[30px] w-[100px] bg-color-8 text-color-9 text-color-1 hover:bg-color-6 border-color-4">
                            <img src=" {{ asset('icons/doctor-department.png') }} " alt="" class="h-4 w-4">
                            Daftar
                        </a>
                    </li>
                </ul>
            </div>
    
            <!-- Copyright -->
            <div class="col-span-1 lg:col-span-4 w-full text-center mt-6 lg:mt-auto">
                <span class="text-xs">&copy; {{ date('Y') }} SupporT-een</span>
            </div>
        </div>
    </footer>

    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @auth
        @if(Auth::user()->role === 'pasien' && !Auth::user()->isPremium() || Auth::user()->isPremium() && Auth::user()->premiumEndingSoon())
            <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
            <script type="text/javascript">
                document.getElementById('subscribe').onclick = function () {
                    fetch('{{ route('generate.snaptoken') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                    })
                    .then((response) => {
                        // Jika status bukan 200 OK, cek pesan kesalahan
                        if (!response.ok) {
                            return response.json().then((data) => {
                                throw new Error(data.error || 'Gagal mendapatkan Snap Token');
                            });
                        }
                        return response.json();
                    })
                    .then((data) => {
                        if (data.snap_token) {
                            snap.pay(data.snap_token, {
                                onSuccess: function (result) {
                                    fetch(`{{ url('/process-payment') }}/${data.transaction_id}`, {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                        },
                                        body: JSON.stringify({ payment_result: result }),
                                    })
                                    .then((response) => response.json())
                                    .then((response) => {
                                        if (response.success) {
                                            Swal.fire({
                                                icon: 'success',
                                                title: 'Berhasil',
                                                text: 'Pembayaran berhasil, langganan Anda telah aktif.',
                                                confirmButtonText: 'OK',
                                            }).then(() => {
                                                window.location.reload();
                                            });
                                        } else {
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'Kesalahan',
                                                text: response.message || 'Pembayaran gagal diproses.',
                                                confirmButtonText: 'OK',
                                            }).then(() => {
                                                window.location.reload();
                                            });
                                        }
                                    });
                                },
                                onPending: function (result) {
                                    Swal.fire({
                                        icon: 'warning',
                                        title: 'Pending',
                                        text: 'Pembayaran belum selesai. Anda dapat melanjutkannya nanti.',
                                        confirmButtonText: 'OK',
                                    }).then(() => {
                                        window.location.reload();
                                    });
                                },
                                onError: function (result) {
                                    fetch(`{{ url('/cancel-transaction') }}/${data.transaction_id}`, {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                        },
                                    })
                                    .then((response) => response.json())
                                    .then(() => {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Gagal',
                                            text: 'Pembayaran gagal. Status transaksi diperbarui.',
                                            confirmButtonText: 'OK',
                                        }).then(() => {
                                            window.location.reload();
                                        });
                                    });
                                },
                                onClose: function () {
                                    Swal.fire({
                                        icon: 'info',
                                        title: 'Dibatalkan',
                                        text: 'Anda menutup pembayaran. Anda dapat melanjutkan pembayaran nanti.',
                                        confirmButtonText: 'OK',
                                    }).then(() => {
                                        window.location.reload();
                                    });
                                },
                            });
                        }
                    })
                    .catch((error) => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Kesalahan',
                            text: error.message,
                            confirmButtonText: 'OK',
                        }).then(() => {
                            window.location.reload();
                        });
                    });
                };
            </script>
        @endif
    @endauth

    <script>
        document.getElementById('restaurantImage').addEventListener('change', function (event) {
            const [file] = event.target.files;
            if (file) {
                document.getElementById('previewImage').src = URL.createObjectURL(file);
            }
        });
    </script>
</body>
</html>