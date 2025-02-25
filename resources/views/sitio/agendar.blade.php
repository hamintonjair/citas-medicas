<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atención al Cliente</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand">Citas Médicas</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link text-white"
                            href="{{ route('user.profile', ['id' => session('user')->id]) }}">Home</a>
                    </li>
                    @if(session('user'))
                    <li class="nav-item">
                        <a class="nav-link text-white"
                            href="{{ route('user.profile') }}{{ session('user')->name }}">Hola,
                            {{ session('user')->name }}</a>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-link nav-link text-white">Cerrar sesión</button>
                        </form>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('login') }}">Iniciar sesión</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('register') }}">Registrarse</a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenido principal en dos columnas -->
    <div class="container my-5">

        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif

        <div class="row">
            <!-- Columna de Cita Médica -->
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h4 class="card-title text-center mb-4">Agenda una Cita Médica</h4>
                        <form action="{{ route('appointments.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="doctor_id" class="form-label">Selecciona un médico:</label>
                                <select name="doctor_id" id="doctor_id" class="form-control">
                                    @foreach ($doctors as $doctor)
                                    <option value="{{ $doctor->id }}">{{ $doctor->name }} - {{ $doctor->specialty }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="office_id" class="form-label">Selecciona un consultorio:</label>
                                <select name="office_id" id="office_id" class="form-control">
                                    @foreach ($offices as $office)
                                    <option value="{{ $office->id }}">{{ $office->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="date" class="form-label">Fecha de la cita:</label>
                                <input type="date" name="date" id="date" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="time" class="form-label">Hora de la cita:</label>
                                <input type="time" name="time" id="time" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Agendar Cita</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Columna de Autorización -->
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h4 class="card-title text-center mb-4">Autorización</h4>
                        <form action="{{ route('authorization.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Nombre:</label>
                                <input type="text" name="name" id="name" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Teléfono:</label>
                                <input type="tel" name="phone" id="phone" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="file" class="form-label">Subir archivo:</label>
                                <input type="file" name="file" id="file" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-success w-100">Enviar Autorización</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center p-3">
        <p>&copy; 2024 Citas Médicas. Todos los derechos reservados.</p>
    </footer>

    <!-- jQuery y Bootstrap JS -->
    <link rel="stylesheet" href="{{ asset('js/bootstrap.bundle.min.js') }}">

</body>

</html>