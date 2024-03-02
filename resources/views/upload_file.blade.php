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
                <h3>Subir archivo de gastos</h3>
                <form action="{{ route('upload-file') }}" method="POST" enctype="multipart/form-data">
                @csrf
                    <div class="col-12">
                        <label for="file" class="form-label">
                            <input type="file" name="file" id="file" class="form-control" required>
                        </label>
                    </div>

                    @if(Session::has('success'))
                        <div class="mb-2 alert alert-primary" role="alert">
                            {{ Session::get('success') }}
                        </div>
                    @elseif(Session::has('error'))
                        <div class="mb-2 alert alert-danger" role="alert">
                            {{ Session::get('error') }}
                        </div>
                    @endif

                    <div class="col-12">
                        <button class="btn btn-primary" type="submit">Subir archivo</button>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>