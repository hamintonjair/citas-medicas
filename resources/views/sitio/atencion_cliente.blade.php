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
            <a class="navbar-brand">Citas Médicas</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    @if(empty(session('user')))
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('login') }}">Iniciar sesión</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('register') }}">Registrarse</a>
                        @else
                    <li class="nav-item">
                        <a class="nav-link text-white"
                            href="{{ route('user.profile', ['id' => session('user')->id]) }}">Home</a>
                    </li>

                    @if(session('user'))
                    <li class="nav-item">
                        <a class="nav-link text-white"
                            href="{{ route('user.profile') }}{{ session('user')->name}}">Hola,
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
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <!-- Banner -->
    <div class="container-fluid p-0 d-flex justify-content-center align-items-center m-5">
        <img src="https://adereso.ai/wp-content/uploads/2024/05/656e42962fcc7a2fb5ca40ef_2024_-tendencias-en-atencion-al-cliente-p-1600.png"
            width="1000" height="100" class="img-fluid" alt="Banner">
    </div>
    <!-- Contenido principal -->
    <div class="container mt-5">
        <h2 class="text-center">Atención al Cliente</h2>
        <p class="text-center">Si tienes alguna duda o problema, aquí están nuestras líneas de atención.</p>


        <!-- Lineas de Atención -->
        <div class="row text-center mt-4">
            @foreach ($lines as $index => $line)
            <!-- contador -->
            <div class="col-md-4 mb-4">
                <div class="card shadow-lg p-3 bg-body-tertiary rounded">
                    <div class="card-body">
                        <!-- Usamos el índice + 1 para mostrar el número de la línea -->
                        <h5 class="card-title">Línea de Atención {{ $index + 1 }}</h5>
                        <p class="card-text">Llame al número <strong>{{ $line->name }}</strong>
                            {{ $line->descripcion }}.
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>



    </div>

    <div class="container text-center my-5">
        <!-- WhatsApp Icono -->
        <div class="text-center mt-5">
            <a href="https://wa.me/573124943527" class="btn btn-success btn-lg" target="_blank">
                <i class="fab fa-whatsapp fa-2x"></i> Contactar por WhatsApp
            </a>
        </div>
    </div>
    <!-- Bootstrap JS -->


    <!-- Footer -->
    <footer class="bg-dark text-white text-center p-3">
        <p>&copy; 2024 Citas Médicas. Todos los derechos reservados.</p>
    </footer>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>


    <!-- Bootstrap Bundle JS -->
</body>

</html>