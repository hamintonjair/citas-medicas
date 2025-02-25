<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Office;

class OfficesTableSeeder extends Seeder
{
    public function run()
    {
        // Insertar datos manuales en la tabla offices
        Office::insert([
            ['name' => 'Consultorio 101', 'location' => 'Edificio A'],
            ['name' => 'Consultorio 102', 'location' => 'Edificio B'],
            ['name' => 'Consultorio 103', 'location' => 'Edificio C']
        ]);
    }
}