<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'Super Admin']);
        $admin = Role::create(['name' => 'admin']);
        $analista = Role::create(['name' => 'analista']);
        $user = Role::create(['name' => 'user']);

        $admin->givePermissionTo([
            'create-user',
            'edit-user',
            'delete-user',
            'create-product',
            'edit-product',
            'delete-product'
        ]);

        $analista->givePermissionTo([
            'create-product',
            'edit-product',
            'delete-product'
        ]);

        $user->givePermissionTo([
            'view-product'
        ]);
    }
}
