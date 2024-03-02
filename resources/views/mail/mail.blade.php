<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <style>
            .container {
                padding: 50px;
            }
            body {
                background-color: #181818;
                color: #a4a4a4;
            }
            table {
                width: 100%;
            }
            .expense {
                text-align: left;
            }
            .amount {
                text-align: right;
            }
            .date {
                text-align: center;
            }
        </style>
    </head>
    <body>
        <div class="container">
            Hola, {{ $name }}
            <p>Tu archivo ha sido importado exitosamente.</p>
            <p>Estos son los gastos importados desde tu archivo Excel.</p>
            <table>
                <thead>
                    <tr>
                        <th class="expense">Gasto</th>
                        <th class="amount">Monto</th>
                        <th class="date">Fecha</th>
                        <th class="date">Última actualización</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($expenses as $expense)
                        <tr>
                            <td class="expense">{{ $expense->name }}</td>
                            <td class="amount">$ {{ $expense->amount }}</td>
                            <td class="date">{{ Carbon\Carbon::parse($expense->created_at)->format('d/m/Y') }}</td>
                            <td class="date">{{ Carbon\Carbon::parse($expense->updated_at)->format('d/m/Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </body>
</html>