<?php

namespace Database\Seeders;

use App\Models\Karyawan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class KaryawanSeeder extends Seeder
{
    public function run(): void
    {
        $namaKaryawan = [
            'Andi Pratama',
            'Budi Santoso',
            'Citra Lestari',
            'Dewi Anggraini',
            'Eko Saputra',
            'Fajar Nugroho',
            'Fitri Handayani',
            'Gilang Ramadhan',
            'Hana Puspita',
            'Indra Gunawan',
            'Joko Susilo',
            'Kartika Sari',
            'Lukman Hakim',
            'Maya Permata',
            'Nanda Putri',
            'Oki Setiawan',
            'Putri Maharani',
            'Rizky Firmansyah',
            'Siti Nurhaliza',
            'Tono Wijaya',
        ];

        foreach ($namaKaryawan as $nama) {
            $username = explode(' ', $nama, 2)[0];

            Karyawan::updateOrCreate(
                ['username' => $username],
                [
                    'nama' => $nama,
                    'password' => Hash::make('12345678'),
                    'golongan' => 'Staff',
                    'divisi' => 'Bag.Pengadaan & TI',
                ]
            );
        }
    }
}