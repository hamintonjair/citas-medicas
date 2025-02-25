<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index');
    }

    public function store(Request $request)
    {
        Appointment::create([
            'user_id' => auth()->id(),
            'doctor' => $request->doctor,
            'date' => $request->date,
            'time' => $request->time,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Cita agendada exitosamente');
    }
}