<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" type="image/png" href="https://getaldea.com/favicon.png">

        <title>Aldea Test</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        
        @vite(['resources/js/app.js'])
    </head>
    <body>
        @include('navbar.nav')
        <div class="container d-flex align-items-center justify-content-center min-vh-100">
            <div class="mb-3">
                <h3>Iniciar Sesión</h3>
                <form action="{{ route('signin') }}" method="POST">
                    @csrf
                    <div class="col-12 mb-2">
                        <label for="email" class="form-label">
                            <input type="email" name="email" id="email" placeholder="Correo electrónico..." class="form-control" required>
                        </label>
                    </div>
                    <div class="col-12 mb-2">
                        <label for="password">
                            <input type="password" name="password" id="password" placeholder="Contraseña..." class="form-control" required>
                        </label>
                    </div>
                    @if(Session::has('error'))
                        <div class="col-12 mb-2 alert alert-danger" role="alert">
                            {{ Session::get('error') }}
                        </div>
                    @endif
                    <div class="col-12 mb-3">
                        <label for="remember">
                            <input type="checkbox" name="remember" id="remember">
                            Mantener mi sesión activa
                        </label>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary" type="submit">Iniciar Sesión</button>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>