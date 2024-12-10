<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admins = Admin::with('user')->paginate(10);
        return view('Admin/data_administrator', [
            "title" => "Data Admin",
            "admins" => $admins
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin/Form/tambah_data_administrator', [
            "title" => "Tambah Data Admin"
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

            Admin::create([
                'id_user' => $user->id,
                'admin_role' => $request->admin_role,
            ]);

            DB::commit();
            $totalAdmins = Admin::count();
            $perPage = 10;
            $lastPage = ceil($totalAdmins / $perPage);

            return redirect()->route('user-admin.index', ['page' => $lastPage])
                            ->with('success', 'Data admin berhasil ditambahkan!');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Data admin gagal ditambahkan! Pesan error: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $admin = Admin::with('user')->findOrFail($id);
        return view('Admin/Template/data_administrator', [
            "title" => "Data Admin",
            "admin" => $admin
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $admin = Admin::with('user')->findOrFail($id);
        return view('Admin/Form/edit_data_administrator', [
            "title" => "Tambah Data Admin",
            "admin" => $admin
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, $id)
    {
        DB::beginTransaction();

        try {
            $admin = Admin::with('user')->findOrFail($id);
            $user = $admin->user;

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

            $admin->update([
                'admin_role' => $request->admin_role,
            ]);

            DB::commit();
            $position = Admin::orderBy('id')->pluck('id')->search($admin->id) + 1;
            $perPage = 10;
            $page = ceil($position / $perPage);
            
            return redirect()->route('user-admin.index', ['page' => $page])
                            ->with('success', 'Data admin berhasil diubah!');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Data admin gagal diubah! Pesan error: ' . $e->getMessage());
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
            return redirect()->back()->with('success', 'Data admin berhasil dihapus!');
        } else {
            return redirect()->back()->with('error', 'Data admin gagal dihapus!');
        }
    }
}
