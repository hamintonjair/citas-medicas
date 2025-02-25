<?php

// app/Models/Doctor.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;


class Doctor extends Model
{
    use HasFactory;
    protected $collection = 'doctors';

    protected $fillable = ['name', 'specialty'];

    // En el modelo Doctor
    public function appointments()
    {
        return $this->hasMany(Appointment::class); // Asegúrate de que Appointment sea el modelo correcto
    }
}