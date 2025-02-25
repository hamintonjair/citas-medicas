<?php

// app/Http/Controllers/AdminController.php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Office;
use App\Models\AuthorizationRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Line;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function vista_dashboard()
    {
        $appointments = Appointment::with('doctor', 'office', 'user')->get();

        $offices = Office::all();
        // $authorizationRequests = AuthorizationRequest::all();
        $users = User::all();
        $lines = Line::all();
        return view('admin.citas', compact(
            'appointments',
            'offices',
            'users',
            'lines'
        ));
    }
    public function adminValidar(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        //busca por el registro de correo
        $user = User::where('email', $request->input('email'))->first(); // Buscar el usuario por ID

        // Si el usuario existe validar contraseña y correo
        if ($user) {
            // Verificar la contraseña y correo son iguales
            if (Hash::check($request->input('password'), $user->password)) {
                // Iniciar sesión
                $user = User::findOrFail($user->id); // Buscar el usuario por ID
                session(['admin' => $user]);
                if($user->status == 'admin') {
                     return redirect()->route('administrador');
                }else{
                    return redirect()->route('login');
                }

            } else {
                return back()->withErrors(['password' => 'La contraseña no coincide.']);
            }
        } else {
            return back()->withErrors(['email' => 'El correo electrónico no existe.']);
        }
    }

    // vista login
    public function loginAdmin()
    {
        return view('admin.login');
    }
    // vista registro de usuaio de la plataforma
    // Método para mostrar la vista de registro
    public function showRegisterUsuario()
    {
        return view('admin.registroUsuario');
    }
    // regstrar usuario de la aplataforma
    public function RegisterAdmin(Request $request)
    {
        // Validar la entrada
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Verificar si el correo ya existe
        if (User::where('email', $request->email)->exists()) {
            return redirect()->back()->withErrors(['email' => 'El correo electrónico ya está registrado.'])->withInput();
        }

        // Crear un nuevo usuario
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'status' => 'admin',
        ]);

        // Almacenar en sesión y redirigir
        session(['admin' => $user]);
        return view('admin.login');
    }

    // registar los consultorios
    public function register_Office(Request $request)
    {
        Office::create($request->all());
        $offices = Office::all();
        return view('admin.consultorios',compact('offices'));
    }
    public function consultorio()
    {
        $offices = Office::all();
        return view('admin.consultorios', compact('offices'));
    }
    // eliminar consultorio
    public function deleteConsultorio($id)
    {
        // Buscar el médico por su ID
        $consultorio = Office::find($id);

        // Verificar si el médico existe
        if ($consultorio) {
            // Verificar si el médico tiene citas asociadas
            if ($consultorio->appointments()->count() > 0) {
                // Si el médico tiene citas asociadas, no permitir la eliminación
                return redirect()->route('ver_consultorio')->with('error', 'No se puede eliminar este consultorio porque tiene citas asociadas.');
            }

            // Si no tiene citas asociadas, eliminar el médico
            $consultorio->delete();

            // Redirigir al usuario con un mensaje de éxito
            return redirect()->route('ver_consultorio')->with('success', 'Consultorio eliminado exitosamente.');
        } else {
            // Si no se encuentra el médico, redirigir con un mensaje de error
            return redirect()->route('ver_consultorio')->with('error', 'Consultorio no encontrado.');
        }
    }

    // registrar las lineas
    public function register_line(Request $request)
    {
        Line::create($request->all());
        return redirect()->route('ver_linea');
    }
    // vista ñinea
    public function linea()
    {
        $lines = Line::all();
        return view('admin.lineas', compact('lines'));
    }
    // eliminar linea
    public function deleteLinea($id)
    {
        // Buscar el médico por su ID
        $linea = Line::find($id);

        // Verificar si el médico existe
        if ($linea) {

            $linea->delete();

            // Redirigir al usuario con un mensaje de éxito
            return redirect()->route('ver_linea')->with('success', 'Línea eliminado exitosamente.');
        } else {
            // Si no se encuentra el médico, redirigir con un mensaje de error
            return redirect()->route('ver_linea')->with('error', 'Línea no encontrado.');
        }
    }
    // para actualizar las citas agendadas
    public function appointment($id)
    {
        $request = Appointment::find($id);
        $request->status = 'agendado';
        $request->save();

        $appointments = Appointment::all();
        return view('admin.citas', compact('appointments'));
    }
    // editar linea
    public function editLine($id)
    {
        // Buscar la línea por su ID
        $line = Line::find($id);

        // Verificar si la línea existe
        if ($line) {
            // Cargar la vista de edición con los datos de la línea
            return view('admin.editLinea', compact('line'));
        } else {
            return redirect()->route('ver_linea')->with('error', 'Línea no encontrada.');
        }
    }
    // actualizar linea
    public function updateLinea(Request $request, $id)
    {
        // Validar los datos del formulario
        $request->validate([
            'name' => 'required|string|max:255',
            'descripcion' => 'required|string',
        ]);

        // Buscar la línea por su ID
        $line = Line::find($id);

        // Verificar si la línea existe
        if ($line) {
            // Actualizar los datos de la línea
            $line->name = $request->name;
            $line->descripcion = $request->descripcion;
            $line->save();

            // Redirigir con un mensaje de éxito
            return redirect()->route('ver_linea')->with('success', 'Línea actualizada exitosamente.');
        } else {
            return redirect()->route('ver_linea')->with('error', 'Línea no encontrada.');
        }
    }


    // registrar los medicos
    public function register_Doctor(Request $request)
    {
        Doctor::create($request->all());
        return redirect()->route('ver_doctor');
    }
    // vista medicos
    public function medicos()
    {
        $doctors = Doctor::all();
        return view('admin.medicos', compact('doctors'));
    }
    // eliminar medicos
    public function deleteMedico($id)
    {
        // Buscar el médico por su ID
        $medico = Doctor::find($id);

        // Verificar si el médico existe
        if ($medico) {
            // Verificar si el médico tiene citas asociadas
            if ($medico->appointments()->count() > 0) {
                // Si el médico tiene citas asociadas, no permitir la eliminación
                return redirect()->route('ver_doctor')->with('error', 'No se puede eliminar este médico porque tiene citas asociadas.');
            }

            // Si no tiene citas asociadas, eliminar el médico
            $medico->delete();

            // Redirigir al usuario con un mensaje de éxito
            return redirect()->route('ver_doctor')->with('success', 'Médico eliminado exitosamente.');
        } else {
            // Si no se encuentra el médico, redirigir con un mensaje de error
            return redirect()->route('ver_doctor')->with('error', 'Médico no encontrado.');
        }
    }
    // editar doctor
    public function editDoctor($id)
    {
        // Buscar la línea por su ID
        $doctor = Doctor::find($id);

        // Verificar si la línea existe
        if ($doctor) {
            // Cargar la vista de edición con los datos de la línea
            return view('admin.editDoctor', compact('doctor'));
        } else {
            return redirect()->route('ver_doctor')->with('error', 'doctor no encontrada.');
        }
    }
    // actualizar linea
    public function updateDoctor(Request $request, $id)
    {
        // Validar los datos del formulario
        $request->validate([
            'name' => 'required|string|max:255',
            'specialty' => 'required|string',
        ]);

        // Buscar la línea por su ID
        $doctor = Doctor::find($id);

        // Verificar si la línea existe
        if ($doctor) {
            // Actualizar los datos de la línea
            $doctor->name = $request->name;
            $doctor->specialty = $request->specialty;
            $doctor->save();

            // Redirigir con un mensaje de éxito
            return redirect()->route('ver_doctor')->with('success', 'Médico actualizada exitosamente.');
        } else {
            return redirect()->route('ver_doctor')->with('error', 'Médico no encontrada.');
        }
    }

    // autorizar las citas
    public function authorizeRequest($id)
    {
        $request = AuthorizationRequest::find($id);
        $request->status = 'autorizada';
        $request->save();

        return redirect()->route('admin.citas');
    }
    // listar las autorizaciones
    public function autorizacion()
    {
        $autorizacion = AuthorizationRequest::with('user')->get();
        return view('admin.authorization', compact('autorizacion'));
    }

    // * Descarga el archivo adjunto.

    public function download($id)
    {
        $authorization = AuthorizationRequest::findOrFail($id);

        // Verificar si el archivo existe
        if (!Storage::disk('public')->exists($authorization->file_path)) {
            return redirect()->back()->with('error', 'Archivo no encontrado.');
        }

        // Descargar el archivo
        return Storage::disk('public')->download($authorization->file_path);
    }


    /**
     * Actualiza el estado de la solicitud a "autorizado".
     */
    public function updateStatus(Request $request, $id)
    {
        $authorization = AuthorizationRequest::findOrFail($id);

        $authorization->update([
            'status' => 'autorizado'
        ]);

        return redirect()->back()->with('success', 'Autorización actualizada exitosamente.');
    }

    /**
     * Subir un nuevo documento.
     */
    public function uploadNewDocument(Request $request, $id)
    {
        // Buscar la autorización correspondiente
        $authorization = AuthorizationRequest::findOrFail($id);

        // Validar el nuevo archivo
        $request->validate([
            'new_file' => 'required|file|mimes:pdf,doc,docx,jpg,png|max:2048',
        ]);

        // Verificar si ya existe un archivo asociado y eliminarlo
        if ($authorization->file_path && Storage::disk('public')->exists($authorization->file_path)) {
            Storage::disk('public')->delete($authorization->file_path);
        }

        // Subir el nuevo archivo
        $newFilePath = $request->file('new_file')->store('authorizations', 'public');

        // Actualizar el registro con la nueva ruta del archivo
        $authorization->update(['file_path' => $newFilePath]);

        // Redirigir con mensaje de éxito
        return redirect()->back()->with('success', 'Documento actualizado exitosamente.');
    }

    public function logout()
    {
        // Eliminar la sesión del usuario
        session()->forget('user');
        // Opcional: Destruir toda la sesión
        session()->flush();
        // Redirigir a la página de inicio de sesión
        return redirect('dashboard');
    }
}
