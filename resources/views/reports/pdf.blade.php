<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <title>Reporte</title>

    <style>

        body{

            font-family: Arial, sans-serif;

        }

        h1{

            text-align: center;

        }

        table{

            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;

        }

        th, td{

            border: 1px solid #000;
            padding: 10px;
            text-align: left;

        }

        th{

            background: #f2f2f2;

        }

    </style>

</head>

<body>

    <h1>Reporte General </h1>

    <p>

        <strong>Ventas Totales:</strong>
        ${{ number_format($ventasTotales, 2) }}

    </p>

    <p>

        <strong>Cantidad Ventas:</strong>
        {{ $cantidadVentas }}

    </p>

    <p>

        <strong>Valor Inventario:</strong>
        ${{ number_format($valorInventario, 2) }}

    </p>

    <h3>Productos Más Vendidos</h3>

    <table>

        <thead>

            <tr>

                <th>Producto</th>
                <th>Total Vendido</th>

            </tr>

        </thead>

        <tbody>

            @foreach($productosVendidos as $venta)

            <tr>

                <td>

                    {{ $venta->product->name ?? 'Producto eliminado' }}

                </td>

                <td>

                    {{ $venta->total_vendido }}

                </td>

            </tr>

            @endforeach

        </tbody>

    </table>

</body>
</html>