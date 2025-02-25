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

<body>

    <!-- Header -->
    <header class="bg-dark text-white text-center py-3">
        <h1>Dashboard de Gestión de Citas Médicas</h1>
        <p>Gestiona citas, médicos, consultorios y líneas de atención</p>
    </header>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Citas Médicas</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">


                    <li class="nav-item">
                        <a class="nav-link active" href="{{route('administrador')}}">Citas Pendientes</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{route('ver_consultorio')}}">Gestión Consultorios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('ver_linea')}}">Gestión Líneas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('ver_autorizacion')}}">Autorizaciones</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('logout_admin')}}">Cerrar sesión</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenido principal -->
    <div class="container text-center my-5">
        <!-- Mostrar mensajes de éxito o error -->

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


        <!-- Gestión de Médicos -->
        <div class=" container d-flex justify-content-center align-items-center my-5">
            <div class="card shadow-sm" style="max-width: 500px; width: 100%;">
                <div class="card-body">
                    <h4>Nuevo Médico</h4>
                    <form action="{{ route('doctor') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Nombre del Médico</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="form-group mt-3">
                            <label for="specialty">Especialidad</label>
                            <input type="text" class="form-control" name="specialty" required>
                        </div>
                        <button type="submit" class="btn btn-success mt-3">Registrar Médico</button>
                    </form>
                </div>
            </div>
        </div>
        <hr>

        </section>
        <!-- Citas Pendientes -->
        <section id="citasPendientes">
            <h4>Gestion de Médicos</h4>
            <!-- Barra de búsqueda -->
            <br>
            <!-- Tabla de citas con DataTables -->
            <table id="doctorsTable" class="table table-striped">
                <thead class="bg-dark text-white">
                    <tr>

                        <th>Nombre</th>
                        <th>Especialización</th>
                        <th>Accion</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($doctors as $doctor)
                    <tr>
                        <td>{{ $doctor->name }}</td>
                        <td>{{ $doctor->specialty }}</td>

                        <td>
                            <a href="{{ route('delete_doctor', $doctor->id) }}" class="btn btn-danger">Eliminar</a>
                            <!-- Botón para editar la línea -->
                            <a href="{{ route('edit_doctor', $doctor->id) }}" class="btn btn-warning">Editar</a>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </section>


    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-4">
        <p>&copy; 2024 Citas Médicas. Todos los derechos reservados.</p>
    </footer>

    <!-- Script para inicializar DataTables -->
    <script>
    $(document).ready(function() {
        var table = $('#doctorsTable').DataTable();

        // Filtro de búsqueda en la tabla de citas
        $('#searchdoctors').on('keyup', function() {
            table.search(this.value).draw();
        });
    });
    </script>

</body>


</html>
