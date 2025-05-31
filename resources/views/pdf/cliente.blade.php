<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Clientes</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
            color: #333;
            margin: 20px;
        }

        h2 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        thead {
            background-color: #34495e;
            color: white;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 8px 6px;
            text-align: left;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .footer {
            text-align: center;
            font-size: 10px;
            margin-top: 30px;
            color: #aaa;
        }
    </style>
</head>
<body>
    <h2>📋 Listado de Clientes</h2>

    <table>
        <thead>
            <tr>
                <th>Nombres</th>
                <th>Apellido Paterno</th>
                <th>Apellido Materno</th>
                <th>Tipo Doc</th>
                <th>N° Documento</th>
                <th>Teléfono</th>
                <th>Dirección</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clientes as $cliente)
                <tr>
                    <td>{{ $cliente->nombres }}</td>
                    <td>{{ $cliente->pri_ape }}</td>
                    <td>{{ $cliente->seg_ape }}</td>
                    <td>{{ $cliente->docu_tip }}</td>
                    <td>{{ $cliente->docu_num }}</td>
                    <td>{{ $cliente->telefono }}</td>
                    <td>{{ $cliente->direccion }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Generado automáticamente - {{ \Carbon\Carbon::now()->format('d/m/Y H:i') }}
    </div>
    
</body>
</html>
