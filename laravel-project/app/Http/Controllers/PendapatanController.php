<?php

namespace App\Http\Controllers;

use App\Http\Requests\PenarikanSaldoRequest;
use App\Models\PenarikanSaldo;
use App\Models\TenagaAhli;
use App\Models\TransaksiKonsultasi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PendapatanController extends Controller
{
    public function tenagaAhliPendapatan()
    {
        $id = Auth::user()->tenagaAhli->id;
        $transaksi = TransaksiKonsultasi::whereHas('konsultasi', function ($query) use ($id) {
            $query->where('id_tenaga_ahli', $id);
        })->paginate(10);

        $riwayatPenarikan = PenarikanSaldo::where('id_user', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(10);
        return view('tenagaAhli/pendapatan', [
            "title" => "Pendapatan Tenaga Ahli",
            'transaksi' => $transaksi,
            'riwayatPenarikan' => $riwayatPenarikan
        ]);
    }
    
    public function adminPendapatan()
    {
        return view('admin/pendapatan', [
            "title" => "Pendapatan Admin"
        ]);
    }

        /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil data penarikan dengan pagination
        $penarikan = PenarikanSaldo::with('user') // Include relasi user
            ->orderBy('created_at', 'desc') // Urutkan berdasarkan tanggal terbaru
            ->paginate(10); // Batasi per halaman

        // Kembalikan ke view
        return view('Admin/data_penarikan_saldo', [
            "title" => "Data Penarikan Pendapatan",
            'penarikan' => $penarikan
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $riwayatPenarikan = PenarikanSaldo::where('id_user', Auth::user()->id)->paginate(10);
        return view('tenagaAhli/Form/tambah_data_penarikan_pendapatan', [
            "title" => "Tambah Data Penarikan Pendapatan",
            'riwayatPenarikan' => $riwayatPenarikan
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PenarikanSaldoRequest $request)
    {
        $tenagaAhli = Auth::user()->tenagaAhli;
    
        // Validasi apakah jumlah penarikan melebihi saldo tabungan
        if ($request->jumlah_penarikan > $tenagaAhli->tabungan) {
            return redirect()->back()->with('error', 'Jumlah penarikan melebihi saldo tabungan Anda.');
        }
    
        try {
            DB::beginTransaction();
    
            // Kurangi saldo tabungan
            $tenagaAhli->update([
                'tabungan' => $tenagaAhli->tabungan - $request->jumlah_penarikan,
            ]);
    
            // Simpan data penarikan
            PenarikanSaldo::create([
                'id_user' => Auth::id(),
                'jumlah_penarikan' => $request->jumlah_penarikan,
                'provider' => $request->provider,
                'nomor_tujuan' => $request->nomor_tujuan,
                'bukti_buku_tabungan' => $request->file('bukti_buku_tabungan')->store('bukti-tabungan', 'public'),
                'pesan_penarikan' => $request->pesan_penarikan,
                'status' => 'menunggu',
            ]);
    
            DB::commit();
    
            return redirect()->route('pendapatanTenagaAhli.index')->with('success', 'Penarikan saldo berhasil diajukan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memproses penarikan.');
        }
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Cari data penarikan berdasarkan ID
        $penarikan = PenarikanSaldo::findOrFail($id);
    
        // Mengirimkan data penarikan ke view untuk ditampilkan pada form edit
        return view('Admin/Template/data_penarikan_saldo', [
            "title" => "Detail Data Penarikan Pendapatan",
            'penarikan' => $penarikan
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Cari data penarikan berdasarkan ID
        $penarikan = PenarikanSaldo::findOrFail($id);
    
        // Mengirimkan data penarikan ke view untuk ditampilkan pada form edit
        return view('Admin/Form/edit_data_penarikan_saldo', [
            "title" => "Edit Data Penarikan Pendapatan",
            'penarikan' => $penarikan
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Temukan penarikan berdasarkan ID
        $penarikan = PenarikanSaldo::findOrFail($id);

        // Cek apakah statusnya sudah 'disetujui' atau 'ditolak'
        if ($penarikan->status !== 'menunggu') {
            return back()->with('error', 'Status penarikan sudah diproses (disetujui/ditolak), tidak dapat diubah lagi.');
        }

        // Validasi manual untuk atribut yang diizinkan
        $validatedData = $request->validate([
            'status' => 'required|in:menunggu,ditolak,disetujui', // Status harus salah satu dari menunggu, ditolak, atau disetujui
            'bukti_transfer' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048', // Bukti transfer jika ada, harus berupa file dengan format tertentu
        ]);

        // Mulai transaksi untuk menghindari perubahan data yang tidak konsisten
        DB::beginTransaction();

        try {
            // Update status dan waktu persetujuan
            $penarikan->status = $validatedData['status'];

            // Jika status disetujui, maka set waktu persetujuan ke sekarang
            if ($penarikan->status === 'disetujui') {
                $penarikan->approved_at = now(); // Waktu persetujuan otomatis ke waktu sekarang
            }

            // Jika status disetujui, upload bukti transfer
            if ($request->hasFile('bukti_transfer')) {
                // Simpan bukti transfer dan simpan path-nya di database
                $path = $request->file('bukti_transfer')->store('bukti_transfer', 'public');
                $penarikan->bukti_transfer = $path;
            }

            // Jika statusnya "ditolak", kita mengembalikan nilai yang dikurangi di tabungan
            if ($penarikan->status === 'ditolak') {
                $user = User::findOrFail($penarikan->id_user);
                // Lalu ambil data tenaga ahli melalui relasi
                $tenagaAhli = $user->tenagaAhli;
                if ($tenagaAhli) {
                    // Kembalikan nilai yang dikurangi dari tabungan tenaga ahli
                    $tenagaAhli->tabungan += $penarikan->jumlah_penarikan;
                    $tenagaAhli->save();
                }
            }

            // Simpan perubahan
            $penarikan->save();

            // Commit transaksi jika semuanya berjalan dengan baik
            DB::commit();

            // Hitung jumlah total penarikan dan last page untuk pagination
            $totalPenarikan = PenarikanSaldo::count();
            $perPage = 10;
            $lastPage = ceil($totalPenarikan / $perPage);

            // Redirect ke halaman yang sesuai
            return redirect()->route('pendapatan.index', ['page' => $lastPage])
                            ->with('success', 'Permintaan penarikan telah berhasil diperbarui!');

        } catch (\Exception $e) {
            // Rollback transaksi jika ada error
            DB::rollBack();

            // Tampilkan error
            return back()->withErrors(['error' => 'Terjadi kesalahan saat memproses permintaan penarikan.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
