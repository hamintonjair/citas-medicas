<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard de Citas Médicas</title>
    <!-- Vinculando los estilos de Bootstrap y DataTables -->

</head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

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
                        <a class="nav-link" href="{{route('ver_doctor')}}">Gestión Médicos</a>
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

    <div class="container text-center my-5">

        <div class=" container d-flex justify-content-center align-items-center my-5">
            <div class="card shadow-sm" style="max-width: 500px; width: 100%;">
                <div class="card-body">
                    <h2>Editar Línea de Atención</h2>
                    <form action="{{ route('update_linea', $line->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Nombre de la Línea</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $line->name }}"
                                required>
                        </div>
                        <div class="form-group mt-3">
                            <label for="descripcion">Descripción</label>
                            <textarea class="form-control" id="descripcion" name="descripcion"
                                required>{{ $line->descripcion }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-success mt-3">Actualizar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>

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