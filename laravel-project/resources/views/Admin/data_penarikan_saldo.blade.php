@extends('layouts.main_admin')

@section('main')

<!-- Halaman Data Penarikan Pendapatan -->
<div class="flex flex-col gap-4">
    <h1 class="text-[2rem] text-color-1 font-bold">Data Permintaan Penarikan Pendapatan</h1>

    <!-- Tabel Data -->
    <div class="w-full p-5 rounded-2xl">
        <div class="overflow-y-auto min-h-[calc(100vh-350px)]">
            <table class="table table-xs">
                <thead>
                    <tr class="text-color-1">
                        <th>No</th>
                        <th>Email</th>
                        <th>Jumlah Penarikan</th>
                        <th>Status</th>
                        <th>Diajukan Pada</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($penarikan as $key => $item)
                        <tr>
                            <th>{{ ($penarikan->currentPage() - 1) * $penarikan->perPage() + $key + 1 }}</th>
                            <td>{{ $item->user->email ?? 'Tidak Diketahui' }}</td>
                            <td>Rp. {{ number_format($item->jumlah_penarikan, 2, ',', '.') }}</td>
                            <td>
                                <span class="px-2 py-1 rounded-full text-xs font-semibold 
                                    {{ $item->status === 'menunggu' ? 'bg-yellow-200 text-yellow-800' : 
                                        ($item->status === 'ditolak' ? 'bg-red-200 text-red-800' : 'bg-green-200 text-green-800') }}">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </td>
                            <td>{{ $item->created_at->format('d-m-Y H:i:s') }}</td>
                            <td class="flex justify-center gap-2">
                                <a href="{{ route('pendapatan.show', $item->id) }}" class="btn bg-blue-100 text-blue-500 border-blue-500">
                                    <img class="w-6 h-6" src="{{ asset('icons/Info.svg') }}" alt="">
                                </a>
                                <a href="{{ route('pendapatan.edit', $item->id) }}" class="btn bg-green-100 text-green-500 border-green-500">
                                    <img class="w-6 h-6" src="{{ asset("icons/Edit.svg")}}" alt="">
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <div class="flex justify-between border-t-[1px] bg-color-8 border-color-4 p-3">
        <span class="text-sm text-color-2 content-center">
            Menampilkan {{ $penarikan->firstItem() }} ke {{ $penarikan->lastItem() }} dari {{ $penarikan->total() }} data
        </span>

        <nav class="flex items-center gap-x-1" aria-label="Pagination">
            <!-- Tombol Previous -->
            <button type="button" 
                class="min-h-[38px] min-w-[38px] py-2 px-2.5 inline-flex justify-center items-center gap-x-2 text-sm rounded-lg border border-transparent text-color-1 hover:bg-color-5 focus:outline-none focus:bg-color-3 disabled:opacity-50 disabled:pointer-events-none"
                aria-label="Previous" {{ $penarikan->onFirstPage() ? 'disabled' : '' }}
                onclick="window.location='{{ $penarikan->previousPageUrl() }}'">
                <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m15 18-6-6 6-6"></path>
                </svg>
                <span class="sr-only">Previous</span>
            </button>

            <!-- Tombol Halaman -->
            <div class="flex items-center gap-x-1">
                <button type="button" 
                    class="min-h-[38px] min-w-[38px] flex justify-center items-center border border-color-4 text-color-1 hover:bg-color-5 py-2 px-3 text-sm rounded-lg 
                    {{ $penarikan->currentPage() == 1 ? 'bg-color-3 text-color-5' : 'focus:outline-none focus:bg-color-3' }}" 
                    onclick="window.location='{{ $penarikan->url(1) }}'">1</button>

                <button type="button" 
                    class="min-h-[38px] min-w-[38px] flex justify-center items-center border border-color-4  bg-color-3 text-color-5 py-2 px-3 text-sm rounded-lg" 
                    disabled>Halaman {{ $penarikan->currentPage() }}</button>

                @if ($penarikan->lastPage() > 1)
                    <button type="button" 
                        class="min-h-[38px] min-w-[38px] flex justify-center items-center border border-color-4 text-color-1 hover:bg-color-5 py-2 px-3 text-sm rounded-lg 
                        {{ $penarikan->currentPage() == $penarikan->lastPage() ? 'bg-color-3 text-color-5' : 'focus:outline-none focus:bg-color-3' }}" 
                        onclick="window.location='{{ $penarikan->url($penarikan->lastPage()) }}'">{{ $penarikan->lastPage() }}</button>
                @endif
            </div>

            <!-- Tombol Next -->
            <button type="button" 
                class="min-h-[38px] min-w-[38px] py-2 px-2.5 inline-flex justify-center items-center gap-x-2 text-sm rounded-lg border border-transparent text-color-1 hover:bg-color-5 focus:outline-none focus:bg-color-3 disabled:opacity-50 disabled:pointer-events-none"
                aria-label="Next" {{ $penarikan->hasMorePages() ? '' : 'disabled' }}
                onclick="window.location='{{ $penarikan->nextPageUrl() }}'">
                <span class="sr-only">Next</span>
                <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m9 18 6-6-6-6"></path>
                </svg>
            </button>
        </nav>
    </div>
    <!-- END Pagination -->

</div>

@endsection
