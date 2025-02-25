<?php
// app/Http/Controllers/AuthController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{


    // Método para mostrar la vista de login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Método para mostrar la vista de registro
    public function showRegister()
    {
        return view('auth.register');
    }

    // Método para manejar el login
    public function login(Request $request)
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
                session(['user' => $user]);
                return redirect()->route('user.profile');
            } else {
                return back()->withErrors(['password' => 'La contraseña no coincide.']);
            }
        } else {
            return back()->withErrors(['email' => 'El correo electrónico no existe.']);
        }
    }

    // Método para manejar el registro
    public function register(Request $request)
    {
        // Validación de entrada
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            // el password debe de ser minimo de 6 caracteres o digitos
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
            'status' => 'usuario',
            // Cifrar la contraseña
        ]);

        //
        $user = User::findOrFail($user->id); // Buscar el usuario por ID
        session(['user' => $user]);
        // Pasar el usuario a la vista
        return view('user.profile');
    }


    // Método para mostrar el perfil del usuario
    public function showProfile()
    {
        return view('user.profile');
    }
    // editar perfil
    public function ShowMiPerfil()
    {
        // Obtener el usuario logueado
        $id = session('user')->_id;
        $user = User::findOrFail($id); // Buscar el usuario por ID
        return view('user.editar', compact('user'));
    }
    // Actualizar perfil
    public function update(Request $request)
    {
        $id = session('user')->_id;
        // Validación de los campos
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|confirmed|min:6',
        ]);

        // Obtener el usuario logueado
        $user = User::findOrFail($id);
        // Actualizar los campos
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];

        // Si se proporciona una nueva contraseña, actualizarla
        if ($request->filled('password')) {
            $user->password = Hash::make($validatedData['password']);
        }

        // Guardar los cambios
        $user->save();
        session(['user' => $user]);
        // Redirigir con mensaje de éxito
        return redirect()->route('Miperfil')->with('success', 'Perfil actualizado correctamente.');
    }
    // Método para cerrar sesión
    public function logout()
    {
        // Eliminar la sesión del usuario
        session()->forget('user');
        // Opcional: Destruir toda la sesión
        session()->flush();
        // Redirigir a la página de inicio de sesión
        return redirect('home');
    }
}