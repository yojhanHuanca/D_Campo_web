<footer class="bg-success text-white position-relative overflow-hidden">

    {{-- Fondos decorativos --}}
    <div class="position-absolute top-0 end-0 rounded-circle bg-white opacity-25"
        style="width: 350px; height: 350px; filter: blur(90px);"></div>

    <div class="position-absolute bottom-0 start-0 rounded-circle bg-light opacity-25"
        style="width: 350px; height: 350px; filter: blur(90px);"></div>


    <div class="container py-5 position-relative">

        {{-- NEWSLETTER --}}
        <div class="bg-white bg-opacity-10 backdrop-blur rounded-4 p-5 mb-5 border border-white border-opacity-25 text-center mx-auto" style="max-width: 800px;">
            <h3 class="text-white mb-3">Suscríbete a nuestro newsletter</h3>

            <p class="text-white-50 mb-4">
                Recibe promociones exclusivas, tips de belleza y novedades directamente en tu correo.
            </p>

            <form action="{{ route('newsletter.subscribe') }}"
                method="POST"
                class="d-flex flex-column flex-sm-row gap-3 justify-content-center">

                @csrf

                <input type="email"
                    name="email"
                    required
                    class="form-control rounded-pill px-4 py-3"
                    placeholder="Tu correo electrónico">

                <button type="submit"
                    class="btn btn-warning text-white rounded-pill px-4 d-flex align-items-center gap-2">
                    <i class="bi bi-send"></i> Suscribirme
                </button>
            </form>

            {{-- ALERTA DE ÉXITO --}}
            @if(session('success'))
                <div class="alert alert-success mt-4">
                    {{ session('success') }}
                </div>
            @endif

        </div>


        {{-- GRID PRINCIPAL --}}
        <div class="row g-4 mb-4">

            {{-- BRAND --}}
            <div class="col-12 col-md-6 col-lg-3">
                <div class="d-flex align-items-center mb-3">
                    <div class="rounded-circle bg-warning d-flex align-items-center justify-content-center text-dark"
                        style="width: 45px; height: 45px; font-weight: 600;">
                        D
                    </div>
                    <span class="ms-3 fs-5">D’CAMPO</span>
                </div>

                <p class="text-white-50">
                    Belleza natural con esencia de palta. Productos orgánicos certificados para tu bienestar integral.
                </p>

                <div class="d-flex gap-3 mt-3">
                    <a href="#" class="text-white bg-white bg-opacity-25 rounded-circle d-flex align-items-center justify-content-center"
                        style="width: 40px; height: 40px;">
                        <i class="bi bi-facebook"></i>
                    </a>

                    <a href="#" class="text-white bg-white bg-opacity-25 rounded-circle d-flex align-items-center justify-content-center"
                        style="width: 40px; height: 40px;">
                        <i class="bi bi-instagram"></i>
                    </a>

                    <a href="#" class="text-white bg-white bg-opacity-25 rounded-circle d-flex align-items-center justify-content-center"
                        style="width: 40px; height: 40px;">
                        <i class="bi bi-twitter"></i>
                    </a>
                </div>
            </div>


            {{-- ENLACES RÁPIDOS --}}
            <div class="col-6 col-lg-3">
                <h5 class="mb-3">Enlaces Rápidos</h5>
                <ul class="list-unstyled text-white-50">
                    <li class="mb-2"><a href="{{ url('/') }}" class="text-white-50 text-decoration-none">→ Inicio</a></li>
                    <li class="mb-2"><a href="{{ route('store.index') }}" class="text-white-50 text-decoration-none">→ Tienda</a></li>
                    <li class="mb-2"><a href="#nosotros" class="text-white-50 text-decoration-none">→ Nosotros</a></li>
                    <li class="mb-2"><a href="#contacto" class="text-white-50 text-decoration-none">→ Contacto</a></li>
                </ul>
            </div>


            {{-- ATENCIÓN AL CLIENTE --}}
            <div class="col-6 col-lg-3">
                <h5 class="mb-3">Atención al Cliente</h5>
                <ul class="list-unstyled text-white-50">

                    <li>
                        <button class="footer-info btn btn-link p-0 text-white-50"
                            data-info-type="faq">
                            → Preguntas Frecuentes
                        </button>
                    </li>

                    <li>
                        <button class="footer-info btn btn-link p-0 text-white-50"
                            data-info-type="envios">
                            → Política de Envíos
                        </button>
                    </li>

                    <li>
                        <button class="footer-info btn btn-link p-0 text-white-50"
                            data-info-type="devoluciones">
                            → Devoluciones
                        </button>
                    </li>

                    <li>
                        <button class="footer-info btn btn-link p-0 text-white-50"
                            data-info-type="terminos">
                            → Términos y Condiciones
                        </button>
                    </li>

                    <li>
                        <button class="footer-info btn btn-link p-0 text-white-50"
                            data-info-type="privacidad">
                            → Privacidad
                        </button>
                    </li>

                </ul>
            </div>


            {{-- CONTACTO --}}
            <div class="col-12 col-lg-3">
                <h5 class="mb-3">Contáctanos</h5>
                <ul class="list-unstyled text-white-50">
                    <li class="mb-3 d-flex gap-2">
                        <i class="bi bi-geo-alt text-warning"></i>
                        <span>Av. Javier Prado Este 4200, Lima, Perú</span>
                    </li>

                    <li class="mb-3 d-flex gap-2">
                        <i class="bi bi-telephone text-warning"></i>
                        <a href="tel:+51999888777" class="text-white-50 text-decoration-none">+51 999 888 777</a>
                    </li>

                    <li class="d-flex gap-2">
                        <i class="bi bi-envelope text-warning"></i>
                        <a href="mailto:contacto.dcampo.pe@gmail.com" class="text-white-50 text-decoration-none">
                            contacto.dcampo.pe@gmail.com
                        </a>
                    </li>
                </ul>
            </div>

        </div>


        {{-- BOTTOM BAR --}}
        <div class="border-top border-white border-opacity-25 pt-4 mt-4 text-center text-md-start d-flex flex-column flex-md-row justify-content-between align-items-center text-white-50">

            <p class="mb-2 mb-md-0">&copy; 2025 D'Campo. Todos los derechos reservados.</p>

            <div class="d-flex gap-4">
                <button class="footer-info btn btn-link p-0 text-white-50"
                    data-info-type="terminos">
                    Términos de Servicio
                </button>

                <button class="footer-info btn btn-link p-0 text-white-50"
                    data-info-type="privacidad">
                    Política de Cookies
                </button>

                <a href="#" class="text-white-50 text-decoration-none">Mapa del Sitio</a>
            </div>

        </div>

    </div>
