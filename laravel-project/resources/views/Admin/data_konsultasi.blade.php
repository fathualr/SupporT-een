@extends('layouts.main_admin')

@section('main')

<!-- Halaman Data Konsultasi -->
<div class="flex flex-col gap-4">
    <h1 class="text-[2rem] text-color-1 font-bold">Data Konsultasi</h1>

    <!-- Tabel Data -->
    <div class="w-full p-5 rounded-2xl">
        <div class="overflow-y-auto min-h-[calc(100vh-350px)]">
            <table class="table table-xs">
                <thead>
                    <tr class="text-color-1">
                        <th>No</th>
                        <th>Pasien</th>
                        <th>Tenaga Ahli</th>
                        <th>Status</th>
                        <th>Waktu Mulai</th>
                        <th>Waktu Berakhir</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($konsultasi as $key => $item)
                        <tr>
                            <th>{{ ($konsultasi->currentPage() - 1) * $konsultasi->perPage() + $key + 1 }}</th>
                            <td>{{ $item->pasien->user->email ?? 'Unknown Pasien' }}</td>
                            <td>{{ $item->tenagaAhli->user->email ?? 'Unknown Tenaga Ahli' }}</td>
                            <td>{{ ucfirst($item->status ?? '-') }}</td>
                            <td>{{ $item->started_at ? $item->started_at->format('d-m-Y H:i:s') : '-' }}</td>
                            <td>{{ $item->ends_at ? $item->ends_at->format('d-m-Y H:i:s') : '-' }}</td>
                            <td class="flex justify-center gap-2">
                                <a href="{{ route('data-konsultasi.show', $item->id) }}" class="btn bg-blue-100 text-blue-500 border-blue-500">
                                    <img class="w-6 h-6" src="{{ asset('icons/Info.svg') }}" alt="Detail">
                                </a>
                                <button class="btn bg-red-100 text-red-500 border-red-500" onclick="confirmDeletion('{{ $item->id }}')">
                                    <img class="w-6 h-6" src="{{ asset('icons/Waste.svg') }}" alt="Hapus">
                                </button>
                            </td>
                        </tr>

                        <form id="delete-form-{{ $item->id }}" action="{{ route('data-konsultasi.destroy', $item->id) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <div class="flex justify-between border-t-[1px] bg-color-8 border-color-4 p-3">
        <span class="text-sm text-color-2 content-center">
            Menampilkan {{ $konsultasi->firstItem() }} ke {{ $konsultasi->lastItem() }} dari {{ $konsultasi->total() }} data
        </span>

        <nav class="flex items-center gap-x-1" aria-label="Pagination">
            <!-- Tombol Previous -->
            <button type="button" 
                class="min-h-[38px] min-w-[38px] py-2 px-2.5 inline-flex justify-center items-center gap-x-2 text-sm rounded-lg border border-transparent text-color-1 hover:bg-color-5 focus:outline-none focus:bg-color-3 disabled:opacity-50 disabled:pointer-events-none"
                aria-label="Previous" {{ $konsultasi->onFirstPage() ? 'disabled' : '' }}
                onclick="window.location='{{ $konsultasi->previousPageUrl() }}'">
                <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m15 18-6-6 6-6"></path>
                </svg>
                <span class="sr-only">Previous</span>
            </button>

            <!-- Tombol Halaman -->
            <div class="flex items-center gap-x-1">
                <button type="button" 
                    class="min-h-[38px] min-w-[38px] flex justify-center items-center border border-color-4 text-color-1 hover:bg-color-5 py-2 px-3 text-sm rounded-lg 
                    {{ $konsultasi->currentPage() == 1 ? 'bg-color-3 text-color-5' : 'focus:outline-none focus:bg-color-3' }}" 
                    onclick="window.location='{{ $konsultasi->url(1) }}'">1</button>

                <button type="button" 
                    class="min-h-[38px] min-w-[38px] flex justify-center items-center border border-color-4  bg-color-3 text-color-5 py-2 px-3 text-sm rounded-lg" 
                    disabled>Halaman {{ $konsultasi->currentPage() }}</button>

                @if ($konsultasi->lastPage() > 1)
                    <button type="button" 
                        class="min-h-[38px] min-w-[38px] flex justify-center items-center border border-color-4 text-color-1 hover:bg-color-5 py-2 px-3 text-sm rounded-lg 
                        {{ $konsultasi->currentPage() == $konsultasi->lastPage() ? 'bg-color-3 text-color-5' : 'focus:outline-none focus:bg-color-3' }}" 
                        onclick="window.location='{{ $konsultasi->url($konsultasi->lastPage()) }}'">{{ $konsultasi->lastPage() }}</button>
                @endif
            </div>

            <!-- Tombol Next -->
            <button type="button" 
                class="min-h-[38px] min-w-[38px] py-2 px-2.5 inline-flex justify-center items-center gap-x-2 text-sm rounded-lg border border-transparent text-color-1 hover:bg-color-5 focus:outline-none focus:bg-color-3 disabled:opacity-50 disabled:pointer-events-none"
                aria-label="Next" {{ $konsultasi->hasMorePages() ? '' : 'disabled' }}
                onclick="window.location='{{ $konsultasi->nextPageUrl() }}'">
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
