<?php

namespace Database\Seeders;

use App\Models\Balasan;
use App\Models\Diskusi;
use App\Models\GambarDiskusi;
use Illuminate\Support\Str;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DiskusiSeeder extends Seeder
{
    public function run()
    {
        $diskusi1 = Diskusi::create([
            'id' => Str::uuid(),
            'id_pasien' => 1,
            'judul' => 'Pertanyaan tentang gejala flu',
            'isi' => 'Apakah demam tinggi selama lebih dari 3 hari termasuk gejala flu yang serius?',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        
        $diskusi2 = Diskusi::create([
            'id' => Str::uuid(),
            'id_pasien' => 2,
            'judul' => 'Cara menjaga pola makan sehat',
            'isi' => 'Bagaimana cara menjaga pola makan yang sehat di tengah kesibukan kerja?',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        
        $diskusi3 = Diskusi::create([
            'id' => Str::uuid(),
            'id_pasien' => 2,
            'judul' => 'Tips kesehatan mental',
            'isi' => 'Kamu perlu menemukan hobi yang dirasa enjoy untuk dilakukan.',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        GambarDiskusi::insert([
            ['id_diskusi' => $diskusi1->id, 'gambar' => 'seeder/diskusi/flu1.png'],
            ['id_diskusi' => $diskusi1->id, 'gambar' => 'seeder/diskusi/flu2.png'],
            ['id_diskusi' => $diskusi2->id, 'gambar' => 'seeder/diskusi/polamakan.png'],
            ['id_diskusi' => $diskusi3->id, 'gambar' => 'seeder/diskusi/hobi1.png'],
            ['id_diskusi' => $diskusi3->id, 'gambar' => 'seeder/diskusi/hobi2.png'],
            ['id_diskusi' => $diskusi3->id, 'gambar' => 'seeder/diskusi/hobi3.png'],
            ['id_diskusi' => $diskusi3->id, 'gambar' => 'seeder/diskusi/hobi4.png'],
        ]);

        Balasan::insert([
            [
                'id_diskusi' => $diskusi1->id, 
                'id_pasien' => 2, 
                'isi' => 'Wah terima kasih ya',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_diskusi' => $diskusi1->id, 
                'id_pasien' => 1, 
                'isi' => 'Iya sama sama',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_diskusi' => $diskusi3->id, 
                'id_pasien' => 2, 
                'isi' => 'Semoga info ini bermanfaat',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
