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
            <a class="navbar-brand" href="/">Citas Médicas</a>
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



    <div class="container text-center my-5">
        <h2>Editar Perfil</h2>

        <!-- Mensaje de éxito -->
        @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="row">

            <div class="container d-flex justify-content-center align-items-center my-5">
                <div class="card shadow-sm" style="max-width: 500px; width: 100%;">
                    <div class="card-body">
                        <form action="{{ route('profile.update') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Nombre</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    value="{{ old('name', $user->name) }}" required>
                                @error('name') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Correo Electrónico</label>
                                <input type="email" name="email" id="email" class="form-control"
                                    value="{{ old('email', $user->email) }}" required>
                                @error('email') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Contraseña</label>
                                <input type="password" name="password" id="password" class="form-control">
                                <small class="form-text text-muted">Deje en blanco si no desea cambiarla.</small>
                                @error('password') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="form-control">
                                @error('password_confirmation') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Actualizar Perfil</button>
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
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

</body>

</html>