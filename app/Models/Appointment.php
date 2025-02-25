<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

// agendar citas medicas
class Appointment extends Model
{
    use HasFactory;

    // Nombre de la colección en MongoDB
    protected $collection = 'appointments';

    // Campos que pueden ser asignados masivamente
    protected $fillable = [
        'user_id',
        'doctor_id',
        'office_id',
        'date',
        'time',
        'status'
    ];

    // Relación con Doctor
    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id', '_id');
    }

    // Relación con Office
    public function office()
    {
        return $this->belongsTo(Office::class, 'office_id', '_id');
    }

    // Relación con User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', '_id');
    }

}