<?php

namespace App\Http\Controllers;

use App\Models\Konsultasi;
use App\Models\TransaksiKonsultasi;
use App\Models\TenagaAhli;
use App\Models\PesanKonsultasi;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class KonsultasiController extends Controller
{
    
    public function konsultasi($id = null)
    {
        $tenagaAhli = TenagaAhli::with('user')->orderBy('is_available','desc')->get();
        $selectedTenagaAhli = null;

        if ($id) {
            $selectedTenagaAhli = TenagaAhli::with(['user', 'riwayatPendidikan'])
                ->where('id', $id)
                ->first();
            if (!$selectedTenagaAhli) {
                return redirect()->back()->with('error','Tenaga ahli tidak dapat ditemukan.');
            }
        }

        $idPasien = Auth::user()->pasien->id;
        
        // Ambil semua riwayat konsultasi untuk pasien tersebut
        $riwayatKonsultasi = Konsultasi::with(['pesanKonsultasi', 'tenagaAhli'])
            ->where('id_pasien', $idPasien)
            ->orderBy('created_at', 'desc')
            ->get();

        // Filter hanya konsultasi yang semua pesan is_showed_to_patient = true
        $riwayatKonsultasi = $riwayatKonsultasi->filter(function ($konsultasi) {
            // Periksa apakah semua pesan pada konsultasi memiliki is_showed_to_patient = true
            return $konsultasi->pesanKonsultasi->every(function ($pesan) {
                return $pesan->is_showed_to_patient == true;
            });
        });

        return view('Pasien/konsultasi', [
            "title" => "Konsultasi Online",
            "tenagaAhli" => $tenagaAhli,
            "selectedTenagaAhli" => $selectedTenagaAhli,
            "riwayatKonsultasi" => $riwayatKonsultasi,
        ]);
    }
    
    public function pasienKonsultasi($id_konsultasi)
    {
        // Ambil data user yang sedang login
        $idPasien = Auth::user()->pasien->id;
    
        // Ambil data konsultasi sesuai id yang sedang login
        $konsultasi = Konsultasi::with(['pesanKonsultasi' => function($query) {
                // Menambahkan kondisi untuk menampilkan hanya pesan yang is_showed_to_patient = true
                $query->where('is_showed_to_patient', true)
                        ->orderBy('created_at', 'desc');
            }])
            ->where('id', $id_konsultasi)
            ->where('id_pasien', $idPasien) // Pastikan konsultasi milik pasien yang login
            ->first();
    
        // Jika konsultasi tidak ditemukan atau bukan milik pasien yang login
        if (!$konsultasi) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses ke konsultasi ini.');
        }
        
        // Ambil semua riwayat konsultasi untuk pasien tersebut
        $riwayatKonsultasi = Konsultasi::with(['pesanKonsultasi', 'tenagaAhli'])
            ->where('id_pasien', $idPasien)
            ->orderBy('created_at', 'desc')
            ->get();

        // Filter hanya konsultasi yang semua pesan is_showed_to_patient = true
        $riwayatKonsultasi = $riwayatKonsultasi->filter(function ($konsultasi) {
            // Periksa apakah semua pesan pada konsultasi memiliki is_showed_to_patient = true
            return $konsultasi->pesanKonsultasi->every(function ($pesan) {
                return $pesan->is_showed_to_patient == true;
            });
        });
    
        return view('Pasien/percakapan_konsultasi', [
            "title" => "Percakapan",
            "konsultasi" => $konsultasi,
            "riwayatKonsultasi" => $riwayatKonsultasi,
        ]);
    }
    
    public function tenagaAhliKonsultasi($id = null)
    {
        // Cek apakah user adalah tenaga ahli
        $IdtenagaAhli = Auth::user()->tenagaAhli->id;
        
        // Ambil riwayat konsultasi yang ada untuk tenaga ahli
        $riwayatKonsultasi = Konsultasi::with('pesanKonsultasi', 'pasien')
            ->where('id_tenaga_ahli', $IdtenagaAhli)
            ->orderBy('created_at', 'desc')
            ->get();
        
        // Jika ada id, ambil konsultasi tersebut
        if ($id) {
            // Ambil data konsultasi tertentu berdasarkan id
            $konsultasi = Konsultasi::with(['pesanKonsultasi' => function($query) {
                $query->orderBy('created_at', 'desc');
            }])
            ->where('id', $id)
            ->where('id_tenaga_ahli', $IdtenagaAhli) // Pastikan konsultasi milik tenaga ahli yang login
            ->first();
            
            // Jika konsultasi tidak ditemukan atau bukan milik tenaga ahli yang login
            if (!$konsultasi) {
                return redirect()->back()->with('error', 'Anda tidak memiliki akses ke konsultasi ini.');
            }
        } else {
            // Jika tidak ada id, kita set konsultasi menjadi null
            $konsultasi = null;
        }
    
        // Return halaman percakapan dengan data konsultasi dan riwayat
        return view('TenagaAhli/percakapan_konsultasi', [
            'title' => 'Percakapan',
            'konsultasi' => $konsultasi,
            'riwayatKonsultasi' => $riwayatKonsultasi,
        ]);
    }

    public function sendMessage(Request $request, $id_konsultasi)
    {
        $request->validate([
            'pesan' => 'required|string|max:255',
            'pengirim' => 'required|in:tenaga ahli,pasien'
        ]);

        $message = PesanKonsultasi::create([
            'id_konsultasi' => $id_konsultasi,
            'pesan' => $request->pesan,
            'pengirim' => $request->pengirim,
            'is_showed_to_patient' => true
        ]);

        return response()->json($message);
    }

    public function storePesanHasilKonsultasi(Request $request, $id_konsultasi)
    {
        $validated = $request->validate([
            'pesan_tenaga_ahli' => 'required',
        ]);

        $konsultasi = Konsultasi::find($id_konsultasi);
        if (!$konsultasi) {
            return redirect()->back()->with('error', 'Konsultasi tidak ditemukan.');
        }
        if ($konsultasi->status !== 'done') {
            return redirect()->back()->with('error', 'Anda hanya dapat memberikan pesan hasil pada sesi yang telah selesai.');
        }

        $konsultasi->update([
            'pesan_tenaga_ahli' => $validated['pesan_tenaga_ahli'],
        ]);

        return redirect()->back()->with('success', 'Pesan hasil konsultasi berhasil disimpan.');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $konsultasi = Konsultasi::orderBy('created_at', 'desc')->paginate(10);
        return view('Admin/data_konsultasi', [
            "title" => "Data Konsultasi",
            "konsultasi" => $konsultasi
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_tenaga_ahli' => 'required|exists:tenaga_ahli,id',
        ]);
    
        $user = Auth::user();
        $idPasien = $user->pasien->id;
    
        $tenagaAhli = TenagaAhli::find($request->id_tenaga_ahli);
    
        if (!$tenagaAhli->is_available) {
            return redirect()->back()->with('error', 'Tenaga ahli tidak tersedia saat ini. Silakan coba lagi nanti.');
        }
    
        $ongoingKonsultasi = Konsultasi::where('id_pasien', $idPasien)
            ->where('status', 'on going')
            ->exists();
    
        if ($ongoingKonsultasi) {
            return redirect()->back()->with('error', 'Anda masih memiliki konsultasi yang sedang berjalan.');
        }
    
        try {
            DB::beginTransaction();
    
            $konsultasi = Konsultasi::create([
                'id_tenaga_ahli' => $tenagaAhli->id,
                'id_pasien' => $idPasien,
                'status' => 'on going',
                'started_at' => now(),
                'ends_at' => now()->addMinutes(30)->addSeconds(30),
            ]);
    
            $tenagaAhli->update(['is_available' => false]);
    
            $transaksi = TransaksiKonsultasi::create([
                'id_konsultasi' => $konsultasi->id,
                'snap_token' => Str::uuid(), // Membuat token unik sementara, nanti digantikan dengan Snap Midtrans
                'amount' => $tenagaAhli->biaya_konsultasi,
                'status' => 'paid',
                'expired_at' => null,
            ]);

            // Tambahkan logika untuk memperbarui tabungan tenaga ahli
            $tabunganBaru = $tenagaAhli->tabungan + ($transaksi->amount * 0.9);
            $tenagaAhli->update(['tabungan' => $tabunganBaru]);
    
            DB::commit();
    
            return redirect()->route('chat.index', $konsultasi->id)->with('success', 'Konsultasi berhasil dibuat');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat membuat konsultasi. Silakan coba lagi.');
        }
    }    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $konsultasi = Konsultasi::findOrFail($id);
        return view('Admin/Template/data_konsultasi', [
            "title" => "Data Transaksi Konsultasi",
            "konsultasi" => $konsultasi
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $konsultasi = Konsultasi::findOrFail($id);

        if(Auth::user()->role === 'pasien'){
            $konsultasi->pesanKonsultasi()->update(['is_showed_to_patient' => false]);
        
            return redirect()->route('chat.index')->with('success', 'Konsultasi berhasil diarsipkan dan pesan telah dihapus.');
        } else if (Auth::user()->role === 'admin'){
            $konsultasi->delete();

            return redirect()->back()->with('success', 'Data konsultasi berhasil dihapus!');
        }
    }
    
}
