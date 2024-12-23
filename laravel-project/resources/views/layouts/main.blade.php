<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css','resources/js/app.js'])
    <title>{{ $title }}</title>
    <link rel="icon" type="image/svg+xml" href=" {{ asset('images/logo-icon.svg') }} ">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Space+Grotesk:wght@300..700&display=swap" rel="stylesheet">
</head>
<body class="font-poppins text-color-1">

    @include('Components.loader')

    <!-- Navbar -->
    <header class="sticky top-0 z-[70]">
        <div class="flex flex-row items-center justify-between h-12 px-1 md:h-20 xl:py-[0.938rem] xl:px-[3.125rem] bg-color-8 border-b border-color-4">
            <div class="flex items-center">
                <!-- Tombol Menu Burger -->
                <div class="lg:hidden {{ in_array($title, ['Login', 'Registrasi']) ? 'hidden' : '' }}">
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
                    @if(Auth::user()->role === 'pasien' && Auth::user()->hasVerifiedEmail() && !Auth::user()->isPremium() || Auth::user()->isPremium() && Auth::user()->hasVerifiedEmail() && Auth::user()->premiumEndingSoon())
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
                            
                            @if (Auth::user()->role === 'pasien')
                                <li>
                                    <!-- button profile -->
                                    <a href="/profile" class="block px-4 py-2  hover:bg-gray-100 hover:rounded-lg w-full text-center">
                                        Profile
                                    </a>
                                </li>
                            @endif

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
    <!-- Navbar -->

    <div class="{{ in_array($title, ['SupporT-een', 'Login', 'Registrasi', 'Mitra']) ? 'min-h-[calc(100vh-80px)]' : 'h-[calc(100vh-80px)]' }} flex flex-col lg:flex-row xl:flex-row w-full bg-color-8">

        <aside class="w-full py-8 lg:py-0 lg:w-2/5 lg:block {{ in_array($title, ['SupporT-een', 'Login', 'Registrasi', 'Mitra']) ? '' : 'overflow-y-auto hidden' }}">
            <!-- Konten aside -->
            @yield('aside')
        </aside>

        <main class="flex flex-grow bg-color-8 border border-color-4 lg:border-y-0 lg:w-3/5">
            <div class="flex flex-col bg-cover bg-brain-pattern mx-auto p-6 w-full justify-center items-center relative h-full overflow-y-auto">
                <!-- Konten main -->
                @yield('main')
            </div>
        </main>

    </div>

    <footer class="text-color-8">
    <div class="grid grid-cols-1 bg-color-1 min-h-96 h-fit py-7 px-6 gap-6 lg:grid-cols-4 lg:pt-12 lg:gap-4 xl:px-20">
        <!-- Tentang Aplikasi -->
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

        <!-- Pintasan Aplikasi -->
        <nav class="text-center lg:text-start">
            <p class="text-xl font-semibold mb-4">Pintasan Aplikasi</p>
                @if (!Auth::check() || Auth::user()->role === 'pasien')
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
                @else
                <div class="grid gap-4 lg:text-sm">
                    <div class="flex flex-col gap-4">
                        <a href="/tenaga-ahli/kelola-konten-edukatif" class="link link-hover hover:text-white text-gray-300">Kelola Konten Edukatif</a>
                        <a href="/tenaga-ahli/percakapan-konsultasi" class="link link-hover hover:text-white text-gray-300">Manajemen Konsultasi</a>
                        <a href="/tenaga-ahli/pendapatan" class="link link-hover hover:text-white text-gray-300">Pendapatan</a>
                    </div>
                </div>
                @endif
        </nav>

        <!-- Sosial Media -->
        <div class="lg:col-start-4">
            <ul class="flex flex-col text-center gap-3">
                <li>
                    <p class="text-xl font-semibold mb-2">Sosial Media</p>
                    <div class="flex justify-center gap-2">
                        <a href="https://www.instagram.com/" target="_blank"><img src="{{ asset('icons/instagram.png') }}" alt="Instagram" class="h-10 w-10"></a>
                        <a href="https://www.x.com/" target="_blank"><img src="{{ asset('icons/twitter.png') }}" alt="Twitter" class="h-10 w-10"></a>
                        <a href="https://www.facebook.com/" target="_blank"><img src="{{ asset('icons/facebook.png') }}" alt="Facebook" class="h-10 w-10"></a>
                        <a href="https://www.youtube.com/" target="_blank"><img src="{{ asset('icons/youtube.png') }}" alt="YouTube" class="h-10 w-10"></a>
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
        document.addEventListener("DOMContentLoaded", function () {
            const loader = document.getElementById('global-loader');
    
            function showLoader() {
                if (loader) loader.style.display = 'flex';
            }
    
            // Tambahkan event listener untuk semua link
            const links = document.querySelectorAll('a');
            links.forEach(link => {
                link.addEventListener('click', function (e) {
                    const href = link.getAttribute('href');
                    const target = link.getAttribute('target'); // Ambil atribut target
    
                    // Tampilkan loader jika:
                    // - href ada
                    // - href bukan anchor (#) atau JavaScript
                    // - link tidak memiliki atribut target
                    if (href && !href.startsWith('#') && !href.startsWith('javascript:') && !target) {
                        showLoader();
                    }
                });
            });
    
            // Tambahkan event listener untuk semua form
            const forms = document.querySelectorAll('form');
            forms.forEach(form => {
                form.addEventListener('submit', function () {
                    showLoader();
                });
            });
        });
    </script>
    
</body>
</html>