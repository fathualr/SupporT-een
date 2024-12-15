<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\{
    RoleMiddleware,
    GuestOrPasienMiddleware,
    PremiumMiddleware,
    VerifiedPatientMiddleware
};
use App\Http\Controllers\{
    Auth\AuthController,
    MainController,
    AdminController,
    PasienController,
    TenagaAhliController,
    RiwayatPendidikanTenagaAhliController,
    KontenEdukatifController,
    DiskusiController,
    GambarDiskusiController,
    ForumController,
    ChatbotController,
    JurnalHarianController,
    AktivitasPribadiController,
    KonsultasiController,
    TransaksiController,
    PendapatanController,
    AktivitasPositifController,
    KataKunciAktivitasController,
    KataKunciKontenController,
    BalasanController,
    SubscriptionController,
    SubscriptionPlanController,
    TransaksiLanggananController,
};

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/registrasi', [AuthController::class, 'registrasi']);
});

Route::get('/mitra', [MainController::class, 'mitra'])->middleware(VerifiedPatientMiddleware::class);
Route::post('authenticate', [AuthController::class, 'authenticate'])->name('authenticate');
Route::post('registration', [AuthController::class, 'registration'])->name('registration');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// profile
Route::middleware([GuestOrPasienMiddleware::class, VerifiedPatientMiddleware::class])->group(function () {
    Route::get('/', [MainController::class, 'index']);
    Route::get('/konten-edukatif/{id?}', [KontenEdukatifController::class, 'kontenEdukatif'])->name('kontenEdukatif');
});
// Pasien
Route::middleware([RoleMiddleware::class . ':pasien'])->group(function () {
    Route::get('/verifikasi-email', [AuthController::class, 'showVerificationNotice'])->name('verification.notice');
    Route::post('/verify-otp', [AuthController::class, 'verifyOtp'])->name('otp.verify');
    Route::post('/resend-otp', [AuthController::class, 'resendOtp'])->name('otp.resend');
    
    Route::middleware([VerifiedPatientMiddleware::class])->group(function () {
        // Midtrans route ->
        Route::post('/generate-snaptoken', [SubscriptionController::class, 'generateSnapToken'])->name('generate.snaptoken');
        Route::post('/process-payment/{transaction}', [SubscriptionController::class, 'processPayment'])->name('process.payment');
        Route::post('/cancel-transaction/{transaction}', [SubscriptionController::class, 'cancelTransaction'])->name('cancel.transaction');
        // <-
        Route::get('/profile', [MainController::class, 'profile']);
        Route::put('/profile-update', [PasienController::class, 'updateProfile'])->name('profile.update');
        Route::get('/chatbot/{id?}', [ChatbotController::class, 'chatbot'])->name('chatbot.index');
        Route::resource('/chatbot', ChatbotController::class)->except(['index', 'create', 'edit']);
        Route::get('/jurnal-harian/{id?}', [JurnalHarianController::class, 'jurnalHarian'])->name('jurnalHarian.index');
        Route::resource('/jurnal-harian', JurnalHarianController::class)->only(['store', 'update', 'destroy']);
        Route::get('/daftar-aktivitas-pribadi', [AktivitasPribadiController::class, 'daftarAktivitasPribadi']);
        Route::get('/daftar-aktivitas-pribadi/kustomisasi', [AktivitasPositifController::class, 'kustomisasiAktivitasPribadi']);
        Route::post('/aktivitas-pribadi/update', [AktivitasPribadiController::class, 'updateAktivitasPribadi'])->name('aktivitas-pribadi.update');
        Route::post('/aktivitas-pribadi/store', [AktivitasPribadiController::class, 'storeAktivitasPribadi'])->name('aktivitas-pribadi.store');
        // Premium User
        Route::middleware([PremiumMiddleware::class])->group(function () {
            Route::get('/forum/{id?}', [ForumController::class, 'forum'])->name('forum.index');
            Route::resource('/forum-diskusi', ForumController::class)->except('index');
            Route::resource('/balasan',BalasanController::class)->only(['store', 'destroy'])->names(['destroy' => 'pasien.balasan.destroy',]);;
            Route::resource('/gambar-diskusi', GambarDiskusiController::class)->only('destroy');
        });
    });
    Route::get('/konsultasi/{id?}', [KonsultasiController::class, 'konsultasi'])->name('konsultasi.index');
});

// Tenaga Ahli
Route::prefix('tenaga-ahli')->middleware(['auth', RoleMiddleware::class . ':tenaga ahli'])->group(function () {
    Route::get('/', [MainController::class, 'tenagaAhli']);
    Route::get('/kelola-konten-edukatif', [KontenEdukatifController::class, 'tenagaAhliKontenEdukatif']);
    Route::get('/kelola-konten-edukatif/artikel', [KontenEdukatifController::class, 'tenagaAhliKontenArtikel']);
    Route::get('/kelola-konten-edukatif/video', [KontenEdukatifController::class, 'tenagaAhliKontenVideo']);
    Route::get('/kelola-konten-edukatif/tambah-konten', [KontenEdukatifController::class, 'tenagaAhliCreate']);
    Route::get('/percakapan-konsultasi', [KonsultasiController::class, 'tenagaAhliKonsultasi']);
    Route::get('/pendapatan', [PendapatanController::class, 'tenagaAhliPendapatan']);
});

// Admin
Route::prefix('super-admin')->middleware([RoleMiddleware::class . ':superadmin'])->group(function () {
    Route::get('/', [MainController::class, 'superAdmin']);
    Route::resource('/user-admin', AdminController::class);
    Route::resource('/user-pasien', PasienController::class);
    Route::resource('/user-tenaga-ahli', TenagaAhliController::class);
    Route::resource('/riwayat-pendidikan-tenaga-ahli', RiwayatPendidikanTenagaAhliController::class)->only('store', 'destroy');
    Route::resource('/subscription', SubscriptionPlanController::class)->only('index', 'update');
    Route::resource('/subscription-user', SubscriptionController::class)->only('index');
    Route::resource('/subscription-transaction', TransaksiLanggananController::class)->only('index', 'show', 'destroy');
    Route::resource('/transaksi', TransaksiController::class)->only('index');
    Route::resource('/model-chatbot', ChatbotController::class)->only('index');
    Route::post('/model-chatbot', [ChatbotController::class, 'updateChatbotLiteDataset'])->name('chatbotLite.updateDataset');
});

Route::prefix('content-admin')->middleware([RoleMiddleware::class . ':content admin'])->group(function () {
    Route::get('/', [MainController::class, 'contentAdmin']);
    Route::resource('/konten-edukatif', KontenEdukatifController::class);
    Route::resource('/kata-kunci-konten', KataKunciKontenController::class)->only('store', 'destroy');
    Route::resource('/diskusi',DiskusiController::class)->only('index', 'show', 'destroy');
    Route::get('/diskusi/{id}/balasan', [DiskusiController::class, 'showBalasan'])->name('diskusi.showBalasan');
    Route::resource('/balasan',BalasanController::class)->only('destroy');
    Route::resource('/aktivitas-positif',AktivitasPositifController::class);
    Route::resource('/kata-kunci-aktivitas',KataKunciAktivitasController::class)->only('store', 'destroy');
});

Route::fallback(function () {
    return response()->view('Errors.404', [
        'user' => Auth::check() ? Auth::user() : null,
    ], 404);
});