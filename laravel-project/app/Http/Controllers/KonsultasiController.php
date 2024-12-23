<?php

namespace App\Http\Controllers;

use App\Events\NewChatMessage;
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
        $tenagaAhli = TenagaAhli::with('user')->orderBy('is_available', 'desc')->get();
        $selectedTenagaAhli = null;

        if ($id) {
            $selectedTenagaAhli = TenagaAhli::with(['user', 'riwayatPendidikan'])
                ->where('id', $id)
                ->first();
            if (!$selectedTenagaAhli) {
                return redirect()->back()->with('error', 'Tenaga ahli tidak dapat ditemukan.');
            }
        }

        $idPasien = Auth::user()->pasien->id;

        // Ambil semua riwayat konsultasi untuk pasien tersebut dengan filter transaksi status = 'paid'
        $riwayatKonsultasi = Konsultasi::with(['pesanKonsultasi', 'tenagaAhli'])
            ->where('id_pasien', $idPasien)
            ->whereHas('transaksiKonsultasi', function ($query) {
                $query->where('status', 'paid');
            })
            ->orderBy('created_at', 'desc')
            ->get();

        // Filter hanya konsultasi yang semua pesan is_showed_to_patient = true
        $riwayatKonsultasi = $riwayatKonsultasi->filter(function ($konsultasi) {
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
        $idPasien = Auth::user()->pasien->id;

        $konsultasi = Konsultasi::with(['pesanKonsultasi' => function ($query) {
                $query->where('is_showed_to_patient', true)
                    ->orderBy('created_at', 'desc');
            }])
            ->where('id', $id_konsultasi)
            ->where('id_pasien', $idPasien)
            ->whereHas('transaksiKonsultasi', function ($query) {
                $query->where('status', 'paid');
            })
            ->first();

        if (!$konsultasi) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses ke konsultasi ini.');
        }

        $riwayatKonsultasi = Konsultasi::with(['pesanKonsultasi', 'tenagaAhli'])
            ->where('id_pasien', $idPasien)
            ->whereHas('transaksiKonsultasi', function ($query) {
                $query->where('status', 'paid');
            })
            ->orderBy('created_at', 'desc')
            ->get();

        $riwayatKonsultasi = $riwayatKonsultasi->filter(function ($konsultasi) {
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
        $IdtenagaAhli = Auth::user()->tenagaAhli->id;

        $riwayatKonsultasi = Konsultasi::with('pesanKonsultasi', 'pasien')
            ->where('id_tenaga_ahli', $IdtenagaAhli)
            ->whereHas('transaksiKonsultasi', function ($query) {
                $query->where('status', 'paid');
            })
            ->orderBy('created_at', 'desc')
            ->get();

        if ($id) {
            $konsultasi = Konsultasi::with(['pesanKonsultasi' => function ($query) {
                $query->orderBy('created_at', 'desc');
            }])
                ->where('id', $id)
                ->where('id_tenaga_ahli', $IdtenagaAhli)
                ->whereHas('transaksiKonsultasi', function ($query) {
                    $query->where('status', 'paid');
                })
                ->first();

            if (!$konsultasi) {
                return redirect()->back()->with('error', 'Anda tidak memiliki akses ke konsultasi ini.');
            }
        } else {
            $konsultasi = null;
        }

        return view('TenagaAhli/percakapan_konsultasi', [
            'title' => 'Percakapan',
            'konsultasi' => $konsultasi,
            'riwayatKonsultasi' => $riwayatKonsultasi,
        ]);
    }

    public function pasienPembayaran($IdtenagaAhli){
        $tenagaAhli = TenagaAhli::findOrFail($IdtenagaAhli);
        if (!$tenagaAhli->is_available) {
            // If the doctor is not available, return an error message or redirect
            return redirect()->back()->with('error', 'Dokter ini sedang tidak tersedia untuk konsultasi.');
        }
        $idPasien = Auth::user()->pasien->id;
        
        // Ambil semua riwayat konsultasi untuk pasien tersebut
        $riwayatKonsultasi = Konsultasi::with(['pesanKonsultasi', 'tenagaAhli'])
            ->where('id_pasien', $idPasien)
            ->whereHas('transaksiKonsultasi', function ($query) {
                $query->where('status', 'paid');
            })
            ->orderBy('created_at', 'desc')
            ->get();

        // Filter hanya konsultasi yang semua pesan is_showed_to_patient = true
        $riwayatKonsultasi = $riwayatKonsultasi->filter(function ($konsultasi) {
            // Periksa apakah semua pesan pada konsultasi memiliki is_showed_to_patient = true
            return $konsultasi->pesanKonsultasi->every(function ($pesan) {
                return $pesan->is_showed_to_patient == true;
            });
        });

        return view('Pasien/pembayaran_konsultasi', [
            'title' => 'Pembayaran Konsultasi',
            'tenagaAhli' => $tenagaAhli,
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
        broadcast(new NewChatMessage($message))->toOthers();
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
        $konsultasi = Konsultasi::whereHas('transaksiKonsultasi', function ($query) {
            $query->where('status', 'paid');
        })
        ->orderBy('created_at', 'desc')
        ->paginate(10);

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
        //
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
        $konsultasi = Konsultasi::with('pesanKonsultasi')->findOrFail($id);

        if(Auth::user()->role === 'pasien'){
            if ($konsultasi->pesanKonsultasi->isEmpty()) {
                // Hapus konsultasi jika tidak memiliki pesan
                $konsultasi->delete();
                return redirect()->route('konsultasi.index')->with('success', 'Konsultasi berhasil dihapus karena tidak memiliki pesan.');
            } else {
                // Jika ada pesan, ubah is_showed_to_patient menjadi false
                $konsultasi->pesanKonsultasi()->update(['is_showed_to_patient' => false]);
                return redirect()->route('konsultasi.index')->with('success', 'Konsultasi berhasil diarsipkan dan pesan telah dihapus.');
            }
        } else if (Auth::user()->role === 'admin'){
            $konsultasi->delete();

            return redirect()->back()->with('success', 'Data konsultasi berhasil dihapus!');
        }
    }
    //------------------------------------------

    public function generateSnapTokenKonsultasi(Request $request)
    {
        try {
            $user = Auth::user();
            $idPasien = $user->pasien->id;
            $tenagaAhli = TenagaAhli::findOrFail($request->id_tenaga_ahli);

            if (!$tenagaAhli->is_available) {
                return response()->json([
                    'error' => 'Tenaga ahli tidak tersedia saat ini.'
                ], 400);
            }

            $ongoingKonsultasi = Konsultasi::where('id_pasien', $idPasien)
                ->where('status', 'on going')
                ->exists();

            if ($ongoingKonsultasi) {
                return response()->json([
                    'error' => 'Anda masih memiliki konsultasi yang sedang berjalan.'
                ], 400);
            }

            Config::$serverKey = config('midtrans.serverKey');
            Config::$isProduction = false;
            Config::$isSanitized = true;
            Config::$is3ds = true;

            DB::beginTransaction();

            $konsultasi = Konsultasi::create([
                'id_tenaga_ahli' => $tenagaAhli->id,
                'id_pasien' => $idPasien,
                'status' => null,
                'started_at' => null,
                'ends_at' => null,
            ]);

            $params = [
                'transaction_details' => [
                    'order_id' => 'KONS-' . $konsultasi->id,
                    'gross_amount' => $tenagaAhli->biaya_konsultasi,
                ],
                'customer_details' => [
                    'first_name' => $user->nama,
                    'email' => $user->email,
                ],
            ];

            $snapToken = Snap::getSnapToken($params);

            $transaksi = TransaksiKonsultasi::create([
                'id_konsultasi' => $konsultasi->id,
                'snap_token' => $snapToken,
                'amount' => $tenagaAhli->biaya_konsultasi,
                'status' => 'pending',
                'expired_at' => now()->addMinutes(20),
            ]);

            DB::commit();

            return response()->json([
                'snap_token' => $snapToken,
                'transaction_id' => $transaksi->id,
                'konsultasi_id' => $konsultasi->id,
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Terjadi kesalahan server.'], 500);
        }
    }

    public function processKonsultasiPayment(Request $request, $transactionId)
    {
        try {
            $transaksi = TransaksiKonsultasi::with('konsultasi')->findOrFail($transactionId);
            $paymentResult = $request->input('payment_result');

            DB::beginTransaction();

            if ($paymentResult['status_code'] == 200) {
                // Update status transaksi
                $transaksi->update([
                    'payment_method' => $paymentResult['payment_type'],
                    'status' => 'paid',
                    'expired_at' => null,
                ]);

                // Update konsultasi
                $konsultasi = $transaksi->konsultasi;
                $konsultasi->update([
                    'status' => 'on going',
                    'started_at' => now(),
                    'ends_at' => now()->addMinutes(30)->addSeconds(30),
                ]);

                // Update status tenaga ahli
                TenagaAhli::where('id', $konsultasi->id_tenaga_ahli)
                    ->update(['is_available' => false]);

                // Update tabungan tenaga ahli (90% dari biaya konsultasi)
                $tenagaAhli = TenagaAhli::find($konsultasi->id_tenaga_ahli);
                $tenagaAhli->increment('tabungan', $transaksi->amount * 0.9);

                DB::commit();

                return response()->json([
                    'success' => true,
                    'konsultasi_id' => $konsultasi->id
                ]);
            }

            DB::rollBack();
            return response()->json([
                'success' => false, 
                'message' => 'Pembayaran gagal.'
            ], 400);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false, 
                'message' => 'Kesalahan server.'
            ], 500);
        }
    }
}
