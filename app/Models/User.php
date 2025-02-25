<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;
class User extends Model
{
    use HasFactory;
    protected $collection = 'users';
    // Aquí puedes definir atributos y métodos específicos
    protected $fillable = ['name', 'email', 'password', 'status'];
}
