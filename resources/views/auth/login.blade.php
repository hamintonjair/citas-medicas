<!-- resources/views/auth/login.blade.php -->
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
    <!-- Bootstrap CSS -->

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

    <!-- Custom CSS -->
    <!-- <link href="{{ asset('css/style.css') }}" rel="stylesheet"> -->

</head>
<style>
.bg-container {
    background-size: cover;
    background-position: center;
    height: 100vh;
}
</style>

<body class="bg-container" style="background-image: url(img/fondo.jpg); ">

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

                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="email" class="form-label">Correo electrónico</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Contraseña</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>

                                <button type="submit" class="btn btn-primary w-100">Iniciar sesión</button>
                            </form>

                            <p class="mt-3 text-center">¿No tienes cuenta? <a
                                    href="{{ route('register') }}">Regístrate</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle JS -->
    <link rel="stylesheet" href="{{ asset('js/bootstrap.bundle.min.js') }}">
</body>

</html>