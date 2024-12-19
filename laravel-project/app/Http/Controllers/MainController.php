<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\AktivitasPositif;
use App\Models\Diskusi;
use App\Models\Konsultasi;
use App\Models\KontenEdukatif;
use App\Models\TenagaAhli;
use App\Models\Pasien;
use App\Models\Subscription;
use App\Models\TransaksiKonsultasi;
use App\Models\TransaksiLangganan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function index()
    {
        return view('Pasien/homepage', [
            "title" => "SupporT-een"
        ]);
    }

    public function profile()
    {
        $userId = Auth::id(); // Ambil ID pengguna yang sedang login
        $user = User::find($userId); // Ambil data pengguna menggunakan model User
    
        return view('Pasien/profile', [
            "title" => "Profile",
            "user" => $user,
            "remainingTime" => $user->userRemainingPremiumTime(), // Panggil fungsi langsung dari model
        ]);
    }

    public function tenagaAhli()
    {
        return view('TenagaAhli/homepage', [
            "title" => "SupporT-een"
        ]);
    }

    public function superAdmin()
    {
        $totalPasien = Pasien::count();
        $totalAdmin = Admin::count();
        $totalTenagaAhli = TenagaAhli::count();
        $totalPelanggan = Subscription::where('ends_at', '>', Carbon::now())->count();
        $totalTransaksiLangganan = TransaksiLangganan::where('status', 'paid')->count();
        $totalKonsultasi = Konsultasi::where('ends_at', '>', Carbon::now())->count();
        $totalTransaksiKonsultasi = TransaksiKonsultasi::count();
        $totalAmountPaidSubscription = TransaksiLangganan::where('status', 'paid')->sum('amount');
        $totalAmountPaidConsultation = TransaksiKonsultasi::where('status', 'paid')->sum('amount') * 0.1;
        $totalAmountPaid = $totalAmountPaidSubscription + $totalAmountPaidConsultation;

        return view('Admin/dashboard_super', [
            "title" => "Dashboard Super Admin",
            "totalPasien" => $totalPasien,
            "totalAdmin" => $totalAdmin,
            "totalTenagaAhli" => $totalTenagaAhli,
            "totalPelanggan" => $totalPelanggan,
            "totalTransaksiLangganan" => $totalTransaksiLangganan,
            "totalKonsultasi" => $totalKonsultasi,
            "totalTransaksiKonsultasi" => $totalTransaksiKonsultasi,
            "totalAmountPaid" => 'Rp. ' . number_format($totalAmountPaid, 0, ',', '.'),
        ]);
    }
    

    public function contentAdmin()
    {
        $totalArtikel = KontenEdukatif::where('tipe', 'artikel')->count();
        $totalVideo = KontenEdukatif::where('tipe', 'video')->count();
        $totalDiskusi = Diskusi::count();
        $totalAktivitasPositif = AktivitasPositif::count();

        return view('Admin/dashboard_content', [
            "title" => "Dashboard Content Admin",
            "totalArtikel" => $totalArtikel,
            "totalVideo" => $totalVideo,
            "totalDiskusi" => $totalDiskusi,
            "totalAktivitasPositif" => $totalAktivitasPositif,
        ]);
    }

    public function mitra()
    {
        return view('kemitraan', [
            "title" => "Mitra"
        ]);
    }
}
