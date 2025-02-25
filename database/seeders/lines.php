<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
Use App\Models\Line;

class lines extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Line::insert([
            ['name' => '+57 314897534', 'descripcion' => 'Para consultas generales'],
            ['name' => '+57 310 7984632', 'descripcion' => 'Para soporte tecnico'],
            ['name' => '+57 311 4782309', 'descripcion' => 'Para consultar sobre autorizaciones']
        ]);
    }
}