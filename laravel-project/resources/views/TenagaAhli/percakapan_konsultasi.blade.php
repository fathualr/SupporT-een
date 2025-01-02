@extends('layouts.main')

@section('aside')

<!-- konten sidebar -->
<div class="flex flex-col mx-auto w-full h-auto mt-9 px-12 gap-y-6">
    <h1 class="text-2xl xl:text-4xl font-bold text-color-1 w-full">Manajemen Konsultasi</h1>
    
    <div class="border border-gray-200 p-2 rounded">
        <h3 class="text-xl font-semibold text-color-1 w-full text-center mb-2">Status Tenaga Ahli</h3>
        <div class="flex w-full h-10 gap-3">
            <div class="flex items-center bg-color-putih ps-4 border border-gray-200 rounded w-full">
                <input id="bordered-radio-1" type="radio" value="1" name="is_available"
                    class="w-4 h-4 appearance-none checked:bg-green-600 checked:border-green-600 bg-gray-200 border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-300"
                    {{ Auth::user()->tenagaAhli->is_available ? 'checked' : '' }}>
                <label for="bordered-radio-1"
                    class="w-full py-4 ms-2 text-sm font-medium text-green-600 cursor-pointer">
                    Online
                </label>
            </div>
            <div class="flex items-center bg-color-putih ps-4 border border-gray-200 rounded w-full">
                <input id="bordered-radio-2" type="radio" value="0" name="is_available"
                    class="w-4 h-4 appearance-none checked:bg-gray-600 checked:border-gray-600 bg-gray-200 border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-300"
                    {{ !Auth::user()->tenagaAhli->is_available ? 'checked' : '' }}>
                <label for="bordered-radio-2"
                    class="w-full py-4 ms-2 text-sm font-medium cursor-pointer">
                    Offline
                </label>
            </div>
        </div>
    </div>
    
    {{-- <div class="bg-color-6 p-3 rounded-2xl">
        <p class="text-color-2 text-base text-center font-semibold">
        Tidak bisa menerima permintaan saat melakukan konsultasi
        </p>
    </div> --}}

    <div class="divider m-0"></div>

    <h1 class="text-2xl xl:text-4xl font-bold text-color-1">Riwayat Konsultasi</h1>

        <!-- Daftar Riwayat Aktivitas -->
        <div class="flex flex-col w-full h-full p-2 gap-4">
            
            @foreach ($riwayatKonsultasi as $riwayat)
                <!-- Card Konsultasi -->
                <a href="{{ route('tenagaAhliChat.index', $riwayat->id) }}" class="flex items-center border-[1px] border-color-4 rounded-2xl p-2 gap-2">
                    <div class="flex-none w-16 h-16">
                        <img
                            class="w-full h-full rounded-xl"
                            src="{{ $riwayat->pasien->user->foto_profil ? asset('storage/'.$riwayat->pasien->user->foto_profil) : asset('images/dummy.png') }}"
                            alt="Profile Picture" />
                    </div>
                    <div class="flex-1 justify-between">
                        <span class="text-color-1 font-semibold">
                            {{ optional($riwayat->pasien->user)->nama ?? 'Nama tidak tersedia' }}
                        </span>
                        <!-- Status Konsultasi -->
                        <div class="flex gap-1">
                            <span class="text-xs font-semibold py-1 px-3 rounded-full 
                                {{ $riwayat->status === 'done' ? 'bg-color-7 text-color-1' : 'bg-color-6 text-color-1' }}">
                                {{ $riwayat->status === 'done' ? 'Selesai' : 'Berlangsung' }}
                            </span>
                            @if (!$riwayat->pesan_tenaga_ahli)
                                <span class="text-xs font-semibold py-1 px-3 rounded-full bg-color-7 text-color-1">
                                    Buatkan pesan
                                </span>
                            @endif
                        </div>
                        <div class="flex justify-start items-center">
                            <span class="text-color-2 text-sm">
                                {{ $riwayat->started_at ? $riwayat->started_at->translatedFormat('l, d F Y H:i:s') : 'Tanggal tidak tersedia' }}
                            </span>
                        </div>
                    </div>
                </a>
            @endforeach

            @if ($riwayatKonsultasi->isEmpty())
                <div class="text-center py-4 text-color-2">
                    <p>Tidak ada riwayat konsultasi</p>
                </div>
            @endif

        </div>
</div>
<!-- konten sidebar -->

@endsection

