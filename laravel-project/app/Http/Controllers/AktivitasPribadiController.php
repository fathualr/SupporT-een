<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AktivitasPribadi;
use App\Models\RiwayatAktivitas;
use Illuminate\Support\Facades\Auth;

class AktivitasPribadiController extends Controller
{
    
    public function daftarAktivitasPribadi()
    {
        $pasienId = Auth::user()->pasien->id; // Ambil ID pasien
    
        // Ambil data aktivitas pribadi
        $aktivitasPribadi = AktivitasPribadi::with('aktivitasPositif')
            ->where('id_pasien', $pasienId)
            ->get();
    
        // Ambil data riwayat aktivitas dan kelompokkan berdasarkan tanggal
        $riwayatAktivitas = RiwayatAktivitas::with('aktivitasPositif')
            ->where('id_pasien', $pasienId)
            ->get()
            ->groupBy(function ($item) {
                return ($item->created_at);
            });
    
        return view('Pasien/daftar_aktivitas_pribadi', [
            "title" => "Daftar Aktivitas Pribadi",
            "aktivitasPribadi" => $aktivitasPribadi,
            "riwayatAktivitas" => $riwayatAktivitas
        ]);
    }
    
    public function updateAktivitasPribadi(Request $request)
    {
        $pasienId = Auth::user()->pasien->id;
        $selectedActivities = $request->input('aktivitas', []); // Daftar ID aktivitas yang dipilih (checkbox tercentang)
    
        // Hapus semua aktivitas pribadi sebelumnya untuk pengguna
        AktivitasPribadi::where('id_pasien', $pasienId)->delete();
    
        // Tambahkan kembali aktivitas yang dipilih
        foreach ($selectedActivities as $aktivitasId) {
            AktivitasPribadi::create([
                'id_pasien' => $pasienId,
                'id_aktivitas_positif' => $aktivitasId,
                'is_completed' => false,
            ]);
        }
    
        return redirect()->back()->with('success', 'Aktivitas pribadi berhasil diperbarui!');
    }

    public function storeAktivitasPribadi(Request $request)
    {
        $pasienId = Auth::user()->pasien->id;
        $selectedActivities = $request->input('aktivitas', []); // Daftar ID aktivitas yang dipilih (checkbox tercentang)
    
        // Ambil semua aktivitas pribadi pengguna
        $allActivities = AktivitasPribadi::where('id_pasien', $pasienId)->get();
    
        // Iterasi semua aktivitas untuk memperbarui status is_completed
        foreach ($allActivities as $activity) {
            $activity->is_completed = in_array($activity->id, $selectedActivities); // Centang = true, Tidak centang = false
            $activity->save();
        }
    
        return redirect()->back()->with('success', 'Aktivitas pribadi berhasil diselesaikan!');
    }
}
