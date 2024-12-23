<?php

namespace Database\Seeders;

use App\Models\AktivitasPositif;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AktivitasPositifSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AktivitasPositif::insert([
            ['nama' => 'Meditasi', 'gambar' => 'seeder/aktivitas-positif/meditation.svg'],
            ['nama' => 'Olahraga', 'gambar' => 'seeder/aktivitas-positif/sports.svg'],
            ['nama' => 'Membaca Buku', 'gambar' => 'seeder/aktivitas-positif/reading.svg'],
            ['nama' => 'Berjalan Kaki', 'gambar' => 'seeder/aktivitas-positif/walking.svg'],
            ['nama' => 'Menulis Jurnal', 'gambar' => 'seeder/aktivitas-positif/writing.svg'],
            ['nama' => 'Berkebun', 'gambar' => 'seeder/aktivitas-positif/planting.svg'],
            ['nama' => 'Menggambar', 'gambar' => 'seeder/aktivitas-positif/drawing.svg'],
            ['nama' => 'Mendengarkan Musik', 'gambar' => 'seeder/aktivitas-positif/listen-music.svg'],
            ['nama' => 'Jogging', 'gambar' => 'seeder/aktivitas-positif/jogging.svg'],
            ['nama' => 'Bersepeda', 'gambar' => 'seeder/aktivitas-positif/cycling.svg'],
        ]);
    }
}
