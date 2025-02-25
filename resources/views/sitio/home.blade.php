<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Citas Médicas</title>
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
                    @if(session('user'))
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('user.profile') }}">Hola,
                            {{ session('user')->name}}</a>
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

    <!-- Banner -->
    <div class="container-fluid p-0 d-flex justify-content-center align-items-center m-5">
        <img src="https://oki-kyo.jp/wp-content/uploads/2022/08/shinryonaika1-1024x347.jpg" width="1000" height="100"
            class="img-fluid" alt="Banner">
    </div>
    <!-- Contenedor Principal -->
    <div class="container text-center my-5">

        <!-- Row para centrar el contenido de las cards -->
        <div class="row justify-content-end">

            <!-- Card Animado para Agendar Cita -->
            <div class="col-md-6 col-lg-6 mb-6">
                <div class="card shadow-lg p-3 bg-body-tertiary rounded animate__animated animate__fadeInUp">
                    <div class="card-body">
                        <h4 class="card-title">Cita médica o autorización?</h4>
                        <p class="card-text">Agendar tu cita/autorización ahora mismo.</p>
                        <a href="{{ route('login') }}" class="btn btn-success">Agendar Cita</a>
                    </div>
                </div>
            </div>

            <!-- Card Animado para Atención al Cliente -->
            <div class="col-md-6 col-lg-6 mb-6">
                <div class="card shadow-lg p-3 bg-body-tertiary rounded animate__animated animate__fadeInUp">
                    <div class="card-body">
                        <h4 class="card-title">¿Necesitas Atención al Cliente?</h4>
                        <p class="card-text">Comunicarte con nuestro equipo de soporte.</p>
                        <a href="{{ route('atencion-al-cliente') }}" class="btn btn-primary">Atención al Cliente</a>
                    </div>
                </div>
            </div>

            <!-- Card Animado para Consultar Medicamentos -->
            <!-- <div class="col-md-6 col-lg-4 mb-4">
                <div class="card shadow-lg p-3 bg-body-tertiary rounded animate__animated animate__fadeInUp">
                    <div class="card-body">
                        <h4 class="card-title">¿Buscas Medicamentos?</h4>
                        <p class="card-text">Consultar disponibilidad de medicamentos.</p>
                        <a href="{{ route('login') }}" class="btn btn-warning">Consultar Medicamentos</a>
                    </div>
                </div>
            </div> -->

        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center p-3">
        <p>&copy; 2024 Citas Médicas. Todos los derechos reservados.</p>
    </footer>

    <!-- Bootstrap Bundle JS -->

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
