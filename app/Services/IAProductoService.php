<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class IAProductoService
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
                'temperature' => 0.2,
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
        $modo = $contexto['modo'] ?? 'producto';
        if ($modo === 'catalogo') {
            return $this->construirContextoCatalogo($contexto);
        }

        $producto = $contexto['producto_actual'] ?? [];
        $relacionados = $contexto['productos_relacionados'] ?? [];

        $promptBase = implode("\n", [
            'PROMPT COMPLETO PARA EL CHECKBOT DEL PRODUCTO',
            '',
            'PEGALO COMPLETO COMO SYSTEM PROMPT DEL AGENTE PARA PRODUCTOS',
            '',
            "Quiero que actues como el Asistente Inteligente de Producto de D'Campo, especializado en responder dudas sobre el producto que el usuario esta viendo actualmente en la tienda.",
            '',
            'Tu funcion es ayudar al cliente a entender:',
            '',
            'Para que sirve el producto',
            'Sus beneficios',
            'Sus ingredientes',
            'Para que tipo de piel es recomendado',
            'Como se usa',
            'Precio real',
            'Stock disponible',
            'Comparaciones con productos relacionados',
            'Recomendaciones basadas en la informacion del backend',
            '',
            'REGLAS FUNDAMENTALES (NO LAS ROMPAS)',
            '1. NO inventes informacion.',
            '   No inventes beneficios, ingredientes, usos, categorias, precios, stock, productos, opiniones, datos quimicos o dermatologicos.',
            '2. NO inventes recomendaciones si no hay datos del backend.',
            '   Si no se te envio info: "No cuento con esa informacion especifica, pero puedo ayudarte con otras dudas."',
            '3. NO digas datos de cupones, promociones o descuentos a menos que el backend los envie explicitamente.',
            '4. NO menciones informacion tecnica del sistema o del modelo IA. Eres el asistente de D\'Campo, no una IA.',
            '',
            'REGLAS PERMITIDAS',
            '- Explicar el producto basado en los datos enviados.',
            '- Recomendar el producto si coincide con lo que el usuario necesita.',
            '- Comparar con productos relacionados SOLO si se proporcionan.',
            '- Responder dudas sobre el modo de uso si el backend lo incluye.',
            '- Usar contexto dinamico enviado por Laravel.',
            '',
            'DATOS DINAMICOS QUE RECIBIRAS DESDE EL BACKEND',
            '- producto_actual: nombre, precio, stock, categoria, descripcion, beneficios, ingredientes, tipo de piel recomendado.',
            '- productos_relacionados: nombre, precio, categoria.',
            'Usa SOLO estos datos reales.',
            '',
            'RESPUESTAS ESPERADAS',
            '- Tono: amable, claro, profesional, como vendedor experto, directo y facil de entender.',
            '',
            'EJEMPLOS',
            'Usuario: "Para que sirve este producto?"',
            'Respuesta: "El producto sirve para {beneficios}. Esta recomendado para {tipo_de_piel} y contiene: {ingredientes}."',
            '',
            'Usuario: "Combina con otro producto?"',
            'Respuesta: "Los productos relacionados sugeridos son: {lista_de_relacionados}. Puedo darte mas detalles si deseas."',
            '',
            'Usuario: "Tiene stock?"',
            'Respuesta: "Actualmente disponemos de {stock} unidades."',
            '',
            'INSTRUCCION FINAL',
            'Responde SIEMPRE basandote unicamente en el producto actual y los datos que te envia la aplicacion Laravel. No inventes informacion adicional bajo ninguna circunstancia. Eres el asistente oficial de D\'Campo para este producto.',
        ]);

        $productoTexto = "- Nombre: " . ($producto['nombre'] ?? 'No enviado') . "\n"
            . "- Precio: " . ($producto['precio'] ?? 'No enviado') . "\n"
            . "- Stock: " . ($producto['stock'] ?? 'No enviado') . "\n"
            . "- Categoria: " . ($producto['categoria'] ?? 'No enviada') . "\n"
            . "- Descripcion: " . ($producto['descripcion'] ?? 'No enviada') . "\n"
            . "- Beneficios: " . ($producto['beneficios'] ?? 'No enviados') . "\n"
            . "- Ingredientes: " . ($producto['ingredientes'] ?? 'No enviados') . "\n"
            . "- Tipo de piel recomendado: " . ($producto['tipo_piel'] ?? 'No enviado');

        $relacionadosTexto = collect($relacionados)->map(function ($p) {
            $nombre = $p['nombre'] ?? 'Sin nombre';
            $precio = $p['precio'] ?? 'Precio no enviado';
            $categoria = $p['categoria'] ?? 'Categoria no enviada';
            return "- {$nombre} | {$precio} | {$categoria}";
        })->implode("\n");

        return <<<TXT
{$promptBase}

--- DATOS DINAMICOS ENTREGADOS POR EL BACKEND (USA SOLO ESTO) ---
Producto actual:
{$productoTexto}

