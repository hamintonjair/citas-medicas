<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard de Citas Médicas</title>
    <!-- Vinculando los estilos de Bootstrap y DataTables -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

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
                        <a class="nav-link" href="{{route('ver_doctor')}}">Gestión Médicos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('ver_consultorio')}}">Gestión Consultorios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('ver_linea')}}">Gestión Líneas</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{route('logout_admin')}}">Cerrar sesión</a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>

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

        <hr>

        </section>
        <!-- Citas Pendientes -->
        <section id="citasPendientes">
            <h2>Solicitudes de Autorización</h2>
            <table id="citasPendientesTable" class="table table-striped">
                <thead class="bg-dark text-white">
                    <tr>
                        <th>ID</th>
                        <th>Nombre Usuario</th>
                        <th>Teléfono</th>
                        <th>Estado</th>
                        <th>Documento</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($autorizacion as $authorization)
                    <tr>
                        <td>{{ $authorization->id }}</td>
                        <td>{{ optional($authorization->user)->name }}</td>
                        <td>{{ $authorization->phone }}</td>
                        <td>{{ $authorization->status }}</td>
                        <td>
                            <a href="{{ route('authorization.download', $authorization->id) }}"
                                class="btn btn-info">Descargar</a>
                        </td>
                        <td>
                            @if($authorization->status == 'autorizado')
                            <button class="btn btn-warning" disabled>Autorizado</button>
                            <form action="{{ route('authorization.upload', $authorization->id) }}" method="POST"
                                enctype="multipart/form-data" class="mt-2">
                                @csrf
                                <input type="file" name="new_file" required>
                                <button type="submit" class="btn btn-secondary">Subir Nuevo</button>
                            </form>
                            @else
                            <form action="{{ route('authorization.updateStatus', $authorization->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success">Autorizar</button>
                            </form>
                            <form action="{{ route('authorization.upload', $authorization->id) }}" method="POST"
                                enctype="multipart/form-data" class="mt-2">
                                @csrf
                                <input type="file" name="new_file" required>
                                <button type="submit" class="btn btn-secondary">Subir Nuevo</button>
                            </form>
                            @endif
                        </td>

                    </tr>

                    @endforeach

                </tbody>
            </table>
        </section>


    </div>
    <style>
    html,
    body {
        height: 100%;
        margin: 0;
        display: flex;
        flex-direction: column;
    }

    .container {
        flex: 1;
    }

    footer {
        position: relative;
        bottom: 0;
        width: 100%;
        background-color: #343a40;
        color: white;
        text-align: center;
        padding: 15px 0;
    }
    </style>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-4">
        <p>&copy; 2024 Citas Médicas. Todos los derechos reservados.</p>
    </footer>

    <!-- Script para inicializar DataTables -->
    <script>
    $(document).ready(function() {
        var table = $('#citasPendientesTable').DataTable();

        // Filtro de búsqueda en la tabla de citas
        $('#citasPendientesTable').on('keyup', function() {
            table.search(this.value).draw();
        });
    });
    </script>

</body>

</html>