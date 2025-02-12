<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // Reset Cache Permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // List Permission
        $permissions = [
            'manage_news',
            'manage_gallery',
            'manage_ppdb',
            'manage_announcements',
            'manage_achievements',
            'manage_events',
            'manage_settings',
            'view_logs',
            'manage_users',
            'manage_roles',
            'peserta_ppdb'
        ];

        // Buat Permissions
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

         $siswa = Role::firstOrCreate(['name' => 'siswa']);
        $verifikator = Role::firstOrCreate(['name' => 'verifikator']);
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $developer = Role::firstOrCreate(['name' => 'developer']);

        // Assign Permissions ke Roles
        $siswa->givePermissionTo(['peserta_ppdb']);
        $verifikator->givePermissionTo(['manage_ppdb']);
        $admin->givePermissionTo([
            'manage_news', 'manage_gallery', 'manage_ppdb',
            'manage_announcements', 'manage_achievements', 'manage_events',
            'manage_settings', 'view_logs', 'manage_users', 'manage_roles'
        ]);
        $developer->givePermissionTo(Permission::all());

    }
}
