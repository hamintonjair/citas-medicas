<?php

// app/Models/AuthorizationRequest.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;


class AuthorizationRequest extends Model
{
    use HasFactory;
    protected $collection = 'authorization_requests';

    protected $fillable = ['user_id', 'phone', 'file_path', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}