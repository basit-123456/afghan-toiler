<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class BackupPermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Create permissions
        $permissions = [
            'download-backup',
            'delete-backup',
            'create-backup',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Assign to a role (optional)
        $role = Role::firstOrCreate(['name' => 'backup']);
        $role->givePermissionTo($permissions);

        // Assign role to a user (optional)
        $user = \App\Models\User::find(1); // Change ID as needed
        
        if ($user && !$user->hasRole('backup')) {
            $user->assignRole('backup');
        }
    }
}