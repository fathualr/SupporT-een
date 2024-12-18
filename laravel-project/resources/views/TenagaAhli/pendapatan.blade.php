@extends('layouts.main')

@section('aside')

<div class="flex flex-col mx-auto w-full h-full pt-9 px-[50px] gap-6">

    <h1 class="text-4xl font-bold text-color-1 text-start">Pendapatan</h1>
    <button class="btn flex justify-start bg-color-6 hover:bg-color-5 hover:border-color-3 text-base">
        <img src="{{ asset('icons/Request_Money.svg') }}" alt="">
        Penarikan
    </button>

    <h1 class="text-4xl font-bold text-color-1 text-start">Riwayat Penarikan</h1>

    <div class="flex flex-col w-full h-full gap-4">

        <!-- card 1 -->
        <div class="flex items-center border-[1px] border-color-4 rounded-2xl p-2">
            <div class="flex-1">
                <span class="text-color-1 font-bold text-base">Rp. 5.000.000</span>
                <div class="flex justify-start items-center">
                    <span class="text-color-2 text-xs">Senin, 14 Oktober 2024</span>
                </div>
            </div>
            <button class="btn btn-square btn-ghost">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        class="inline-block h-5 w-5 stroke-current">
                        <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"></path>
                    </svg>
                </button>
        </div>
        <!-- card 1 -->
        <!-- card 2 -->
        <div class="flex items-center border-[1px] border-color-4 rounded-2xl p-2">
            <div class="flex-1">
                <span class="text-color-1 font-bold text-base">Rp. 5.000.000</span>
                <div class="flex justify-start items-center">
                    <span class="text-color-2 text-xs">Senin, 14 Oktober 2024</span>
                </div>
            </div>
            <button class="btn btn-square btn-ghost">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        class="inline-block h-5 w-5 stroke-current">
                        <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"></path>
                    </svg>
                </button>
        </div>
        <!-- card 2 -->
    </div>

</div>

@endsection

@section('main')

<div class="flex flex-col w-full h-full gap-4">
    <div class="flex flex-col items-center bg-color-6 border-[1px] border-color-5 w-full py-16 rounded-2xl">
        <h1 class="text-[32px] font-medium text-color-1">Total Pendapatan</h1>
        <p class="text-color-1 text-[64px] font-bold">Rp. 5.170.000.000.000</p>
    </div>
    <div class="bg-color-8 border-[1px] border-color-4 w-full p-5 rounded-2xl">
        <div class="overflow-y-auto h-[calc(100vh-460px)]">
            <table class="table table-xs">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Pendapatan</th>
                        <th>Waktu</th>
                    </tr>
                </thead>
                <tbody>

                    <tr>
                        <th>1</th>
                        <td>Cy Ganderton</td>
                        <td>Rp. 28.000</td>
                        <td>9 September 2024</td>
                    </tr>
                
                </tbody>
            </table>
        </div>
    </div>
</div>


@endsection