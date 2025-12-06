# D'Campo – E‑commerce de productos Naturales (Laravel 12)

Plataforma de tienda para D'Campo: catálogo cosmético y culinario a base de palta, carrito con cupones, checkout multi‑método, perfil de usuario, reseñas, favoritos, soporte con IA y panel administrativo.

## Stack
- PHP 8.2+, Laravel 12
- MySQL/MariaDB
- Vite + Bootstrap 5 + Icons
- Paquetes: barryvdh/laravel-dompdf, culqi/culqi-php, grok-php/client (Groq), laravel/pail, laravel/pint, PHPUnit

## Funcionalidades
- Tienda: listado con búsqueda, filtros por categoría/precio/orden, detalle con reseñas y favoritos.
- Carrito y cupones: agregar/actualizar/eliminar, aplicación de cupones con vigencia, límites y registro de uso.
- Checkout: dirección de envío, resumen (subtotal+IGV+envío−descuento), pagos por tarjeta (Culqi), Yape, Plin o transferencia, comprobantes y código de seguimiento.
- Perfil: datos del usuario, cambio de contraseña, historial y boletas, favoritos, soporte/asesoría.
- Reseñas: creación, reporte, moderación en admin.
- Admin: dashboard, CRUD de categorías/productos, gestión de pedidos (estado), cupones (toggle, límite/fecha), reseñas y soporte (respuesta manual o IA).
- Soporte con IA: respuestas generadas vía Groq con contexto de pedidos recientes.

## Requisitos previos
- PHP 8.2+, Composer
- Node.js 18+ y npm
- MySQL/MariaDB en ejecución

## Instalación
```bash
# Dependencias backend
composer install

# Dependencias frontend
npm install
