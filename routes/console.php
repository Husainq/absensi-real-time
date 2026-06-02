<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule; // <-- WAJIB IMPORT INI

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
*/

// Command Bawaan Laravel
Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');


// ==========================================
// PENGATURAN JADWAL OTOMATIS (SCHEDULER)
// ==========================================

// 1. Jalankan generate jadwal kerja harian setiap hari jam 06:00 pagi (sebelum jam kantor)
Schedule::command('jadwal:generate')->dailyAt('06:00');

// 2. Jalankan reset cuti tahunan & panjang setiap hari di tengah malam (jam 00:00)
Schedule::command('cuti:reset')->daily();