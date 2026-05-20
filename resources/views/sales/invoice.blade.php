<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <title>

        Factura #{{ $sale->id }}

    </title>

    <style>

        body {

            font-family: Arial, sans-serif;
            padding: 30px;
            color: #333;

        }

        .header {

            text-align: center;
            margin-bottom: 35px;

        }

        .header h1 {

            margin: 0;
            color: #0d6efd;
            font-size: 32px;

        }

        .header p {

            margin-top: 5px;
            color: #777;
            font-size: 14px;

        }

        .info {

            margin-bottom: 25px;

        }

        .info p {

            margin: 6px 0;
            font-size: 14px;

        }

        table {

            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;

        }

        table th {

            background: #0d6efd;
            color: white;
            padding: 12px;
            text-align: left;

        }

        table td {

            border: 1px solid #ddd;
            padding: 12px;

        }

        tbody tr:nth-child(even) {

            background: #f8f9fa;

        }

        .total {

            margin-top: 25px;
            text-align: right;

        }

        .total h2 {

            color: #198754;
            margin: 0;

        }

        .footer {

            margin-top: 60px;
            text-align: center;
            font-size: 13px;
            color: #777;

        }

        .badge {

            display: inline-block;
            background: #198754;
            color: white;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;

        }

    </style>

</head>

<body>

    <!-- =========================================
         HEADER
    ========================================== -->

    <div class="header">

        <h1>

            🏪 FerreSoft ERP

        </h1>

        <p>

            Sistema Profesional de Facturación

        </p>

    </div>

    <!-- =========================================
         INFORMACIÓN FACTURA
    ========================================== -->

    <div class="info">

        <p>

            <strong>Factura #:</strong>
            {{ $sale->id }}

        </p>

        <p>

            <strong>Fecha:</strong>
            {{ $sale->created_at->format('d/m/Y H:i') }}

        </p>

        <p>

            <strong>Cliente:</strong>
            {{ $sale->client->name ?? 'Cliente no disponible' }}

        </p>

        <p>

            <strong>Producto:</strong>
            {{ $sale->product->name ?? 'Producto eliminado' }}

        </p>

        <p>

            <strong>Estado:</strong>

            <span class="badge">

                PAGADO

            </span>

        </p>

    </div>

    <!-- =========================================
         TABLA FACTURA
    ========================================== -->

    <table>

        <thead>

            <tr>

                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Total</th>

            </tr>

        </thead>

        <tbody>

            <tr>

                <td>

                    {{ $sale->product->name ?? 'Producto eliminado' }}

                </td>

                <td>

                    {{ $sale->quantity }}

                </td>

                <td>

                    ${{ number_format($sale->product->price ?? 0, 2) }}

                </td>

                <td>

                    ${{ number_format($sale->total, 2) }}

                </td>

            </tr>

        </tbody>

    </table>

    <!-- =========================================
         TOTAL
    ========================================== -->

    <div class="total">

        <h2>

            Total:
            ${{ number_format($sale->total, 2) }}

        </h2>

    </div>

    <!-- =========================================
         FOOTER
    ========================================== -->

    <div class="footer">

        Gracias por confiar en FerreSoft ERP 🚀

        <br><br>

        Documento generado automáticamente.

    </div>

</body>

</html>