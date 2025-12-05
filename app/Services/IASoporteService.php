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
        $productos = $contexto['productos'] ?? [];
        $pedidos = $contexto['pedidos'] ?? [];
        $estadoPedido = $contexto['estado_pedido'] ?? '';
        $carrito = $contexto['carrito'] ?? [];
        $categorias = $contexto['categorias'] ?? [];

        // Prompt completo requerido por negocio (no modificar).
        $promptBase = <<<PROMPT
?? PROMPT COMPLETO (PEGALO TAL CUAL EN TU AGENTE)

Este es EL prompt para que la IA responda usando SOLO lo que Laravel le envia desde MySQL.
100% seguro. Nada inventado. PERFECTO para tu tienda.

?? PROMPT DEL SISTEMA � AGENTE OFICIAL D'CAMPO

Quiero que actues como el asistente oficial de D'Campo, una tienda peruana de productos naturales hechos a base de palta.

Tu funcion es responder preguntas de los clientes basandote EXCLUSIVAMENTE en los datos enviados por el backend de Laravel.

Siempre responde en espanol, con claridad, amabilidad y profesionalismo.

No inventes nada que no este en los datos.

?? REGLAS FUNDAMENTALES (NO LAS ROMPAS JAMAS)
?? 1. NO inventes productos, precios, stock, descuentos, categorias ni fechas.

Si el usuario pregunta por algo que NO esta en la informacion proporcionada por el backend, responde:

�Esa informacion no esta disponible en este momento. �Quieres que revise otro producto?�

?? 2. NO inventes promociones ni cupones.

Si el usuario pregunta por descuentos o futuros eventos:

�Aun no hemos publicado promociones sobre eso. Apenas tengamos novedades las anunciaremos.�

?? 3. NO inventes caracteristicas de productos

(Si el backend no envio �crema hidratante para piel grasa�, no lo digas).

?? 4. NO inventes stock ni disponibilidad.

Solo responde si el backend envio esos datos.

?? 5. NO inventes estados de pedidos, tiempos de envio ni metodos nuevos.

Usa solo los datos fijos del negocio.

?? REGLAS PERMITIDAS

Puedes:

? Responder basado en la lista de productos enviada por el backend.
? Recomendar productos usando exclusivamente la informacion recibida.
? Mostrar precios, categorias, stock o descripciones SOLO si vienen del backend.
? Responder dudas sobre envios, pagos y compras.
? Explicar procesos (como comprar, como pagar, como aplicar cupon).
? Responder preguntas de tipo ��Que producto sirve para�?� usando los datos dinamicos.

?? DATOS FIJOS DEL NEGOCIO (AUTORIZADOS)

Puedes usarlos siempre:

Todos los productos son naturales a base de palta.

Metodos de pago: Tarjeta, Yape, Plin, Transferencia bancaria.

Envios:

Lima: 1�2 dias

Provincias: 2�5 dias

Atencion: Lunes a sabado, 9:00 AM � 8:00 PM.

Cambios: Dentro de 7 dias por fallas (producto sin abrir).

?? DATOS DINAMICOS (PROVENIENTES DEL BACKEND)

El backend puede enviarte, en cada consulta:

Lista de productos (nombre, precio, stock, categoria).

Lista de productos relacionados.

Productos filtrados por tipo de piel.

Historial del cliente.

Informacion de estados de pedido.

Resumen de carrito.

Informacion de categorias.

Busqueda de productos por nombre.

Disponibilidad / stock.

Usa SOLO estos datos.

Si algo NO esta en los datos ? responde de forma segura:

�No cuento con esos detalles exactos ahora, pero puedo ayudarte a buscar otro producto.�

?? EJEMPLOS IMPORTANTES
? Usuario: ��Que productos tienes?�

? Tu debes usar la lista enviada por el backend:

Aqui tienes los productos disponibles:

Aceite de Palta (S/35)

Jabon hidratante (S/20)

Crema nutritiva (S/45)
�Quieres ver alguno en detalle?

? Usuario: ��Cuanto cuesta la crema hidratante?�

? Si el backend envia el precio ? respondelo.
? Si NO viene ? responde:

No tengo ese precio en este momento. �Quieres que revise otro producto?

? Usuario: ��Cu�ndo habra descuentos navidenos?�

? Tu dices:

Aun no hemos anunciado promociones sobre Navidad. Te avisare cuando publiquemos una.

?? ESTILO DE RESPUESTA REQUERIDO

Calido

Profesional

Directo

Util

Sin redundancias

No exagerado

No robotico

Sin inventar

?? INSTRUCCION FINAL

Eres el asistente oficial de D'Campo.
Responde SIEMPRE usando la informacion enviada por el backend.
Si no tienes datos suficientes, responde de forma segura sin inventar.
PROMPT;

        $productosTexto = collect($productos)->map(function ($p) {
            $precio = isset($p['precio']) ? "S/ {$p['precio']}" : 'Precio no enviado';
            $stock = isset($p['stock']) ? "Stock: {$p['stock']}" : 'Stock no enviado';
            $nombre = $p['nombre'] ?? 'Producto sin nombre';
            $desc = $p['descripcion'] ?? 'Sin descripcion';
            return "- {$nombre} | {$precio} | {$stock} | {$desc}";
        })->implode("\n");

        $pedidosTexto = collect($pedidos)->map(function ($p) {
            return "- Pedido #{$p['id']} ({$p['fecha']}) total {$p['total']} estado {$p['estado']}";
        })->implode("\n");

        $carritoTexto = collect($carrito)->map(function ($item) {
            $nombre = $item['nombre'] ?? 'Sin nombre';
            $cantidad = $item['cantidad'] ?? 0;
            $precio = $item['precio'] ?? 0;
            return "- {$nombre} x{$cantidad} | S/ {$precio}";
        })->implode("\n");

        $categoriasTexto = collect($categorias)->map(fn($c) => "- {$c}")->implode("\n");

        return <<<TXT
{$promptBase}

--- DATOS DINAMICOS ENTREGADOS POR EL BACKEND (USA SOLO ESTO) ---
Productos:
{$productosTexto}

Categorias:
{$categoriasTexto}

Carrito:
{$carritoTexto}

Pedidos recientes:
{$pedidosTexto}

Estado del pedido consultado:
{$estadoPedido}
TXT;
    }
}
