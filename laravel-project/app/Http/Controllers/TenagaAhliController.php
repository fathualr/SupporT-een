<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\TenagaAhli;
use App\Models\RiwayatPendidikanTenagaAhli;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class TenagaAhliController extends Controller
{
    public function updateStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'is_available' => 'required|boolean',
        ]);

        $tenagaAhli = TenagaAhli::find($id);
        if (!$tenagaAhli) {
            return response()->json(['message' => 'Data Tenaga Ahli tidak ditemukan.'], 404);
        }
        $tenagaAhli->update([
            'is_available' => $validated['is_available'],
        ]);
    
        return response()->json(['message' => 'Status berhasil diperbarui.']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tenagaAhlis = TenagaAhli::with(['user', 'riwayatPendidikan'])->paginate(10);
        return view('Admin/data_tenaga_ahli', [
            "title" => "Data Tenaga Ahli",
            "tenagaAhlis" => $tenagaAhlis
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin/Form/tambah_data_tenaga_ahli', [
            "title" => "Tambah Data Tenaga Ahli"
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        DB::beginTransaction();

        try {
            if ($request->hasFile('foto_profil')) {
                $foto_profil = $request->file('foto_profil')->store('image/foto_profil', 'public');
            }

            $user = User::create([
                'role' => $request->role,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'nama' => $request->nama,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tanggal_lahir' => $request->tanggal_lahir,
                'foto_profil' => $foto_profil ?? null,
            ]);

            $tenagaAhli = TenagaAhli::create([
                'id_user' => $user->id,
                'nomor_str' => $request->nomor_str,
                'spesialisasi' => $request->spesialisasi,
                'jadwal_aktif' => $request->jadwal_aktif,
                'lokasi_praktik' => $request->lokasi_praktik,
                'biaya_konsultasi' => $request->biaya_konsultasi,
                'tabungan' => $request->tabungan,
            ]);

            if ($request->filled('riwayat_pendidikan')) {
                RiwayatPendidikanTenagaAhli::create([
                    'id_tenaga_ahli' => $tenagaAhli->id,
                    'keterangan' => $request->riwayat_pendidikan
                ]);
            }

            DB::commit();
            $totalTenagaAhli = TenagaAhli::count();
            $perPage = 10;
            $lastPage = ceil($totalTenagaAhli / $perPage);

            return redirect()->route('user-tenaga-ahli.index', ['page' => $lastPage])
                            ->with('success', 'Data tenaga ahli berhasil ditambahkan!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Data tenaga ahli gagal ditambahkan! Pesan error: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tenagaAhli = TenagaAhli::with('user', 'riwayatPendidikan')->findOrFail($id);
        return view('Admin/Template/data_tenaga_ahli', [
            "title" => "Data Tenaga Ahli",
            "tenagaAhli" => $tenagaAhli
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $tenagaAhli = TenagaAhli::with('user')->findOrFail($id);
        return view('Admin/Form/edit_data_tenaga_ahli', [
            "title" => "Edit Data Tenaga Ahli",
            "tenagaAhli" => $tenagaAhli
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, string $id)
    {
        DB::beginTransaction();

        try {
            $tenagaAhli = TenagaAhli::with('user')->findOrFail($id);
            $user = $tenagaAhli->user;

            $request->validate([
                'email' => [
                    'required',
                    'email',
                    Rule::unique('user', 'email')->ignore($user->id),
                ],
            ]);

            if ($request->hasFile('foto_profil')) {
                if ($user->foto_profil) {
                    Storage::disk('public')->delete($user->foto_profil);
                }
                $foto_profil = $request->file('foto_profil')->store('image/foto_profil', 'public');
                $user->foto_profil = $foto_profil;
            }

            $user->update([
                'email' => $request->email,
                'password' => $request->filled('password') ? Hash::make($request->password) : $user->password,
                'nama' => $request->nama,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tanggal_lahir' => $request->tanggal_lahir,
            ]);

            $tenagaAhli->update([
                'nomor_str' => $request->nomor_str,
                'spesialisasi' => $request->spesialisasi,
                'jadwal_aktif' => $request->jadwal_aktif,
                'lokasi_praktik' => $request->lokasi_praktik,
                'biaya_konsultasi' => $request->biaya_konsultasi,
                'tabungan' => $request->tabungan,
            ]);

            DB::commit();
            $position = TenagaAhli::orderBy('id')->pluck('id')->search($tenagaAhli->id) + 1;
            $perPage = 10;
            $page = ceil($position / $perPage);
            
            return redirect()->route('user-tenaga-ahli.index', ['page' => $page])
                            ->with('success', 'Data tenaga ahli berhasil diubah!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Data tenaga ahli gagal diubah! Pesan error: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        if ($user->foto_profil) {
            Storage::disk('public')->delete($user->foto_profil);
        }
        $userDeleted = $user->delete();

        if ($userDeleted) {
            return redirect()->back()->with('success', 'Data tenaga ahli berhasil dihapus!');
        } else {
            return redirect()->back()->with('error', 'Data tenaga ahli gagal dihapus!');
        }
    }
}
