<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /* Settings generales de la empresa */
        $settings = [
            [
                'key' => 'name',
                'value' => 'FUNDACION TRUJILLANA DE LA SALUD',
                'type' => 'string',
                'group' => 'general',
                'name' => 'Nombre de la Institución',
                'description' => 'Nombre de la institución que se mostrará en la interfaz',
            ],
            [
                'key' => 'razon_social',
                'value' => 'FUNDACION TRUJILLANA DE LA SALUD',
                'type' => 'string',
                'group' => 'general',
                'name' => 'Razón Social',
                'description' => 'Razón social de la institución',
            ],
            [
                'key' => 'rif',
                'value' => 'G-20008277-1',
                'type' => 'string',
                'group' => 'general',
                'name' => 'RIF',
                'description' => 'RIF de la institución',
            ],
            [
                'key' => 'direccion_fiscal',
                'value' => 'Av. Felipe Márquez Cañizález, Sector La Morita Edif. Fundasalud. Segundo Piso',
                'type' => 'string',
                'group' => 'general',
                'name' => 'Dirección Fiscal',
                'description' => 'Dirección fiscal de la institución',
            ],
            [
                'key' => 'description',
                'value' => 'Más que una institución...',
                'type' => 'string',
                'group' => 'general',
                'name' => 'Descripción',
                'description' => 'Descripción de la institución',
            ],
            [
                'key' => 'telefono',
                'value' => '0272-2365760',
                'type' => 'string',
                'group' => 'general',
                'name' => 'Teléfono',
                'description' => 'Teléfono de la institución',
            ],
            [
                'key' => 'director_talento_humano',
                'value' => 'LCDO. RAMÓN ALBERTO CALDERÓN FRANCO',
                'type' => 'string',
                'group' => 'general',
                'name' => 'Director de Talento Humano',
                'description' => 'Director de Talento Humano de la institución',
            ],
            [
                'key' => 'resolucion_director_talento_humano',
                'value' => 'Nº 0353 DE FECHA 29 DE MAYO DE 2023',
                'type' => 'string',
                'group' => 'general',
                'name' => 'Resolución de Director de Talento Humano',
                'description' => 'Resolución de Director de Talento Humano de la institución',
            ],
            [
                'key' => 'email',
                'value' => 'fundasalud@gmail.com',
                'type' => 'string',
                'group' => 'general',
                'name' => 'Email',
                'description' => 'Email de la institución',
            ],
            [
                'key' => 'website',
                'value' => 'https://www.fundasalud.com',
                'type' => 'string',
                'group' => 'general',
                'name' => 'Website',
                'description' => 'Website de la institución',
            ],
            [
                'key' => 'instagram',
                'value' => 'https://www.instagram.com/fundasalud/',
                'type' => 'string',
                'group' => 'general',
                'name' => 'Instagram',
                'description' => 'Instagram de la institución',
            ],
            [
                'key' => 'facebook',
                'value' => 'https://www.facebook.com/fundasalud/',
                'type' => 'string',
                'group' => 'general',
                'name' => 'Facebook',
                'description' => 'Facebook de la institución',
            ],
            [
                'key' => 'twitter',
                'value' => 'https://www.twitter.com/fundasalud/',
                'type' => 'string',
                'group' => 'general',
                'name' => 'Twitter',
                'description' => 'Twitter de la institución',
            ],

        ];

        foreach ($settings as $setting) {
            Setting::create($setting);
        }
    }
}