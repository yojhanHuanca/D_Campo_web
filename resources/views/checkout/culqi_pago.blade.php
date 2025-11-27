<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Pagar con Tarjeta - D'Campo</title>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet" />

    {{-- Culqi --}}
    <script src="https://checkout.culqi.com/js/v4"></script>

    <style>
        body {
            background: rgba(0, 0, 0, 0.65);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
        }

        .modal-pago {
            background: #ffffff;
            width: 100%;
            max-width: 420px;
            padding: 25px 30px;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
            animation: abrir 0.25s ease-out;
        }

        @keyframes abrir {
            from {
                transform: scale(0.85);
                opacity: 0;
            }
            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        .btn-pagar {
            width: 100%;
            background: #198754;
            color: white;
            font-weight: bold;
            border-radius: 10px;
            padding: 12px;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-pagar:hover {
            background: #157347;
            transform: translateY(-1px);
        }

        .btn-pagar:disabled {
            background: #6c757d;
            transform: none;
        }
    </style>
</head>

<body>
    <div class="modal-pago">
        {{-- Header --}}
        <div class="text-center mb-4">
            <div class="bg-success bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                style="width: 60px; height: 60px">
                <i class="bi bi-credit-card-2-front text-success fs-4"></i>
            </div>
            <h4 class="fw-bold mb-2">Pago con Tarjeta</h4>
            <p class="text-muted mb-0">
                Monto a pagar:
                <span class="fw-bold text-dark">S/ {{ number_format($total, 2) }}</span>
            </p>
        </div>

        {{-- Cancelar --}}
        <a href="javascript:window.close()" class="btn btn-outline-secondary w-100">
            <i class="bi bi-arrow-left me-2"></i>
            Cancelar
        </a>

        {{-- Seguridad --}}
        <div class="text-center mt-4">
            <small class="text-muted">
                <i class="bi bi-shield-check me-1"></i>
                Pago 100% seguro con Culqi
            </small>
        </div>
    </div>

    <script>
    // PUBLIC KEY from .env
    Culqi.publicKey = "{{ env('CULQI_PUBLIC_KEY') }}";

    // Abrir Culqi AUTOMÁTICAMENTE al cargar
    document.addEventListener('DOMContentLoaded', function() {
        // Ocultar el contenido y mostrar solo loading
        document.querySelector('.modal-pago').innerHTML = `
            <div class="text-center">
                <div class="spinner-border text-success mb-3" role="status">
                    <span class="visually-hidden">Cargando...</span>
                </div>
                <h5 class="text-success">Cargando pasarela de pago...</h5>
            </div>
        `;

        Culqi.options({
            lang: "es",
            modal: true,
            installments: false,
        });

        Culqi.settings({
            title: "D'Campo",
            currency: "PEN", 
            amount: {{ intval($total * 100) }},
            email: "{{ auth()->user()->email }}",
        });

        // Abrir formulario Culsi automáticamente
        setTimeout(() => {
            Culqi.open();
        }, 1000);
    });

    <script>
function culqi() {
    if (Culqi.token) {

        // Token generado por Culqi
        const token = Culqi.token.id;

        // Enviar token a Laravel
        fetch("{{ route('culqi.token') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({ token })
        })
        .then(res => res.json())
        .then(data => {

            if (data.success) {
                // Redirigir al RESUMEN
                if (window.opener && !window.opener.closed) {
                    window.opener.location.href = "{{ route('checkout.resumen') }}";
                }
                window.close();
            } else {
                alert("Error en pago: " + data.message);
            }

        })
        .catch(() => {
            alert("Error al procesar pago");
        });

    } else {
        alert(Culqi.error.user_message || "No se pudo procesar el pago");
    }
}
</script>


</body>
</html>
