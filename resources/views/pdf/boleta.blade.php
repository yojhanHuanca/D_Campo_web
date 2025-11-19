
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Boleta D’Campo</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            color: #333;
            padding: 20px;
            font-size: 13px;
        }
        .header {
            text-align: center;
            margin-bottom: 25px;
        }
        .logo {
            font-size: 28px;
            font-weight: bold;
            color: #4a8f67;
        }
        .subtitulo {
            color: #777;
            font-size: 14px;
        }
        .tabla {
            width: 100%;
            border-collapse: collapse;
        }
        .tabla th {
            background: #4a8f67;
            color: #fff;
            padding: 8px;
        }
        .tabla td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }
        .totales {
            margin-top: 20px;
            width: 100%;
        }
        .totales td {
            padding: 6px;
        }
        .right {
            text-align: right;
        }
        .footer {
            margin-top: 35px;
            text-align: center;
            color: #4a8f67;
            font-style: italic;
        }
    </style>
</head>

<body>

    {{-- ENCABEZADO --}}
    <div class="header">
        <div class="logo">D’CAMPO</div>
        <div class="subtitulo">Belleza natural & Productos orgánicos</div>
        <hr>
    </div>

    {{-- INFORMACIÓN DE LA BOLETA --}}
    <h3 style="margin-bottom: 5px;">Boleta de Compra</h3>
    <p><strong>N° Pedido:</strong> DC-{{ $pedido->id }}</p>
    <p><strong>Fecha:</strong> {{ $pedido->created_at->locale('es')->translatedFormat('d \d\e F \d\e\l Y, h:i a') }}</p>
    <p><strong>Código de seguimiento:</strong> {{ $pedido->codigo_seguimiento }}</p>

    <br>

    {{-- INFORMACIÓN DEL CLIENTE --}}
    <h4 style="margin-bottom: 5px;">Datos del Cliente</h4>
    <p><strong>Nombre:</strong> {{ $pedido->usuario->name }}</p>
    <p><strong>Email:</strong> {{ $pedido->usuario->email }}</p>

    <br>

    {{-- TABLA DE PRODUCTOS --}}
    <h4 style="margin-bottom: 8px;">Productos adquiridos</h4>

    <table class="tabla">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cant.</th>
                <th>Precio</th>
                <th>Total</th>
            </tr>
        </thead>

        <tbody>
        @foreach ($pedido->items as $item)
            <tr>
                <td>{{ $item->producto->nombre }}</td>
                <td class="right">{{ $item->cantidad }}</td>
                <td class="right">S/ {{ number_format($item->precio, 2) }}</td>
                <td class="right">S/ {{ number_format($item->cantidad * $item->precio, 2) }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{-- TOTALES --}}
    <table class="totales">
        <tr>
            <td class="right"><strong>Subtotal:</strong></td>
            <td class="right">S/ {{ number_format($pedido->subtotal, 2) }}</td>
        </tr>
        <tr>
            <td class="right"><strong>IGV (18%):</strong></td>
            <td class="right">S/ {{ number_format($pedido->igv, 2) }}</td>
        </tr>
        <tr>
            <td class="right"><strong>Envío:</strong></td>
            <td class="right">S/ {{ number_format($pedido->envio, 2) }}</td>
        </tr>
        <tr>
            <td class="right"><strong>Total:</strong></td>
            <td class="right"><strong>S/ {{ number_format($pedido->total, 2) }}</strong></td>
        </tr>
    </table>

    <div class="footer">
        🌿 Gracias por comprar en D’Campo.  
        Tu bienestar es nuestra prioridad.  
    </div>

</body>
</html>
