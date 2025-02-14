<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Mapel;

class MapelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mapels = [
            ['mapel' => 'PAI'],
            ['mapel' => 'Bahasa Inggris'],
            ['mapel' => 'Bahasa Indonesia'],
            ['mapel' => 'Matematika'],
            ['mapel' => 'IPA'],
            ['mapel' => 'IPS'],
        ];

        foreach ($mapels as $mapel) {
            Mapel::create($mapel);
        }
    }
}
