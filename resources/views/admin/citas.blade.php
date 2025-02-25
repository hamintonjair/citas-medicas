<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard de Citas Médicas</title>

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
            <a class="navbar-brand" href="#">Dashboard, Bienvenido {{ session('admin')->name }}</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">

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

    <!-- Contenido principal -->
    <div class="container mt-5">

        <!-- Citas Pendientes -->
        <section id="citasPendientes">
            <h4>Citas Pendientes</h4>

            <!-- Barra de búsqueda -->
            <!-- <input type="text" id="searchAppointments" class="form-control mb-3" placeholder="Buscar Citas..."> -->
            <br>
            <!-- Tabla de citas con DataTables -->
            <table id="appointmentsTable" class="table table-striped">
                <thead class="bg-dark text-white">
                    <tr>
                        <th>Paciente</th>
                        <th>Médico</th>
                        <th>Consultorio</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($appointments as $appointment)
                    <tr>
                        <td>{{ $appointment->user->name }}</td>
                        <td>{{ $appointment->doctor->name }}</td>
                        <td>{{ $appointment->office->name }}</td>
                        <td>{{ $appointment->date }}</td>
                        <td>{{ $appointment->time }}</td>
                        <td> {{ $appointment->status }}</td>
                        <td>
                            @if($appointment->status == 'agendado')
                            <button class="btn btn-warning" disabled>Agendado</button>
                            @else
                            <a href="{{ route('autorize_cita', $appointment->id) }}" class="btn btn-success">Agendar</a>
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
        var table = $('#appointmentsTable').DataTable();

        // Filtro de búsqueda en la tabla de citas
        $('#searchAppointments').on('keyup', function() {
            table.search(this.value).draw();
        });
    });
    </script>

</body>

</html>