<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DefaultUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Creating Super Admin User
        $superAdmin = User::create([
            'name' => 'Silvio Ramírez', 
            'email' => 'silvio.ramirez.m@gmail.com',
            'password' => Hash::make('secret')
        ]);
        $superAdmin->assignRole('Super Admin');

        // Creating Admin User
        $admin = User::create([
            'name' => 'Admin', 
            'email' => 'admin@admin.com',
            'password' => Hash::make('secret')
        ]);
        $admin->assignRole('admin');

        // Creating Product Manager User
        $analista = User::create([
            'name' => 'Analista', 
            'email' => 'analista@analista.com',
            'password' => Hash::make('secret')
        ]);
        $analista->assignRole('analista');

        // Creating Application User
        $user = User::create([
            'name' => 'usuario', 
            'email' => 'usuario@usuario.com',
            'password' => Hash::make('secret')
        ]);
        $user->assignRole('user');
    }
}
