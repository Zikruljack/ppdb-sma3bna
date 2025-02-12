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

        // **Siswa PPDB (ppdb_user Table)**
        $user = User::firstOrCreate([
            'email' => 'siswa@example.com',
        ], [
            'name' => 'Siswa PPDB',
            'password' => Hash::make('password123'),
        ]);

        if ($user) {
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

