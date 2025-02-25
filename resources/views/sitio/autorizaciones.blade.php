<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atención al Cliente</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">


    <style>
    /* Hacer que el footer sea fijo */
    body {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    .content {
        flex: 1;
    }

    footer {
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
    }
    </style>


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

    <!-- Contenido principal -->
    <div class="container text-center my-5 content">
        <!-- Tabla de Citas -->
        <div class="mt-5">
            <h2>Solicitudes de Autorización</h2>
            <table id="citasPendientesTable" class="table table-striped">
                <thead class="bg-dark text-white">
                    <tr>
                        <th>ID</th>
                        <th>Nombre Usuario</th>
                        <th>Teléfono</th>
                        <th>Estado</th>
                        <th>Documento</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($authorizations as $authorization)
                    <tr>
                        <td>{{ $authorization->id }}</td>
                        <td>{{ $authorization->user->name }}</td>
                        <td>{{ $authorization->phone }}</td>
                        <td>{{ $authorization->status }}</td>
                        <td>


                            @if($authorization->status == 'pendiente')
                            <button class="btn btn-warning" disabled>Descargar</button>

                            @else
                            <a href="{{ route('authorization.download', $authorization->id) }}"
                                class="btn btn-info">Descargar</a>
                            @endif
                        </td>


                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Footer fijo -->
    <footer class="bg-dark text-white text-center p-3">
        <p>&copy; 2024 Citas Médicas. Todos los derechos reservados.</p>
    </footer>

    <!-- jQuery -->
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>


    <!-- Inicializar DataTable -->
    <script>
    $(document).ready(function() {
        $('#appointmentsTable').DataTable({
            "language": {
                "search": "Buscar:",
                "lengthMenu": "Mostrar _MENU_ registros por página",
                "zeroRecords": "No se encontraron registros",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
                "infoEmpty": "No hay registros disponibles",
                "infoFiltered": "(filtrado de _MAX_ registros totales)"
            }
        });
    });
    </script>
</body>

</html>
