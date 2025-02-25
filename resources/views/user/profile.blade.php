<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de {{ session('user')->name }}</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <!-- FullCalendar CSS -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/fullcalendar@3.2.0/dist/fullcalendar.min.css" rel="stylesheet"> -->
</head>

<body class="bg-light">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-primary">
        <div class="container">
            <a class="navbar-brand text-white" href="#">Mi Proyecto</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">

                    @if(session('user'))
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('user.profile', session('user')->id) }}">Hola,
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

    <!-- Main content -->
    <div class="container mt-5">
        <h2 class="text-center">Bienvenido, {{ session('user')->name }}</h2>
    </div>

    <!-- Calendar -->
    <div class="container mt-4">
        <div id="calendar"></div>
    </div>


    <div class="container text-center my-5">
        <!-- Row para centrar el contenido de las cards -->
        <div class="row justify-content-center">

            <!-- Card Animado para Agendar Cita -->
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card shadow-lg p-3 bg-body-tertiary rounded animate__animated animate__fadeInUp">
                    <div class="card-body">
                        <h4 class="card-title">Cita médica o autorización?</h4>
                        <p class="card-text">Agendar tu cita/autorización ahora mismo.</p>
                        <a href="{{ route('agendar') }}" class="btn btn-success">Agendar Cita</a>
                    </div>
                </div>
            </div>

            <!-- Card Animado para Atención al Cliente -->
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card shadow-lg p-3 bg-body-tertiary rounded animate__animated animate__fadeInUp">
                    <div class="card-body">
                        <h4 class="card-title">¿Necesitas Atención al Cliente?</h4>
                        <p class="card-text">Comunicarte con nuestro equipo de soporte.</p>
                        <a href="{{ route('atencion-al-cliente') }}" class="btn btn-primary">Atención al Cliente</a>
                    </div>
                </div>
            </div>

        </div>

        <!-- Fila para la tarjeta de "Perfil" centrada -->
        <div class="row justify-content-center mb-4 m-4">
            <!-- Card Animado para realizar cambios en sus configuración (Perfil Centralizado) -->
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card shadow-lg p-3 bg-body-tertiary rounded animate__animated animate__fadeInUp">
                    <div class="card-body">
                        <h4 class="card-title">Perfil</h4>
                        <p class="card-text">Realizar cambios a tus datos personales.</p>
                        <a href="{{ route('Miperfil') }}" class="btn btn-info">Configuración</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Fila para las tarjetas "Consultar Autorización" y "Consultar Citas" -->
        <div class="row justify-content-center">

            <!-- Card Animado para Consultar autorizacion -->
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card shadow-lg p-3 bg-body-tertiary rounded animate__animated animate__fadeInUp">
                    <div class="card-body">
                        <h4 class="card-title">¿Buscar Autorizaciones?</h4>
                        <p class="card-text">Consultar tus autorizaciones.</p>
                        <a href="{{ route('Autorizacion') }}" class="btn btn-warning">Consultar Autorización</a>
                    </div>
                </div>
            </div>

            <!-- Card Animado para Consultar citas -->
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card shadow-lg p-3 bg-body-tertiary rounded animate__animated animate__fadeInUp">
                    <div class="card-body">
                        <h4 class="card-title">¿Buscar Citas agendadas?</h4>
                        <p class="card-text">Consultar tus citas que agendaste.</p>
                        <a href="{{ route('citas_medicas') }}" class="btn btn-secondary">Consultar Agendas</a>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <link rel="stylesheet" href="{{ asset('js/bootstrap.bundle.min.js') }}">

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        $('#calendar').fullCalendar({
            // Otras configuraciones del calendario
            defaultView: 'month', // Vista mensual por defecto
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            events: [
                // Aquí puedes cargar eventos de tu base de datos o agregar eventos de prueba
                {
                    title: 'Evento de ejemplo',
                    start: '2024-11-10T10:30:00',
                    end: '2024-11-10T12:30:00'
                },
            ]
        });
    });
    </script>
</body>

</html>