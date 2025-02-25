<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
use App\Http\Controllers\SitioController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AdminController;

// vista principal sitio
Route::get('/home', [SitioController::class, 'home'])->name('home');

// USUARIO
// vista login
Route::get('login', [AuthController::class, 'showLogin'])->name('login');
// iniciar sesion
Route::post('login', [AuthController::class, 'login']);
// registro de nuevo usuario
Route::get('register', [AuthController::class, 'showRegister'])->name('register');
// vista de usuario
Route::post('register', [AuthController::class, 'register']);
// vista no  perfil
Route::get('profile', [AuthController::class, 'showProfile'])->name('user.profile');
// Route::get('/user/profile/{id}', [UserController::class, 'profile'])->name('user.profile');
// cerrer sesion
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// atencion al cliente
route::get('atencion-al-cliente', [SitioController::class, 'showCliente'])->name('atencion-al-cliente');

// ADMINISTRACION
// vista login
Route::get('dashboard', [AdminController::class, 'loginAdmin'])->name('dashboard');
// vistar registro administrador
Route::get('register_administrador', [AdminController::class, 'showRegisterUsuario'])->name('register_administrador');
// registrarndo administador
Route::post('register_Usuario', [AdminController::class, 'RegisterAdmin'])->name('register_Usuario');
// vista dashboard del administrador
Route::get('administrador',[AdminController::class, 'vista_dashboard'])->name('administrador');
// validar inicio de sesion
route::post('login_administrador',[AdminController::class, 'adminValidar'])->name('login_administrador');
// cerrer sesion
Route::get('logout_admin', [AdminController::class, 'logout'])->name('logout_admin');
// dashboard
Route::get('dashboard-administracion', [AdminController::class, 'dashboard'])->name('dashboard-administracion');
// autorizar las ordenes medicas
Route::get('authorize/{id}', [AdminController::class, 'authorizeRequest'])->name('authorize');
// autorizar las  citas
Route::get('autorize_cita/{id}', [AdminController::class, 'appointment'])->name('autorize_cita');


// registrar los medicos
Route::post('doctor', [AdminController::class, 'register_Doctor'])->name('doctor');
Route::get('ver_doctor', [AdminController::class, 'medicos'])->name('ver_doctor');
Route::get('delete_doctor/{id}', [AdminController::class, 'deleteMedico'])->name('delete_doctor');
Route::get('/doctor/edit/{id}', [AdminController::class, 'editDoctor'])->name('edit_doctor');
Route::post('/doctor/update/{id}', [AdminController::class, 'updateDoctor'])->name('update_doctor');


// registrar los consultorios
Route::post('offices', [AdminController::class, 'register_Office'])->name('offices');
Route::get('ver_consultorio', [AdminController::class, 'consultorio'])->name('ver_consultorio');
Route::get('delete_consultorio/{id}', [AdminController::class, 'deleteConsultorio'])->name('delete_consultorio');

// registrar las medicinas
Route::post('medicines', [AdminController::class, 'storeMedicine'])->name('medicines');
// regustrar las lineas
Route::post('lineas_atencion', [AdminController::class, 'register_line'])->name('lineas_atencion');
Route::get('ver_linea', [AdminController::class, 'linea'])->name('ver_linea');
Route::get('delete_linea/{id}', [AdminController::class, 'deleteLinea'])->name('delete_linea');
Route::get('/lineas/edit/{id}', [AdminController::class, 'editLine'])->name('edit_linea');
Route::post('/lineas/update/{id}', [AdminController::class, 'updateLinea'])->name('update_linea');

// autorizaciones


Route::get('/authorization/download/{id}', [AdminController::class, 'download'])->name('authorization.download');
Route::post('/authorization/update-status/{id}', [AdminController::class, 'updateStatus'])->name('authorization.updateStatus');
Route::post('/authorization/upload/{id}', [AdminController::class, 'uploadNewDocument'])->name('authorization.upload');
Route::get('ver_autorizacion', [AdminController::class, 'autorizacion'])->name('ver_autorizacion');



//vista agenda
Route::get('/agendar', [AppointmentController::class, 'agenda'])->name('agendar');
// listar citasmedicas
Route::get('/citas_medicas', [AppointmentController::class, 'citas_agendadas'])->name('citas_medicas');
// autorizaciones agendadas
Route::get('/Autorizacion', [AppointmentController::class, 'Autorizacion_agendadas'])->name('Autorizacion');

Route::get('Miperfil', [AuthController::class, 'ShowMiPerfil'])->name('Miperfil');
Route::post('perfil/actualizar', [AuthController::class, 'update'])->name('profile.update');

// agendar las citas medicas
Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');
// agendar autorizacion
Route::post('/authorization/store', [AppointmentController::class, 'storeAuthorization'])->name('authorization.store');