</footer>


{{-- MODAL --}}
<div class="modal fade" id="infoModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="infoModalTitle">Información</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body" id="infoModalContent">
                Cargando...
            </div>

        </div>
    </div>
</div>

@push('scripts')
<script>
    const infoContent = {
        faq: {
            title: 'Preguntas Frecuentes',
            body: `
                <h5>¿Los productos son 100% naturales?</h5>
                <p>
                    Sí, todos nuestros productos están elaborados con ingredientes orgánicos certificados,
                    sin químicos dañinos ni parabenos. Utilizamos palta 100% peruana de la más alta calidad.
                </p>

                <h5>¿Cuánto tiempo tarda en llegar mi pedido?</h5>
                <p>
                    Envíos dentro de Lima: 24-48 horas hábiles.<br>
                    Provincias: 3-5 días hábiles. Todos los envíos incluyen seguimiento en tiempo real.
                </p>

                <h5>¿Puedo devolver un producto?</h5>
                <p>
                    Sí, aceptamos devoluciones dentro de los 30 días posteriores a la compra si el producto
                    está sin abrir y en perfectas condiciones. El envío de la devolución va por cuenta del cliente.
                </p>

                <h5>¿Los productos han sido probados en animales?</h5>
                <p>
                    No, todos nuestros productos son 100% cruelty-free. No realizamos ni autorizamos pruebas en animales.
                </p>

                <h5>¿Tienen tienda física?</h5>
                <p>
                    Actualmente operamos solo en línea para ofrecerte mejores precios. Puedes comprar 24/7 desde nuestra web.
                </p>
            `
        },
        envios: {
            title: 'Política de Envíos',
            body: `
                <h5>Cobertura</h5>
                <p>
                    Realizamos envíos a todo el Perú. Lima Metropolitana y Callao: 24-48 horas hábiles.<br>
                    Provincias: 3-5 días hábiles.
                </p>

                <h5>Costos de Envío</h5>
                <p>
                    • Envío GRATIS en pedidos &gt; S/ 150<br>
                    • Lima Metropolitana: S/ 10<br>
                    • Provincias: S/ 15 - 25 (según zona)
                </p>

                <h5>Seguimiento</h5>
                <p>
                    Todos los envíos incluyen código de seguimiento que enviamos por correo y WhatsApp.
                    Podrás rastrear tu pedido en tiempo real.
                </p>

                <h5>Empaque</h5>
                <p>
                    Usamos empaques reciclables y biodegradables para cuidar el medio ambiente.
                </p>
            `
        },
        devoluciones: {
            title: 'Política de Devoluciones',
            body: `
                <h5>Plazo para Devoluciones</h5>
                <p>
                    Tienes 30 días desde la fecha de recepción del producto para solicitar devolución o cambio.
                </p>

                <h5>Condiciones del Producto</h5>
                <p>
                    Para aceptar una devolución, el producto debe:<br>
                    • Estar sin abrir y en su empaque original<br>
                    • No presentar signos de uso<br>
                    • Incluir todos los accesorios y documentación<br>
                    • Conservar etiquetas y sellos de seguridad
                </p>

                <h5>Proceso de Devolución</h5>
                <p>
                    1. Escríbenos a contacto@dcampo.pe<br>
                    2. Envíanos fotos del producto y número de orden<br>
                    3. Te enviaremos la guía de devolución<br>
                    4. Tras recibir y verificar, el reembolso se procesa en 5-7 días hábiles
                </p>

                <h5>Costos de Devolución</h5>
                <p>
                    El envío de la devolución lo asume el cliente, salvo productos defectuosos o errores de envío.
                </p>
            `
        },
        terminos: {
            title: 'Términos y Condiciones',
            body: `
                <h5>Aceptación de Términos</h5>
                <p>
                    Al usar nuestro sitio aceptas estos términos y condiciones. Si no estás de acuerdo,
                    por favor no utilices la página.
                </p>

                <h5>Uso del Sitio</h5>
                <p>
                    Este sitio es para uso personal y no comercial. No puedes copiar, distribuir, modificar
                    o crear trabajos derivados del contenido sin autorización.
                </p>

                <h5>Productos y Precios</h5>
                <p>
                    Hacemos todo lo posible por mostrar con precisión nuestros productos; sin embargo,
                    los colores pueden variar ligeramente. Nos reservamos el derecho de modificar precios sin previo aviso.
                </p>

                <h5>Cuenta de Usuario</h5>
                <p>
                    Eres responsable de la confidencialidad de tu cuenta y contraseña, así como de todas
                    las actividades realizadas bajo tu cuenta.
                </p>

                <h5>Propiedad Intelectual</h5>
                <p>
                    Todo el contenido de este sitio es propiedad de D'Campo y está protegido por las leyes de derechos de autor.
                </p>
            `
        },
        privacidad: {
            title: 'Política de Privacidad',
            body: `
                <h5>Información que Recopilamos</h5>
                <p>
                    Recopilamos datos que nos proporcionas al crear una cuenta, hacer un pedido o suscribirte
                    al newsletter: nombre, correo, dirección de envío y datos de pago.
                </p>

                <h5>Uso de la Información</h5>
                <p>
                    Utilizamos tu información para:<br>
                    • Procesar y enviar pedidos<br>
                    • Comunicarnos sobre tu compra<br>
                    • Enviarte promociones (si lo autorizaste)<br>
                    • Mejorar nuestro sitio y servicio
                </p>

                <h5>Protección de Datos</h5>
                <p>
                    Usamos medidas de seguridad y encriptación SSL para proteger tu información frente a accesos no autorizados.
                </p>

                <h5>Compartir Información</h5>
                <p>
                    No vendemos tus datos. Solo los compartimos con proveedores esenciales (pagos, envíos),
                    quienes están obligados a mantener la confidencialidad.
                </p>

                <h5>Tus Derechos</h5>
                <p>
                    Puedes acceder, rectificar o eliminar tu información escribiéndonos a contacto@dcampo.pe.
                </p>

                <h5>Cookies</h5>
                <p>
                    Usamos cookies para mejorar tu experiencia. Puedes desactivarlas en tu navegador, pero
                    algunas funciones pueden verse afectadas.
                </p>
            `
        }
    };

    document.querySelectorAll(".footer-info").forEach(btn => {
        btn.addEventListener("click", () => {
            const type = btn.dataset.infoType;
            if (!type || !infoContent[type]) return;

            const modalTitle = document.getElementById("infoModalTitle");
            const modalContent = document.getElementById("infoModalContent");
            const modalEl = document.getElementById("infoModal");

            modalTitle.textContent = infoContent[type].title;
            modalContent.innerHTML = infoContent[type].body;

            const modal = new bootstrap.Modal(modalEl);
            modal.show();
        });
    });
</script>
@endpush
