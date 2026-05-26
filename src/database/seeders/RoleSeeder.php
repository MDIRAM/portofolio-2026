<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = Role::firstOrCreate(['name' => 'super_admin']);
        Role::firstOrCreate(['name' => 'user']);

        $permissions = [
            'view_site::content',
            'view_any_site::content',
            'create_site::content',
            'update_site::content',
            'delete_site::content',
            'delete_any_site::content',
            'view_report',
            'view_any_report',
            'create_report',
            'update_report',
            'delete_report',
            'delete_any_report',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }

        $superAdmin->givePermissionTo($permissions);
    }
}