@section('main')
<div class="flex flex-col max-w-5xl h-full relative w-full">
    @if($konsultasi)
        <a href="/tenaga-ahli/percakapan-konsultasi" class="btn btn-sm mb-3 bg-color-4 text-color-putih hover:bg-color-2 border-0 w-fit">
            <img class="w-6 h-6" src="{{ asset("icons/back.svg")}}" alt="Kembali">
            Kembali
        </a>
        <!-- Timer Container -->
        <div class="absolute top-8 left-1/2 transform -translate-x-1/2 bg-color-6 text-xl text-color-3 px-6 py-2 font-semibold border-[1px] border-color-5 rounded-xl shadow-md z-[1]">
            <span id="timer">00:00</span>
        </div>

        <!-- Chat Messages -->
        <div id="chat-messages" class="flex flex-col-reverse w-full h-full scrollbar overflow-y-auto justify-items-end select-text">
            @foreach($konsultasi->pesanKonsultasi->sortByDesc('created_at') as $pesan)
                <div class="flex items-end gap-3 pb-4">
                    <!-- Foto Profil Pengirim -->
                    @if ($pesan->pengirim === 'tenaga ahli')
                        <div class="chat-bubble bg-color-3 text-white w-full">
                            {{ $pesan->pesan }}
                        </div>
                        <div class="avatar">
                            <div class="w-12 rounded-full">
                                <img src="{{ $pesan->konsultasi->pasien->user->foto_profil 
                                            ? asset('storage/' . $pesan->konsultasi->pasien->user->foto_profil) 
                                            : asset('images/dummy.png') }}" 
                                    alt="Foto Profil Pasien"
                                    class="rounded-full w-12 h-12"/>
                            </div>
                        </div>
                    @else
                        <div class="avatar">
                            <div class="w-12 rounded-full">
                                <img src="{{ $pesan->konsultasi->tenagaAhli->user->foto_profil 
                                            ? asset('storage/' . $pesan->konsultasi->tenagaAhli->user->foto_profil) 
                                            : asset('images/dummy.png') }}" 
                                    alt="Foto Profil Tenaga Ahli"
                                    class="rounded-full w-12 h-12"/>
                            </div>
                        </div>
                        <div class="chat-bubble bg-white text-color-1 border w-full">
                            {{ $pesan->pesan }}
                        </div>
                    @endif
                </div>
            @endforeach
        </div>

        @if($konsultasi->status === 'done')
            <form method="POST" action="{{ route('percakapan-konsultasi.pesan', $konsultasi->id) }}">
                @csrf
                <div id="toast-undo" class="flex items-center w-full p-4 gap-3 text-color-putih bg-color-1 rounded-lg shadow mb-3" role="alert">
                    <div class="flex flex-col w-full gap-3">
                        <span class="font-normal">
                            Sesi konsultasi telah berakhir, Anda harus memberikan pesan hasil dari sesi konsultasi.
                        </span>
                        <label class="form-control w-full">
                            <textarea 
                                name="pesan_tenaga_ahli" 
                                placeholder="Masukkan pesan" 
                                class="textarea textarea-bordered h-24 text-color-1 w-full outline outline-1 outline-color-5 bg-color-8 rounded-lg"
                                required>{{ $konsultasi->pesan_tenaga_ahli ?? ''}}</textarea>
                        </label>
                        @error('pesan_tenaga_ahli')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                        <button type="submit" class="btn btn-sm text-color-1 bg-color-7 border-0 hover:bg-color-8 w-fit">
                            Simpan
                        </button>
                    </div>
                    <div class="flex items-center ms-auto space-x-2 rtl:space-x-reverse">
                        <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-color-1 text-color-putih hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#toast-undo" aria-label="Close">
                            <span class="sr-only">Close</span>
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </form>
        @endif

        <!-- Input Chat -->
        <div class="relative">
            <input 
                type="text" 
                id="message-input"
                class="h-[50px] flex items-center py-4 px-4 w-full rounded-full text-sm bg-color-6 border border-color-1 focus-visible:outline focus-visible:outline-color-1" 
                placeholder="Ketik pesan..."
                autocomplete="off"
                required
            >
            <button id="send-message" class="btn bg-color-6 hover:bg-color-5 h-[50px] absolute inset-y-0 right-0 rounded-r-full px-2 border-x-0 outline-none">
                <img src="{{ asset('icons/Sent.svg') }}" alt="Sent">
            </button>
        </div>

    @else
        <a href="/tenaga-ahli" class="btn btn-sm mb-3 bg-color-4 text-color-putih hover:bg-color-2 border-0 w-fit">
            <img class="w-6 h-6" src="{{ asset("icons/back.svg")}}" alt="Kembali">
            Kembali
        </a>
        <div class="flex justify-center items-center h-full w-full text-center text-color-2 font-semibold text-lg">
            Tidak ada percakapan yang dipilih.
        </div>
    @endif
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const radioButtons = document.querySelectorAll('input[name="is_available"]');
        const tenagaAhliId = '{{ Auth::user()->tenagaAhli->id }}'; // Ambil ID tenaga ahli

        radioButtons.forEach((radio) => {
            radio.addEventListener('change', async function () {
                const isAvailable = this.value; // Ambil nilai radio button yang dipilih

                try {
                    const response = await fetch(`/tenaga-ahli/${tenagaAhliId}/update-status`, {
                        method: 'PATCH',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                        body: JSON.stringify({ is_available: isAvailable }),
                    });

                    if (!response.ok) {
                        const errorData = await response.json();
                        throw new Error(errorData.message || 'Gagal memperbarui status.');
                    }

                    const result = await response.json();
                    console.log('Status berhasil diperbarui:', result);
                } catch (error) {
                    alert(error.message || 'Terjadi kesalahan saat memperbarui status.');
                }
            });
        });
    });
