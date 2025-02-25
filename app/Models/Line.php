<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;
class Line extends Model
{
    use HasFactory;
    protected $collection = 'lines';
    // Aquí puedes definir atributos y métodos específicos
    protected $fillable = ['name', 'descripcion'];

    public function appointments()
    {
        return $this->hasMany(Appointment::class); // Asegúrate de que Appointment sea el modelo correcto
    }
}