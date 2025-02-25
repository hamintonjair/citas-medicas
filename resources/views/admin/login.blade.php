<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard de Citas Médicas</title>
    <!-- Vinculando los estilos de Bootstrap y DataTables -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
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

        <div class="bg-image">
            <div class="container">
                <div class="row justify-content-center align-items-center vh-100">
                    <div class="col-md-6 col-lg-4">
                        <div class="card shadow-lg">
                            <div class="card-body">
                                <h2 class="text-center mb-4">Iniciar sesión</h2>

                                @if($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif

                                <form method="POST" action="{{ route('login_administrador') }}">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Correo electrónico</label>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="password" class="form-label">Contraseña</label>
                                        <input type="password" class="form-control" id="password" name="password"
                                            required>
                                    </div>

                                    <button type="submit" class="btn btn-primary w-100">Iniciar sesión</button>
                                </form>

                                <p class="mt-3 text-center">¿No tienes cuenta? <a
                                        href="{{ route('register_administrador') }}">Regístrar usuario</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="bg-dark text-white text-center py-4">
            <p>&copy; 2024 Citas Médicas. Todos los derechos reservados.</p>
        </footer>


    </body>



</html>