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

        // **Verifikator (User Table)**
        for ($i = 1; $i <= 5; $i++) {
            $verifikator = User::firstOrCreate([
                'email' => 'verifikator' . $i . '@gmail.com',
            ], [
                'name' => 'Verifikator PPDB ' . $i,
                'password' => Hash::make('@smantig#77bna'),
            ]);
            $verifikator->assignRole('verifikator');
        }

        // **Developer (User Table)**
        $admin = User::firstOrCreate([
            'email' => 'admin@example.com',
        ], [
            'name' => 'admin PPDB',
            'password' => Hash::make('password123'),
        ]);
        $admin->assignRole('admin');

        $this->command->info('Default users created successfully!');
    }
}

