<?php



namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Doctor;

class DoctorsTableSeeder extends Seeder
{
    public function run()
    {
        // Insertar datos manuales en la tabla doctors
        Doctor::insert([
            [
                'name' => 'Dr. Juan Pérez',
                'specialty' => 'Cardiología',
                'phone' => '1234567890',
                'email' => 'juan.perez@example.com'
            ],
            [
                'name' => 'Dra. María González',
                'specialty' => 'Pediatría',
                'phone' => '0987654321',
                'email' => 'maria.gonzalez@example.com'
            ],
            [
                'name' => 'Dr. Carlos Ramírez',
                'specialty' => 'Dermatología',
                'phone' => '1122334455',
                'email' => 'carlos.ramirez@example.com'
            ]
        ]);
    }
}