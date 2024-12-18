<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Konsultasi;

class FinishedConsultation extends Command
{
    // Nama dan deskripsi command
    protected $signature = 'consultations:finish';
    protected $description = 'Update consultation status to "done" if past their ends_at time';

    public function handle()
    {
        // Ambil konsultasi dengan status 'on going' dan waktu berakhirnya (ends_at) telah lewat
        $ongoingConsultations = Konsultasi::where('status', 'on going')
            ->where('ends_at', '<', now())
            ->get();

        foreach ($ongoingConsultations as $consultation) {
            $consultation->update(['status' => 'done']);
        }

        // Informasi di terminal
        $this->info('Consultations past their ends_at time have been marked as "done".');
    }
}
