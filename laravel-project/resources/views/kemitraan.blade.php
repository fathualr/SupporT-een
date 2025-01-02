@extends('layouts.main')

@section('aside')

    <div class="flex flex-col mx-auto w-full justify-center items-center mb-[50px] h-full">
        <img src=" {{ asset('images/main-picture.svg') }} " class="max-h-[500px] max-w-[500px]" alt="">
        <div class="card max-w-[475px] max-h-[200px] bg-color-6 border border-color-5 text-color-9 mx-auto">
            <div class="card-body">
                <p class="font-bold text-2xl">Berbagi, Mendukung, Berkembang.</p>
                <p class="text-base text-justify">Bersama, kita hadapi tantangan dan jaga kesehatan mental. Setiap langkah kecil membawa kita menuju masa depan yang lebih cerah!</p>
            </div>
        </div>
    </div>

@endsection

@section('main')

    <div class="flex flex-col w-full h-full justify-center bg-color-8 border shadow-sm rounded-xl p-4 md:p-5 text-center">
        <h3 class="text-2xl font-bold text-color-1 mb-2">
            Bergabung Sebagai Tenaga Ahli
        </h3>
        <p class="mt-2 text-gray-500 text-justify">
            Daftarkan diri Anda sebagai tenaga ahli untuk mendukung kesehatan mental remaja. Isi informasi terkait keahlian, pengalaman, dan sertifikasi Anda. Proses pendaftarannya mudah dan cepat, dan Anda bisa langsung terhubung dengan mereka yang membutuhkan bantuan profesional Anda.
        </p>
        <div class="flex justify-center gap-4 my-5">
        <a href="https://gmail.com/" target="_blank" type="button" class="btn bg-red-500 text-white w-[150px]">
            <img class="w-7" src="{{ asset('icons/Email.svg') }}" alt="">Email
        </a>
        <a href="https://web.whatsapp.com/" target="_blank" class="btn bg-green-500 text-white w-[150px]" href="">
            <img class="w-7" src="{{ asset('icons/WhatsApp.svg') }}" alt="">WhatsApp
        </a>
        </div>
    </div>

@endsection