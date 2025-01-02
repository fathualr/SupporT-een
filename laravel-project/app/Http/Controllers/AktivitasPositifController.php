<?php

namespace App\Http\Controllers;

use App\Http\Requests\AktivitasPositifRequest;
use App\Models\AktivitasPositif;
use App\Models\AktivitasPribadi;
use App\Models\RiwayatAktivitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class AktivitasPositifController extends Controller
{
    public function kustomisasiAktivitasPribadi()
    {
        $pasienId = Auth::user()->pasien->id; // Ambil ID pasien
    
        // Ambil aktivitas positif beserta status apakah sudah dipilih
        $aktivitasPositif = AktivitasPositif::all()->map(function ($aktivitas) use ($pasienId) {
            $aktivitas->is_selected = AktivitasPribadi::where('id_pasien', $pasienId)
                ->where('id_aktivitas_positif', $aktivitas->id)
                ->exists();
            return $aktivitas;
        });
    
        // Ambil data riwayat aktivitas dan kelompokkan berdasarkan tanggal
        $riwayatAktivitas = RiwayatAktivitas::with('aktivitasPositif')
            ->where('id_pasien', $pasienId)
            ->get()
            ->groupBy(function ($item) {
                return \Carbon\Carbon::parse($item->created_at)->format('Y-m-d');
            });
    
        return view('Pasien/daftar_kustomisasi_aktivitas', [
            "title" => "Kustomisasi Aktivitas",
            "aktivitasPositif" => $aktivitasPositif,
            "riwayatAktivitas" => $riwayatAktivitas
        ]);
    }
    

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $aktivitasPositif = AktivitasPositif::paginate(10);
        return view('Admin/data_aktivitas_positif', [
            "title" => "Data Aktivitas Positif",
            "aktivitasPositif" => $aktivitasPositif
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin/Form/tambah_data_aktivitas_positif', [
            "title" => "Tambah Data Aktivitas Positif"
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AktivitasPositifRequest $request)
    {
        DB::beginTransaction();

        try {
            $aktivitasData = [
                'nama' => $request->nama,
            ];

            if ($request->hasFile('gambar')) {
                $gambarPath = $request->file('gambar')->store('image/aktivitas-positif', 'public');
                $aktivitasData['gambar'] = $gambarPath;
            }

            $aktivitasPositif = AktivitasPositif::create($aktivitasData);

            DB::commit();
            $totalAktivitas = AktivitasPositif::count();
            $perPage = 10;
            $lastPage = ceil($totalAktivitas / $perPage);

            return redirect()->route('aktivitas-positif.index', ['page' => $lastPage])
                            ->with('success', 'Data Aktivitas Positif berhasil ditambahkan!');
        } catch (\Exception $e) {
            DB::rollback();

            if (isset($gambarPath)) {
                Storage::disk('public')->delete($gambarPath);
            }

            return redirect()->back()
                            ->with('error', 'Gagal menyimpan data aktivitas positif. Pesan error: ' . $e->getMessage())
                            ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $aktivitasPositif = AktivitasPositif::findOrFail($id);
        return view('Admin/Template/data_daftar_aktivitas_positif', [
            "title" => "Data Aktivitas Positif",
            "aktivitasPositif" => $aktivitasPositif
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $aktivitasPositif = AktivitasPositif::findOrFail($id);
        return view('Admin/Form/edit_data_aktivitas', [
            "title" => "Data Aktivitas Positif",
            "aktivitasPositif" => $aktivitasPositif
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AktivitasPositifRequest $request, $id)
    {
        try {
            $aktivitasPositif = AktivitasPositif::findOrFail($id);

            $aktivitasData = [
                'nama' => $request->nama,
            ];

            if ($request->hasFile('gambar')) {
                if ($aktivitasPositif->gambar) {
                    Storage::disk('public')->delete($aktivitasPositif->gambar);
                }

                $gambarPath = $request->file('gambar')->store('image/aktivitas-positif', 'public');
                $aktivitasData['gambar'] = $gambarPath;
            }

            $aktivitasPositif->update($aktivitasData);

            $position = AktivitasPositif::orderBy('id')->pluck('id')->search($aktivitasPositif->id) + 1;
            $perPage = 10;
            $page = ceil($position / $perPage);

            return redirect()->route('aktivitas-positif.index', ['page' => $page])
                            ->with('success', 'Aktivitas positif berhasil diubah!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Aktivitas positif gagal diubah! Pesan error: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $konten = AktivitasPositif::findOrFail($id);

        if ($konten->gambar) {
            Storage::disk('public')->delete($konten->gambar);
        }
        $kontenDeleted = $konten->delete();

        if ($kontenDeleted) {
            return redirect()->back()->with('success', 'Data aktivitas positif berhasil dihapus!');
        } else {
            return redirect()->back()->with('error', 'Data aktivitas positif gagal dihapus!');
        }
    }
}
