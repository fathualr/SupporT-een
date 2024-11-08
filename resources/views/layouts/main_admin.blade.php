<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>{{ $title }}</title>
    <link rel="icon" type="image/svg+xml" href=" {{ asset('images/logo-icon.svg') }} ">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Space+Grotesk:wght@300..700&display=swap" rel="stylesheet">
</head>
<body class="font-poppins text-color-1">

    <header class="sticky top-0 z-[999]">
        <div class="flex flex-row h-20 py-[15px] px-[50px] bg-color-8 border-b border-color-4 ">
            <a href="/super-admin" class="flex flex-row">
                <img class="h-[50px] w-[50px] me-[15px]" src=" {{ asset('images/logo-dark-blue.svg') }} " alt="SupporT-een Logo">
                <span class="my-auto text-[2rem]">SupporT-een</span>
            </a>
            <a class="btn ms-auto w-fit text-white bg-color-3 border-0 font-semibold px-8 hover:bg-color-6 hover:text-color-1 hover:border hover:border-color-4 text-2xl">
                <span>Logout</span>
            </a>
        </div>
    </header>

    <div class="min-h-[calc(100vh-80px)] flex w-full bg-color-8">

        <aside class="w-1/5 p-5">
            <!-- Konten aside -->
            <div class="flex flex-col gap-5 w-full h-full">

                <div class="flex items-center bg-color-putih border-[1px] border-color-4 px-4 py-2 rounded-2xl gap-2">
                    <div class="avatar">
                        <div class="w-12 rounded-full">
                            <img src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.webp" />
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-base text-color-1 font-semibold">Nama Admin</span>
                        <span class="text-color-3">Online</span>
                    </div>
                </div>
                <!-- profile -->

                <div class="flex bg-color-putih border-[1px] border-color-4 py-2 rounded-2xl gap-2 h-full">
                    <ul class="menu w-full text-base text-color-1">
                        <li><a href="/super-admin">Dashboard</a></li>
                        <li>
                            <details open>
                            <summary>Data Pengguna</summary>
                            <ul>
                                <li><a href="/super-admin/user-admin">Data Administrator</a></li>
                                <li><a href="/super-admin/user-pasien">Data Pasien</a></li>
                                <li><a href="/super-admin/user-tenaga-ahli">Data Tenaga Ahli</a></li>
                            </ul>
                            </details>
                        </li>
                        <li><a href="/super-admin/transaksi">Data Transaksi</a></li>
                        <li><a href="/super-admin/pendapatan">Pendapatan</a></li>
                    </ul>
                </div>
            
            </div>
        </aside>

        <main class="w-4/5 bg-color-8 border-l border-color-4">
            <div class="bg-cover bg-brain-pattern flex flex-col mx-auto p-6 w-full justify-center items-center h-full relative">
                <!-- Konten main -->
                <div class=" bg-color-putih border-[1px] border-color-4 w-full h-full p-5 rounded-2xl">
                    @yield('main')
                </div>
            </div>
        </main>

    </div>

    <footer>
        <div class="bg-color-1 w-full mx-auto text-center mt-auto">
            <span class="text-xs text-color-8">&copy; <?php echo date("Y"); ?> SupporT-een</span>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            });
        @endif
    
        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: '{{ session('error') }}',
                confirmButtonColor: '#d33',
                confirmButtonText: 'OK'
            });
        @endif
    </script>
    
    <script>
        function confirmDeletion(adminId) {
            Swal.fire({
                title: "Apakah Anda yakin ingin menghapus data ini?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, hapus!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`delete-form-${adminId}`).submit();
                }
            });
        }
    </script>
</body>
</html>