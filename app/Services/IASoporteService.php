<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class IASoporteService
{
    public function generarRespuesta(array $contexto): string
    {
        $apiKey = env('GROQ_API_KEY');
        if (!$apiKey) {
            return 'IA no disponible: falta GROQ_API_KEY en el entorno.';
        }

        $messages = [
            [
                'role' => 'system',
                'content' => $this->construirContexto($contexto),
            ],
            [
                'role' => 'user',
                'content' => $contexto['pregunta'] ?? '',
            ],
        ];

        // Modelo por defecto: ajusta en .env si Groq depreca este.
        $model = env('GROQ_MODEL', 'llama-3.1-8b-instant');

        try {
            $response = Http::withHeaders([
                'Authorization' => "Bearer {$apiKey}",
                'Content-Type' => 'application/json',
            ])
            ->timeout(15)
            ->post('https://api.groq.com/openai/v1/chat/completions', [
                'model' => $model,
                'messages' => $messages,
                'temperature' => 0.4,
            ]);

            if ($response->failed()) {
                $status = $response->status();
                $msg = $response->json('error.message') ?? $response->body();
                return "IA no respondio (HTTP {$status}): " . substr((string) $msg, 0, 180) . " | Modelo: {$model}";
            }

            $data = $response->json();
            return $data['choices'][0]['message']['content'] ?? 'La IA no devolvio contenido.';
        } catch (\Throwable $e) {
            return 'Error comunicando con la IA: ' . $e->getMessage();
        }
    }

    private function construirContexto(array $contexto): string
    {
        $politicas = $contexto['politicas'] ?? 'Sigue las reglas anti-invencion, responde breve y pide datos faltantes.';
        $faq = $contexto['faq'] ?? [];
        $productos = $contexto['productos'] ?? [];
        $pedidos = $contexto['pedidos'] ?? [];
        $estadoPedido = $contexto['estado_pedido'] ?? '';
        $horario = $contexto['horario'] ?? 'Lunes a sabado, 9:00 AM - 8:00 PM.';

        $faqTexto = collect($faq)->map(fn($f) => "- {$f}")->implode("\n");
        $productosTexto = collect($productos)->map(fn($p) => "- {$p['nombre']}: {$p['descripcion']}")->implode("\n");
        $pedidosTexto = collect($pedidos)->map(function ($p) {
            return "- Pedido #{$p['id']} ({$p['fecha']}): total {$p['total']} estado {$p['estado']}";
        })->implode("\n");

        $contextoEstatico = <<<TXT
PROMPT DEL SISTEMA (ANTI-INVENCION)

Actua como el asistente oficial de soporte al cliente de D'Campo, e-commerce peruano de productos naturales y artesanales a base de palta. Estilo: profesional, amable, claro y directo. Responde siempre en espanol, de forma breve pero util.

Reglas fundamentales (no las rompas):
1) No inventes promociones, cupones, porcentajes, codigos, fechas, eventos ni productos. Si preguntan por algo no enviado por el backend, responde: "Aun no hemos publicado esa informacion, pero pronto la anunciaremos."
2) No inventes informacion del negocio que no este en el contexto. No supongas precios, porcentajes, fechas ni campañas.
3) No inventes estados de pedidos, metodos de pago, tiempos de envio ni politicas. Solo responde con datos del backend.
4) No inventes caracteristicas de productos que el backend no haya proporcionado.
5) No inventes correos, telefonos, horarios adicionales ni garantias especiales.

Lo que si puedes hacer: explicar procesos (como comprar, pagar, usar un producto), dar informacion general del negocio, guiar paso a paso, recomendar productos usando la descripcion que te de el backend, responder dudas tecnicas o de navegacion, y usar la informacion dinamica del cliente (pedidos, estado, carrito, etc.).

Informacion fija (segura):
- D'Campo vende productos naturales a base de palta.
- Envios: Lima 1-2 dias habiles; provincias 2-5 dias habiles.
- Pagos: tarjeta, Yape, Plin y transferencia.
- Horario: Lunes a sabado, 9:00 AM - 8:00 PM.
- Politicas: devoluciones dentro de 7 dias por fallas; no se aceptan productos abiertos o usados.

Informacion dinamica (backend): puede llegarte nombre/email del usuario, pedidos recientes y su estado, carrito, productos del catalogo, mensaje del usuario, categoria de la consulta, historial de compras, favoritos, consultas previas, cupones disponibles. Solo usa lo que este presente en los datos. Si algo no esta, responde de forma segura.

Responde siempre cumpliendo: no inventar promociones, fechas, porcentajes, productos ni datos fuera del contexto. Eres el asistente oficial de D'Campo.

Formato de respuesta:
- Usa bullets o pasos, con un emoji inicial en cada bullet/paso.
- Texto breve, sin parrafos largos.
- Si es lista, que se lea claramente como lista ordenada.
TXT;

        return <<<TXT
{$contextoEstatico}

Politicas dinamicas:
{$politicas}

Horario de atencion: {$horario}

Preguntas frecuentes:
{$faqTexto}

Productos destacados:
{$productosTexto}

Historial reciente de pedidos del usuario:
{$pedidosTexto}

Estado del pedido consultado:
{$estadoPedido}

Responde con empatia, en espanol, y da pasos claros sin inventar informacion.
TXT;
    }
}
