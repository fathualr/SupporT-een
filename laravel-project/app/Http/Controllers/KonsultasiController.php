<?php

namespace App\Http\Controllers;

use App\Models\Konsultasi;
use App\Models\TransaksiKonsultasi;
use App\Models\TenagaAhli;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Str; // Untuk membuat order_id unik


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

        $pasienId = Auth::user()->pasien->id;
        
        $riwayatKonsultasi = Konsultasi::with('pesanKonsultasi', 'tenagaAhli')
            ->where('id_pasien', $pasienId)
            ->get();

        return view('Pasien/konsultasi', [
            "title" => "Konsultasi Online",
            "tenagaAhli" => $tenagaAhli,
            "selectedTenagaAhli" => $selectedTenagaAhli,
            "riwayatKonsultasi" => $riwayatKonsultasi,
        ]);
    }
    
    public function pasienKonsultasi()
    {
        return view('Pasien/percakapan_konsultasi', [
            "title" => "Percakapan"
        ]);
    }
    
    public function tenagaAhliKonsultasi()
    {
        return view('TenagaAhli/percakapan_konsultasi', [
            "title" => "Percakapan"
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {

    // }

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
        //
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
        //
    }
}
