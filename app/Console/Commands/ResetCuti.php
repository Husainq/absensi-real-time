<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Cuti;
use Carbon\Carbon;

class ResetCuti extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cuti:reset';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mereset jatah cuti dan memperpanjang masa expired (Tahunan +1 Tahun, Panjang +5 Tahun)';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        // Ambil semua data jatah cuti karyawan
        $cuti = Cuti::all();
        $sekarang = Carbon::now();

        foreach ($cuti as $data) {
            $adaPerubahan = false;

            // 1. Cek Cuti Tahunan (Setiap 1 Tahun Sekali)
            if ($data->expiredTahun && Carbon::parse($data->expiredTahun)->isPast()) {
                $data->cutiTahun = 12; // Isi ulang jatah tahunan ke default
                
                // Perpanjang tanggal expired: Tambah 1 tahun dari tanggal expired sebelumnya
                $data->expiredTahun = Carbon::parse($data->expiredTahun)->addYear(); 
                $adaPerubahan = true;
            }

            // 2. Cek Cuti Panjang (Setiap 5 Tahun Sekali)
            if ($data->expiredPanjang && Carbon::parse($data->expiredPanjang)->isPast()) {
                $data->cutiPanjang = 60; // Isi ulang jatah cuti panjang ke default
                
                // Perpanjang tanggal expired: Tambah 5 tahun dari tanggal expired sebelumnya
                $data->expiredPanjang = Carbon::parse($data->expiredPanjang)->addYears(5); 
                $adaPerubahan = true;
            }

            // Simpan ke database Supabase jika ada jatah yang mencapai hari H expired
            if ($adaPerubahan) {
                $data->save();
            }
        }

        $this->info('✅ Pengecekan selesai. Jatah cuti yang expired berhasil di-reset dan diperpanjang periodenya.');
    }
}