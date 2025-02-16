<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\PpdbSettings;

class PpdbSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $jalur_pendaftaran = [
            [
                'year' => 2025,
                'jalur_pendaftaran' => 'Jalur Prestasi',
                'mulai_pendaftaran' => '2025-02-17',
                'akhir_pendaftaran' => '2025-02-21',
                'tanggal_pengumuman' => '2025-02-25',
                'kuota' => 100,
                'status' => true,
                'waktu_pembukaan_ppdb' => '07:00:00',
                'waktu_tutup_ppdb' => '23:59:00',
            ],
            [
                'year' => 2025,
                'jalur_pendaftaran' => 'Jalur Kepemimpinan',
                'mulai_pendaftaran' => '2025-02-17',
                'akhir_pendaftaran' => '2025-02-21',
                'tanggal_pengumuman' => '2025-02-25',
                'kuota' => 100,
                'status' => true,
                'waktu_pembukaan_ppdb' => '07:00:00',
                'waktu_tutup_ppdb' => '23:59:00',
            ]
        ];

        foreach ($jalur_pendaftaran as $jalur) {
            PpdbSettings::create($jalur);
        }

    }
}
