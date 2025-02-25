<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'create-role',
            'edit-role',
            'delete-role',
            'view-role',
            'create-user',
            'edit-user',
            'delete-user',
            'view-user',
            'view-product',
            'create-product',
            'edit-product',
            'delete-product',
            'view-activitylog',
            'create-activitylog',
            'edit-activitylog',
            'delete-activitylog'
        ];

        // Looping and Inserting Array's Permissions into Permission Table
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
