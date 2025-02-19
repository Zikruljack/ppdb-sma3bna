<?php

namespace App\Helpers;

if(!function_exists('hitungRataRataPerSemester')){
    function hitungRataRataPerSemester($arrNilai){
        $rataRataPerSemester = [];

        foreach ($nilaiRapor as $semester => $nilaiMapel) {
            // Ambil semua nilai untuk semester tertentu
            $totalNilai = 0;
            $jumlahMapel = count($nilaiMapel);

            foreach ($nilaiMapel as $nilai) {
                $totalNilai += $nilai->nilai; // Penjumlahan nilai untuk semester ini
            }

            // Hitung rata-rata untuk semester ini
            $rataRataPerSemester[$semester] = $jumlahMapel > 0 ? $totalNilai / $jumlahMapel : 0;
        }

        return $rataRataPerSemester;
    }
}
