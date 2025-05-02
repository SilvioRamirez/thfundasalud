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
            'delete-activitylog',
            'view-trabajador',
            'create-trabajador',
            'edit-trabajador',
            'delete-trabajador',
            'view-primeraquincena',
            'create-primeraquincena',
            'edit-primeraquincena',
            'delete-primeraquincena',
            'view-segundaquincena',
            'create-segundaquincena',
            'edit-segundaquincena',
            'delete-segundaquincena',
            'view-ubicacion_fisica',
            'create-ubicacion_fisica',
            'edit-ubicacion_fisica',
            'delete-ubicacion_fisica',
            'view-participacion',
            'create-participacion',
            'edit-participacion',
            'delete-participacion',
            'view-eleccion',
            'create-eleccion',
            'edit-eleccion',
            'delete-eleccion'
        ];

        // Looping and Inserting Array's Permissions into Permission Table
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
