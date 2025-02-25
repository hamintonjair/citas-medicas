<?php

// app/Http/Controllers/AppointmentController.php
namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Office;
use Illuminate\Http\Request;
use App\Models\AuthorizationRequest;

class AppointmentController extends Controller
{
    // Mostrar formulario para crear cita médica
    public function agenda()
    {
        $doctors = Doctor::all();
        $offices = Office::all();

        return view('sitio.agendar', compact('doctors', 'offices'));
    }

    // Almacenar la cita médica en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'office_id' => 'required|exists:offices,id',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
        ]);
        $id = session('user')->_id;
        // Crear la cita
        $appointment = new Appointment();
        $appointment->user_id = $id; // Asumimos que el usuario está autenticado
        $appointment->doctor_id = $request->doctor_id;
        $appointment->office_id = $request->office_id;
        $appointment->date = $request->date;
        $appointment->time = $request->time;
        $appointment->status = 'pendiente'; // Estado inicial
        $appointment->save();

        // Redirigir con mensaje de éxito
        return redirect()->route('citas_medicas')->with('success', 'Cita agendada con éxito');
    }
    // istar citas
    public function citas_agendadas()
    {
        $appointments = Appointment::all();
        return view('sitio.citas_medicas', compact('appointments'));
    }

    // / registrar autorizacion
    public function storeAuthorization(Request $request)
    { {
            // Validación de los campos
            $request->validate([
                'name' => 'required|string|max:255',
                'phone' => 'required|string|max:20',
                'file' => 'required|file|mimes:pdf,doc,docx,jpg,png|max:2048'
            ]);

            // Subir el archivo
            $filePath = $request->file('file')->store('authorizations', 'public');
            $id = session('user')->_id;

            // Crear la solicitud de autorización
            AuthorizationRequest::create([
                'user_id' => $id,
                'name' => $request->name,
                'phone' => $request->phone,
                'file_path' => $filePath,
                'status' => 'pendiente'
            ]);

            return redirect()->back()->with('success', 'Solicitud de autorización enviada exitosamente.');
        }
    }

// listar autorizaciones al usuario
    public function Autorizacion_agendadas()
    {
        // Obtener el ID del usuario autenticado
        $userId = session('user')->_id;

            // Obtener todas las autorizaciones del usuario
        $authorizations = AuthorizationRequest::where('user_id', $userId)->get();

        // Pasar los datos a una vista
        return view('sitio.autorizaciones', compact('authorizations'));
    }
}
