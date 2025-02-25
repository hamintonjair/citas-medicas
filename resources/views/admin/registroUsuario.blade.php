<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard de Citas Médicas</title>
    <!-- Vinculando los estilos de Bootstrap y DataTables -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
</head>
</head>
<style>
.bg-container {
    background-size: cover;
    background-position: center;
    height: 100vh;
}
</style>

<body>

    <!-- Header -->
    <header class="bg-dark text-white text-center py-3">
        <h1>Dashboard de Gestión de Citas Médicas</h1>
        <p>Gestiona citas, médicos, consultorios y líneas de atención</p>
    </header>

    <body class="bg-container" style="background-image: url(img/fondo.jpg); ">
        <!-- Contenido principal -->
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow-lg mt-5">
                        <div class="card-body">
                            <h2 class="text-center mb-4">Crear cuenta admin</h2>

                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif

                            <form method="POST" action="{{ route('register_Usuario') }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nombre</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Correo electrónico</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Contraseña</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>

                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label">Confirmar contraseña</label>
                                    <input type="password" class="form-control" id="password_confirmation"
                                        name="password_confirmation" required>
                                </div>

                                <button type="submit" class="btn btn-success w-100">Registrarse</button>
                            </form>

                            <p class="mt-3 text-center">¿Ya tienes cuenta? <a href="{{ route('dashboard') }}">Inicia
                                    sesión</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br><br>

        <!-- Footer -->
        <footer class="bg-dark text-white text-center py-4">
            <p>&copy; 2024 Citas Médicas. Todos los derechos reservados.</p>
        </footer>

        <!-- Script para inicializar DataTables -->


    </body>



</html>
