<?php

namespace App\Http\Controllers;

use App\Models\TransaksiKonsultasi;
use Illuminate\Http\Request;

class TransaksiKonsultasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transaksi = TransaksiKonsultasi::orderBy('created_at', 'desc')->paginate(10);
        return view('Admin/data_transaksi_konsultasi', [
            "title" => "Data Transaksi Konsultasi",
            "transaksi" => $transaksi
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
        $transaksi = TransaksiKonsultasi::findOrFail($id);
        return view('Admin/Template/data_transaksi_konsultasi', [
            "title" => "Data Transaksi Konsultasi",
            "transaksi" => $transaksi
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
        $transaksi = TransaksiKonsultasi::findOrFail($id);
        $transaksiDeleted = $transaksi->delete();

        if ($transaksiDeleted) {
            return redirect()->back()->with('success', 'Data transaksi konsultasi berhasil dihapus!');
        } else {
            return redirect()->back()->with('error', 'Data transaksi konsultasi gagal dihapus!');
        }
    }
}
