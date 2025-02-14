<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User; // Untuk Admin
use App\Models\PpdbUser; // Untuk Siswa
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    public function run()
    {


        // **Admin (User Table) - Sudah Ada di Role Pertama**
        $developer = User::firstOrCreate(
            [
                'email' => 'obgjck21@gmail.com',
            ],[
                'name' => 'Developer PPDB',
                'password' => Hash::make('123123'),
                ]
        );
        if ($developer) {
            $developer->assignRole('developer');
        }

        // **Siswa PPDB (user Table)**
        $user = User::firstOrCreate(
            [
                'email' => 'siswa@example.com',
            ],
            [
                'name' => 'Siswa PPDB',
                'password' => Hash::make('password123'),
            ]
        );

        if ($user->wasRecentlyCreated) {
            // biodata siswa
            $ppdbUser = PpdbUser::firstOrCreate(
                [
                    'user_id' => $user->id,
                ],
                [
                    'user_id' => $user->id,
                    'nama_lengkap' => 'Siswa PPDB',
                    'nisn' => '1234567890',
                    'nik' => '1234567890123456',
                    'no_kk' => '1234567890123456',
                    'foto' => 'default.png',
                    'tanggal_kk_dikeluarkan' => now(),
                    'tempat_lahir' => 'Jakarta',
                    'tanggal_lahir' => now(),
                    'jenis_kelamin' => 'Laki-laki',
                    'agama' => 'Islam',
                    'alamat' => 'Jl. ABC No. 123',
                    'gol_darah' => 'O',
                    'tinggi_badan' => 170,
                    'berat_badan' => 50,
                    'kecamatan' => 'Jakarta Selatan',
                    'kabupaten_kota' => 'Jakarta',
                    'provinsi' => 'DKI Jakarta',
                    'kode_pos' => '12345',
                    'tempat_tinggal' => 'Orang Tua',
                    'jalur_pendaftaran' => 'Zonasi',
                    'kriteria_domisili' => 'Zonasi',
                    'no_hp' => '081234567890',
                    'asal_sekolah' => 'SDN 01 Jakarta',
                    'npsn_asal_sekolah' => '12345678',
                    'kabkota_asal_sekolah' => 'Jakarta',
                    'nama_ayah' => 'Ayah Siswa',
                    'nama_ibu' => 'Ibu Siswa',
                    'pekerjaan_ayah' => 'Pegawai Negeri',
                    'pekerjaan_ibu' => 'Ibu Rumah Tangga',
                    'jabatan_ayah' => 'Gol III',
                    'jabatan_ibu' => '-',
                    'alamat_ortu' => 'Jl. ABC No. 123',
                    'no_hp_ayah' => '081234567890',
                    'no_hp_ibu' => '081234567890',
                ]
            );

            $user->assignRole('siswa');
        }


        // **Verifikator (User Table)**
        $verifikator = User::firstOrCreate([
            'email' => 'verifikator@example.com',
        ], [
            'name' => 'Verifikator PPDB',
            'password' => Hash::make('password123'),
        ]);
        $verifikator->assignRole('verifikator');

        // **Developer (User Table)**
        $admin = User::firstOrCreate([
            'email' => 'developer@example.com',
        ], [
            'name' => 'admin PPDB',
            'password' => Hash::make('password123'),
        ]);
        $admin->assignRole('admin');

        $this->command->info('Default users created successfully!');
    }
}

