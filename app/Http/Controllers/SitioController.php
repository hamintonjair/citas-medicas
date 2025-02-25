<?php

namespace App\Http\Controllers;

use App\Models\Citas;
use Illuminate\Http\Request;
use App\Models\Line;


class SitioController extends Controller
{
    public function home()
    {
        return view('sitio.home');
    }

    public function showCliente()
    {
        $lines = Line::all();
       return view('sitio.atencion_cliente', compact('lines')); // Asegúrate de pasar la variable $user
    }
    // Guardar una nueva cita
}