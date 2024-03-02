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
                <h3>Categorizar gastos</h3>
                @if ($expenses->count())
                <form action="{{ route('set-category') }}" id="frm-categorize" method="POST" role="form" enctype="multipart/form-data" class="needs-validation">
                    @csrf
                    <input type="hidden" name="_method" value="PATCH" />
                    <div class="row align-items-start">
                        <div class="col-10">
                            <label for="chk-select-all" class="form-check-label mb-2">
                                <input type="checkbox" name="chk-select-all" id="chk-select-all" class="form-check-input chk-all-seleccion" />
                                Seleccionar todos
                            </label>
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th scope="col">Gasto</th>
                                        <th scope="col">Categoría actual</th>
                                        <th scope="col">Fecha</th>
                                        <th scope="col">Última actualización</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($expenses as $expense)
                                        <tr>
                                            <td class="data-cell">
                                                <label for="select-{{ $expense->id }}">
                                                    <input type="checkbox" name="expense_ids[]" value="{{ $expense->id }}" id="select-{{ $expense->id }}" class="form-check-input chk-selection" />
                                                        {{ $expense->name }}
                                                </label>
                                            </td>
                                            <td class="data-cell">
                                            @if ($expense->category)
                                                {{ $expense->category->name }}
                                            @else
                                                <span class="text-warning">Sin Categoría</span>
                                            @endif
                                            </td>
                                            <td>{{ Carbon\Carbon::parse($expense->created_at)->format('d/m/Y') }}</td>
                                            <td>{{ Carbon\Carbon::parse($expense->updated_at)->format('d/m/Y') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="col-12 mt-4">
                            <span class="col">Selecciona la categoría que deseas asignar a los elementos seleccionados.</span>
                            <div class="col mt-1">
                                <label for="category-selector">
                                    <select name="category_selector" id="category-selector" class="form-select mb-3" required>
                                        <option value="0" disabled selected>Selecciona una categoría</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </label>
                                <div class="invalid-feedback">
                                    Selecciona una categoría.
                                </div>
                                <button class="btn btn-primary" type="submit">Confirmar</button>
                            </div>
                        </div>
                    </div>
                </form>
                @else
                    No se encontraron categorías. Suba un archivo de categorías y vuelva a esta página.
                @endif
            </div>
        </div>
    </body>
</html>