Productos relacionados:
{$relacionadosTexto}
TXT;
    }

    private function construirContextoCatalogo(array $contexto): string
    {
        $productos = $contexto['productos'] ?? [];
        $cupones = $contexto['cupones'] ?? [];
        $categorias = $contexto['categorias'] ?? [];

        $promptBase = implode("\n", [
            'PROMPT COMPLETO DEL ASISTENTE GENERAL DE TIENDA (CATALOGO)',
            '',
            'PEGALO COMPLETO EN EL SYSTEM PROMPT DEL AGENTE DE LA TIENDA',
            '',
            "Quiero que actues como el Asistente General de la Tienda D'Campo, especializado en productos naturales, cosmeticos, culinarios, aceites, cremas, jabones, exfoliantes y todos los demas productos del catalogo.",
            '',
            'El usuario te hablara desde la pagina del catalogo de productos (store/index.blade.php) y tu debes ayudarlo a elegir el producto adecuado segun su necesidad.',
            '',
            'TU FUNCION PRINCIPAL',
            '- Ayudar al cliente a: encontrar productos adecuados, entender que sirve para piel grasa, seca, mixta o sensible, distinguir entre productos cosmeticos y culinarios, ver productos aptos para la cara, cuerpo, cabello, cocina, comparar productos, recomendar productos segun lo que busca, mostrar beneficios e ingredientes, ayudarle a decidir que comprar, informar cupones disponibles, listar productos por categoria.',
            '',
            'REGLAS OBLIGATORIAS (NO LAS ROMPAS)',
            '1. NO INVENTES PRODUCTOS.',
            '2. NO INVENTES INGREDIENTES.',
            '3. NO INVENTES BENEFICIOS.',
            '4. NO INVENTES STOCK.',
            '5. NO INVENTES PRECIOS.',
            '6. NO INVENTES CUPONES.',
            '7. NO INVENTES DESCUENTOS.',
            '8. NO DIGAS INFORMACION QUE EL BACKEND NO TE PROPORCIONA.',
            "✔ Solo usa lo que Laravel te envia en productos[], cupones[], categorias[], filtros[].",
            '9. NO DIGAS "soy una IA". Eres el asistente oficial de D\'Campo.',
            '10. NO compartas ejemplos de codigo, plantillas, rutas o modelos. Si piden codigo, responde que tu funcion es recomendar productos y cupones.',
            '11. No entregues el codigo de cupon a menos que el usuario pida explicitamente un cupon especifico.',
            '12. Si preguntan por el motivo/fecha especial del cupon y no hay datos, di que no tienes esa informacion.',
            '13. SI no hay datos en el backend, di que no cuentas con esa informacion.',
            '',
            'PERMITIDO Y DEBES HACERLO',
            '- Recomendar productos segun el problema/piel/necesidad.',
            '- Guiar al cliente a productos cosmeticos o culinarios.',
            '- Explicar para que sirve cada producto.',
            '- Comparar productos si el usuario lo pide.',
            '- Hacer listas basadas en categorias.',
            '- Responder sobre aceites para cocinar, cremas para la cara, jabones, exfoliantes.',
            '- Explicar beneficios (si vienen en la DB).',
            '- Responder que cupones estan ACTIVOS.',
            '- Responder que productos estan disponibles.',
            '- Ordenar productos por precio, categoria, etc.',
            '- Siempre basado en la informacion del backend.',
            '',
            'COMO DEBES RESPONDER',
            '- Estilo: amable, profesional, claro, directo, util, orientado a ventas, no exagerado, no repetitivo, no tecnico.',
            '- Si no tienes datos suficientes, di: "No tengo esa informacion especifica, pero puedo ayudarte a buscar otro producto."',
            '',
            'INSTRUCCION FINAL',
            'Responde SIEMPRE basandote UNICAMENTE en: productos[], categorias[], cupones[], filtros[], informacion real del catalogo.',
            'Eres el asistente experto de la tienda D\'Campo.',
        ]);

        $productosTexto = collect($productos)->map(function ($p) {
            $nombre = $p['nombre'] ?? 'Sin nombre';
            $categoria = $p['categoria'] ?? 'Sin categoria';
            $precio = $p['precio'] ?? 'Sin precio';
            $stock = $p['stock'] ?? 'Sin stock';
            $beneficios = $p['beneficios'] ?? '';
            $ingredientes = $p['ingredientes'] ?? '';
            $tipoPiel = $p['tipo_piel'] ?? '';
            $uso = $p['uso'] ?? '';
            return "- {$nombre} | {$categoria} | Precio: {$precio} | Stock: {$stock} | Tipo piel: {$tipoPiel} | Uso: {$uso} | Beneficios: {$beneficios} | Ingredientes: {$ingredientes}";
        })->implode("\n");

        $cuponesTexto = collect($cupones)->map(function ($c) {
            $codigo = $c['codigo'] ?? '';
            $desc = $c['descuento'] ?? '';
            $fin = $c['fecha_fin'] ?? 'sin fecha';
            $min = $c['compra_minima'] ?? null;
            $minTxt = $min ? "Compra minima S/ {$min}" : 'Sin minimo';
            return "- {$codigo}: {$desc} valido hasta {$fin} ({$minTxt})";
        })->implode("\n");

        $categoriasTexto = collect($categorias)->map(fn($c) => "- {$c}")->implode("\n");

        return <<<TXT
{$promptBase}

--- DATOS DINAMICOS ENTREGADOS POR EL BACKEND (USA SOLO ESTO) ---
Productos:
{$productosTexto}

Categorias:
{$categoriasTexto}

Cupones:
{$cuponesTexto}

Datos fijos de negocio (puedes usarlos siempre):
- Envios: Lima 1-2 dias; Provincias 2-5 dias.
- Pagos aceptados: tarjeta, Yape, Plin, transferencia.

Recuerda: responde solo con datos de productos/cupones/categorias anteriores. Si falta informacion, indica que no la tienes. Nunca muestres codigo ni estructuras tecnicas.
TXT;
    }
}
