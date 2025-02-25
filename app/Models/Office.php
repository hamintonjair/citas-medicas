<?php

// app/Models/Office.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;


class Office extends Model
{
    use HasFactory;
    protected $collection = 'offices';
    protected $fillable = ['name'];


    public function appointments()
    {
        return $this->hasMany(Appointment::class); // Asegúrate de que Appointment sea el modelo correcto
    }
}
