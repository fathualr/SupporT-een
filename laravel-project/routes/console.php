<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Console\Scheduling\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

// Jadwalkan command di routes/console.php
app()->singleton(Schedule::class, function () {
    $schedule = new Schedule;

    $schedule->command('transactions:expire')->everyMinute();
    $schedule->command('consultations:finish')->everyMinute();
    $schedule->command('activities:record')->dailyAt('23:01');

    return $schedule;
});