</script>

@if ($konsultasi)
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const messageInput = document.getElementById('message-input');
        const sendButton = document.getElementById('send-message');
        const chatMessages = document.getElementById('chat-messages');
        const timerElement = document.getElementById('timer');
        const konsultasiId = '{{ $konsultasi->id }}';
        
        window.Echo.channel(`chat.${konsultasiId}`)
            .listen('.message.sent', (data) => {
                console.log('Pesan baru diterima:', data); // Debug: pastikan data muncul di console
                appendMessageTenagaAhli(data, data.pengirim);
            });

        // Update fungsi appendMessage untuk menggunakan data dari Pusher
        function appendMessageTenagaAhli(message, sender) {
            console.log('Menambahkan pesan:', message, 'Dari pengirim:', sender);

            const isTenagaAhli = sender === 'tenaga ahli';
            const avatarUrl = isTenagaAhli 
                ? message.tenagaAhliFotoProfil
                : message.pasienFotoProfil;

            const messageHTML = `
                <div class="flex items-end gap-3 pb-4">
                    ${isTenagaAhli ? '' : `<div class="avatar">
                        <div class="w-12 rounded-full">
                            <img src="${avatarUrl}" alt="Profil" />
                        </div>
                    </div>`}
                    <div class="chat-bubble ${isTenagaAhli ? 'bg-color-3 text-white' : 'bg-white text-color-1 border'} w-full">
                        ${message.pesan}
                    </div>
                    ${isTenagaAhli ? `<div class="avatar">
                        <div class="w-12 rounded-full">
                            <img src="${avatarUrl}" alt="Profil" />
                        </div>
                    </div>` : ''} 
                </div>
            `;
            chatMessages.insertAdjacentHTML('afterbegin', messageHTML);
        }

        // Timer settings
        const startTime = new Date('{{ $konsultasi->started_at }}').getTime();
        const endTime = new Date('{{ $konsultasi->ends_at }}').getTime();

        // Update Timer function for countdown
        function updateTimer() {
            const now = new Date().getTime();
            const remainingTime = endTime - now;

            if (remainingTime <= 0) {
                // If consultation time is over
                timerElement.textContent = '00:00';
                disableInput('Konsultasi telah berakhir');
                return;
            }

            const minutes = String(Math.floor(remainingTime / 60000)).padStart(2, '0');
            const seconds = String(Math.floor((remainingTime % 60000) / 1000)).padStart(2, '0');
            timerElement.textContent = `${minutes}:${seconds}`;
        }

        setInterval(updateTimer, 1000);
        updateTimer(); // Initial update on page load

        // Disable input helper
        function disableInput(placeholder = '') {
            messageInput.disabled = true;
            sendButton.disabled = true;
            if (placeholder) messageInput.placeholder = placeholder;
        }

        // Enable input helper
        function enableInput() {
            messageInput.disabled = false;
            sendButton.disabled = false;
            messageInput.placeholder = 'Ketik pesan...';
        }

        // Send Message Function
        async function sendMessage() {
            const messageText = messageInput.value.trim();
            if (!messageText) return;

            disableInput();

            try {
                const response = await fetch(`/tenaga-ahli/percakapan-konsultasi/${konsultasiId}/send`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify({
                        pesan: messageText,
                        pengirim: 'tenaga ahli',
                    }),
                });

                if (!response.ok) {
                    const errorData = await response.json();
                    throw new Error(errorData.message || 'Gagal mengirim pesan.');
                }

                const newMessage = await response.json();
                messageInput.value = ''; // Kosongkan input setelah terkirim
            } catch (error) {
                alert(error.message || 'Terjadi kesalahan saat mengirim pesan.');
            } finally {
                enableInput();
            }
        }

        // Event Listeners
        sendButton.addEventListener('click', sendMessage);
        messageInput.addEventListener('keypress', function (e) {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                sendMessage();
            }
        });

        // Auto-scroll helper
        function autoScroll() {
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }

        // Observer to keep chat scrolled
        const observer = new MutationObserver(autoScroll);
        observer.observe(chatMessages, { childList: true, subtree: true });
    });
</script>
@endif

@endsection
