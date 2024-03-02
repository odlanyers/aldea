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
                <h3>Estadísticas</h3>
                @if ($categories->count())
                <table class="table table-borderless">
                    <thead>
                        <tr>
                            <th scope="col">Categoría</th>
                            <th scope="col">Número de elementos</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td class="data-cell">{{ $category->name }}</td>
                                <td class="data-cell text-center">
                                    <!-- Esta parte no me gustó que quedara así 
                                    ya que intenté obtener los registros filtrando 
                                    por usuario desde el controlador con Eloquent,
                                    pero no me funcionaba cuando intentaba aplicar 
                                    el where con el id del usuario -->
                                @if ($category->expenses)
                                    @php
                                        $count = 0;
                                    @endphp
                                @foreach ($category->expenses as $expense)
                                    @if ($expense->user_id == Auth::user()->id)
                                    @php
                                        $count++;
                                    @endphp
                                    @endif
                                @endforeach
                                @endif
                                    {{ $count }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                    No se encontraron categorías. Suba un archivo de categorías y vuelva a esta página.
                @endif
            </div>
        </div>
    </body>
</html>