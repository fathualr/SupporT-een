<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PenarikanSaldoRequest extends FormRequest
{
    /**
     * Tentukan apakah pengguna diizinkan untuk membuat request ini.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // Pastikan Anda telah mengatur otorisasi secara benar
    }

    /**
     * Tentukan aturan validasi untuk request ini.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'jumlah_penarikan' => 'required|numeric|min:0.01', // Validasi jumlah saldo
            'provider' => 'required|string|max:50', // Validasi nama provider
            'nomor_tujuan' => 'required|string|max:50', // Validasi nomor tujuan
            'bukti_buku_tabungan' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048', // File harus berupa gambar atau PDF
            'pesan_penarikan' => 'nullable|string|max:255', // Pesan opsional, maksimal 255 karakter
        ];
    }

    /**
     * Tentukan pesan kesalahan kustom untuk validasi.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'jumlah_penarikan.required' => 'Jumlah penarikan harus diisi.',
            'jumlah_penarikan.numeric' => 'Jumlah penarikan harus berupa angka.',
            'jumlah_penarikan.min' => 'Jumlah penarikan harus lebih dari 0.',
            'provider.required' => 'Provider harus diisi.',
            'provider.string' => 'Provider harus berupa teks.',
            'provider.max' => 'Provider tidak boleh lebih dari 50 karakter.',
            'nomor_tujuan.required' => 'Nomor tujuan harus diisi.',
            'nomor_tujuan.string' => 'Nomor tujuan harus berupa teks.',
            'nomor_tujuan.max' => 'Nomor tujuan tidak boleh lebih dari 50 karakter.',
            'bukti_buku_tabungan.required' => 'Bukti buku tabungan harus diunggah.',
            'bukti_buku_tabungan.file' => 'Bukti buku tabungan harus berupa file.',
            'bukti_buku_tabungan.mimes' => 'Bukti buku tabungan hanya dapat berupa file dengan format jpg, jpeg, png, atau pdf.',
            'bukti_buku_tabungan.max' => 'Ukuran file bukti buku tabungan tidak boleh lebih dari 2MB.',
            'pesan_penarikan.string' => 'Pesan penarikan harus berupa teks.',
            'pesan_penarikan.max' => 'Pesan penarikan tidak boleh lebih dari 255 karakter.',
        ];
    }
}
