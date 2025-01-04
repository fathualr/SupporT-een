<?php

namespace App\Http\Controllers;

use App\Http\Requests\JurnalHarianRequest;
use App\Models\JurnalHarian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class JurnalHarianController extends Controller
{

    public function jurnalHarian(Request $request, $id = null)
    {
        // Mendapatkan user yang sedang login
        $user = Auth::user();
        $idPasien = $user->pasien->id;

        // Mengambil daftar jurnal harian berdasarkan id_pasien, diurutkan berdasarkan waktu terakhir dibuat
        $jurnalHarianList = JurnalHarian::where('id_pasien', $idPasien)
            ->orderBy('updated_at', 'desc')
            ->get();

        // Menyiapkan variabel untuk jurnal yang dipilih (jika ada)
        $selectedJurnal = null;
        $emotionData = null;

        // Jika ada ID jurnal yang diberikan, ambil jurnal yang sesuai
        if ($id) {
            $selectedJurnal = JurnalHarian::where('id', $id)
                ->where('id_pasien', $idPasien)
                ->first();

            // Jika jurnal tidak ditemukan atau bukan milik pasien yang login, kembalikan error
            if (!$selectedJurnal) {
                return redirect()->back()->with('error', 'Anda tidak memiliki akses ke jurnal ini.');
            }

            // Decode nilai emosi jika tersedia
            if ($selectedJurnal->nilai_emosi) {
                $emotionData = json_decode($selectedJurnal->nilai_emosi, true);
            }
        }

        // Kembalikan data ke view dengan daftar jurnal, jurnal yang dipilih, dan data emosi
        return view('Pasien/jurnal_harian', [
            'title' => 'Jurnal Harian',
            'jurnalHarianList' => $jurnalHarianList,
            'selectedJurnal' => $selectedJurnal,
            'emotionData' => $emotionData, // Data emosi untuk grafik
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(JurnalHarianRequest $request)
    {
        // Mendapatkan user yang sedang login dan ID pasien
        $user = Auth::user();
        $idPasien = $user->pasien->id;

        // Validasi tambahan: Pastikan salah satu diisi
        if (empty($request->judul) && empty($request->isi)) {
            return redirect()->back()->with('error', 'Judul atau Isi jurnal harus diisi.')->withInput();
        }

        // Gabungkan judul dan isi sebagai input untuk analisis emosi
        $content = $request->judul . ' ' . $request->isi;

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer '.env('FLASK_API_KEY'),
                'Content-Type' => 'application/json',
            ])->post(env('FLASK_SERVICE_URL'). '/emotion', [
                'text' => $content,
            ]);

            if ($response->successful()) {
                $emotionResults = $response->json('emotion_results');

                // Pastikan semua 7 emosi ada
                $allEmotions = [
                    "neutral" => 0,
                    "joy" => 0,
                    "sadness" => 0,
                    "surprise" => 0,
                    "disgust" => 0,
                    "anger" => 0,
                    "fear" => 0,
                ];

                foreach ($emotionResults as $emotion) {
                    $allEmotions[$emotion['label']] = $emotion['score'];
                }

                // Konversi ke array format JSON
                $emotionData = [];
                foreach ($allEmotions as $label => $score) {
                    $emotionData[] = [
                        'label' => $label,
                        'score' => $score,
                    ];
                }

                // Simpan jurnal harian beserta nilai emosi
                $kontenData = [
                    'id_pasien' => $idPasien,
                    'judul' => $request->judul,
                    'isi' => $request->isi,
                    'nilai_emosi' => json_encode($emotionData), // Simpan hasil emosi dalam format JSON
                ];

                $jurnal = JurnalHarian::create($kontenData);

                // Redirect ke halaman daftar jurnal dengan ID jurnal baru
                return redirect()->route('jurnalHarian.index', ['id' => $jurnal->id])
                    ->with('success', 'Jurnal berhasil disimpan.');
            } else {
                return redirect()->back()->with('error', 'Gagal menganalisis emosi.')->withInput();
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memproses permintaan: ' . $e->getMessage())->withInput();
        }
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
    public function update(JurnalHarianRequest $request, $id)
    {
        // Validasi tambahan: Pastikan salah satu diisi
        if (empty($request->judul) && empty($request->isi)) {
            return redirect()->back()->with('error', 'Judul atau Isi jurnal harus diisi.')->withInput();
        }
    
        // Mendapatkan user yang sedang login dan ID pasien
        $user = Auth::user();
        $idPasien = $user->pasien->id;
    
        // Temukan jurnal berdasarkan ID
        $jurnal = JurnalHarian::where('id', $id)->where('id_pasien', $idPasien)->first();
    
        // Pastikan jurnal ditemukan dan milik pasien yang login
        if (!$jurnal) {
            return redirect()->route('jurnalHarian.index')
                ->with('error', 'Jurnal tidak ditemukan atau Anda tidak memiliki akses.');
        }
    
        // Gabungkan judul dan isi sebagai input untuk analisis emosi
        $content = $request->judul . ' ' . $request->isi;
    
        try {
            // Panggil API /emotion pada Flask
            $response = Http::withHeaders([
                'Authorization' => 'Bearer '.env('FLASK_API_KEY'),
                'Content-Type' => 'application/json',
            ])->post(env('FLASK_SERVICE_URL'). '/emotion', [
                'text' => $content,
            ]);
    
            if ($response->successful()) {
                $emotionResults = $response->json('emotion_results');
    
                // Pastikan semua 7 emosi ada
                $allEmotions = [
                    "neutral" => 0,
                    "joy" => 0,
                    "sadness" => 0,
                    "surprise" => 0,
                    "disgust" => 0,
                    "anger" => 0,
                    "fear" => 0,
                ];
    
                foreach ($emotionResults as $emotion) {
                    $allEmotions[$emotion['label']] = $emotion['score'];
                }
    
                // Konversi ke array format JSON
                $emotionData = [];
                foreach ($allEmotions as $label => $score) {
                    $emotionData[] = [
                        'label' => $label,
                        'score' => $score,
                    ];
                }
    
                // Perbarui data jurnal beserta nilai emosi
                $jurnal->update([
                    'judul' => $request->judul,
                    'isi' => $request->isi,
                    'nilai_emosi' => json_encode($emotionData), // Perbarui hasil emosi dalam format JSON
                ]);
    
                // Redirect ke halaman daftar jurnal dengan pesan sukses
                return redirect()->route('jurnalHarian.index', ['id' => $jurnal->id])
                    ->with('success', 'Jurnal berhasil diperbarui.');
            } else {
                return redirect()->back()->with('error', 'Gagal menganalisis emosi.')->withInput();
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memproses permintaan: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jurnal = JurnalHarian::findOrFail($id);
    
        $jurnal->delete();
    
        return redirect()->route('jurnalHarian.index')->with('success', 'Jurnal berhasil dihapus.');
    }
}
