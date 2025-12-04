<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoriaController;
use App\Http\Controllers\Admin\ProductoController;
use App\Http\Controllers\Admin\PedidoAdminController;
use App\Http\Controllers\Admin\ResenaAdminController;
use App\Http\Controllers\Admin\CuponController;
use App\Http\Controllers\ResenaController;
use App\Http\Controllers\FavoritoController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\ContactoController; 
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\CulqiController;
use App\Http\Controllers\Admin\AdminSoporteController;





// Ruta principal del Home
Route::get('/', [HomeController::class, 'index'])->name('home');


// AUTENTICACIÓN
Route::get('/registro', [AuthController::class, 'showRegisterForm'])->name('auth.register.form');
Route::post('/registro', [AuthController::class, 'register'])->name('auth.register');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('auth.login.form');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');

Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');


// PANEL ADMIN
Route::get('/admin/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'admin'])
    ->name('admin.dashboard');


// RUTAS ADMIN
Route::middleware(['auth', 'admin'])->group(function () {

    // CATEGORÍAS
    Route::get('/admin/categorias', [CategoriaController::class, 'index'])->name('admin.categorias.index');
    Route::get('/admin/categorias/crear', [CategoriaController::class, 'create'])->name('admin.categorias.create');
    Route::post('/admin/categorias', [CategoriaController::class, 'store'])->name('admin.categorias.store');
    Route::get('/admin/categorias/{id}/editar', [CategoriaController::class, 'edit'])->name('admin.categorias.edit');
    Route::put('/admin/categorias/{id}', [CategoriaController::class, 'update'])->name('admin.categorias.update');
    Route::delete('/admin/categorias/{id}', [CategoriaController::class, 'destroy'])->name('admin.categorias.destroy');

    // PRODUCTOS
    Route::get('/admin/productos', [ProductoController::class, 'index'])->name('admin.productos.index');
    Route::get('/admin/productos/crear', [ProductoController::class, 'create'])->name('admin.productos.create');
    Route::post('/admin/productos', [ProductoController::class, 'store'])->name('admin.productos.store');
    Route::get('/admin/productos/{id}/editar', [ProductoController::class, 'edit'])->name('admin.productos.edit');
    Route::put('/admin/productos/{id}', [ProductoController::class, 'update'])->name('admin.productos.update');
    Route::delete('/admin/productos/{id}', [ProductoController::class, 'destroy'])->name('admin.productos.destroy');

    // PEDIDOS
    Route::get('/admin/pedidos', [PedidoAdminController::class, 'index'])
        ->name('admin.pedidos.index');

    Route::get('/admin/pedidos/{id}', [PedidoAdminController::class, 'show'])
        ->name('admin.pedidos.show');
    
    Route::post('/admin/pedidos/{id}/estado', [PedidoAdminController::class, 'cambiarEstado'])
        ->name('admin.pedidos.cambiarEstado');

    // RESEÑAS
    Route::get('/admin/resenas', [ResenaAdminController::class, 'index'])->name('admin.resenas.index');
    Route::get('/admin/resenas/{id}', [ResenaAdminController::class, 'show'])->name('admin.resenas.show');
    Route::post('/admin/resenas/{id}/aprobar', [ResenaAdminController::class, 'aprobar'])->name('admin.resenas.aprobar');
    Route::delete('/admin/resenas/{id}', [ResenaAdminController::class, 'eliminar'])->name('admin.resenas.eliminar');

    //  cupones 
Route::resource('cupones', CuponController::class)
        ->names('admin.cupones');

// Activar / desactivar cupón
Route::patch('cupones/{id}/toggle', [CuponController::class, 'toggleActivo'])
        ->name('admin.cupones.toggle');

// SOPORTE / ASESORÍA
Route::get('/admin/soporte', [AdminSoporteController::class, 'index'])->name('admin.soporte.index');
Route::get('/admin/soporte/{id}', [AdminSoporteController::class, 'show'])->name('admin.soporte.show');
Route::post('/admin/soporte/{id}', [AdminSoporteController::class, 'responder'])->name('admin.soporte.responder');
Route::post('/admin/soporte/{id}/ia', [AdminSoporteController::class, 'generarIA'])->name('admin.soporte.ia');
        
});


// CARRITO
Route::middleware('auth')->group(function () {
    Route::get('/carrito', [CartController::class, 'index'])->name('cart.index');
    Route::post('/carrito/agregar', [CartController::class, 'add'])->name('cart.add');
    Route::post('/carrito/actualizar', [CartController::class, 'update'])->name('cart.update');
    Route::post('/carrito/eliminar', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/carrito/aplicar-cupon', [CartController::class, 'aplicarCupon'])
    ->name('carrito.aplicarCupon');
    
});


// TIENDA
Route::get('/tienda', [StoreController::class, 'index'])->name('store.index');
Route::get('/producto/{id}', [StoreController::class, 'show'])->name('store.show');
// Guardar una reseña
Route::post('/producto/{productoId}/resena', [ResenaController::class, 'store'])
    ->middleware('auth')
    ->name('resenas.store');
Route::post('/resenas/{id}/reportar', [ResenaController::class, 'reportar'])
    ->name('resenas.reportar');



// NOSOTROS
Route::get('/nosotros', function () {
    return view('nosotros');
})->name('nosotros');


// CONTACTO
Route::get('/contacto', function () {
    return view('contacto');
})->name('contacto');

Route::post('/contacto/enviar', [ContactoController::class, 'enviar'])
    ->name('contacto.enviar');


//new no se que pero es para que se suscriba
Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])
     ->name('newsletter.subscribe');


    // ENVIO DE PEDIDOS
Route::middleware('auth')->group(function () {

    // Checkout - Envío
    Route::get('/checkout/envio', [CheckoutController::class, 'envio'])
        ->name('checkout.envio');

    Route::post('/checkout/envio', [CheckoutController::class, 'guardarEnvio'])
        ->name('checkout.envio.guardar');

    // Checkout - Pago
    Route::get('/checkout/pago', [CheckoutController::class, 'pago'])
        ->name('checkout.pago');

     Route::post('/checkout/pago', [CheckoutController::class, 'guardarPago'])
        ->name('checkout.pago.submit');

    //Prosesar pago
    Route::post('/checkout/pago', [CheckoutController::class, 'procesarPago'])
        ->name('checkout.pago.submit');
    Route::get('/culqi/pagar', [CheckoutController::class, 'culqiForm'])
        ->name('culqi.pagar.form');
    Route::post('/culqi/pagar', [CulqiController::class, 'procesarPago'])
       ->name('culqi.pagar');
    Route::post('/culqi/token', [CheckoutController::class, 'culqiToken'])
       ->name('culqi.token');
    

    // CHECKOUT - RESUMEN
    Route::get('/checkout/resumen', [CheckoutController::class, 'resumen'])
        ->name('checkout.resumen');

    Route::get('/checkout/confirmacion', [CheckoutController::class, 'confirmarPedido'])
        ->name('checkout.confirmacion');      
});

// RUTAS PEDIDOS DE USUARIOS
Route::middleware('auth')->group(function () {
    Route::get('/perfil/pedidos', [PedidoController::class, 'index'])
        ->name('perfil.pedidos');
    Route::get('/perfil/pedidos/{id}', [PedidoController::class, 'show'])
        ->name('perfil.pedido.detalle');
});

//RUTAS DE PEFIL
Route::middleware('auth')->group(function () {
    
    // PERFIL PRINCIPAL
    Route::get('/perfil', [PerfilController::class, 'index'])
        ->name('perfil.index');

    Route::post('/perfil/actualizar', [PerfilController::class, 'actualizar'])
        ->name('perfil.actualizar');

    Route::get('/perfil/pedidos/{id}/boleta', [PedidoController::class, 'descargarBoleta'])
        ->name('perfil.pedido.boleta');

    // Lista de favoritos
    Route::get('/perfil/favoritos', [FavoritoController::class, 'index'])
        ->name('perfil.favoritos');

    // Agregar / quitar favorito
    Route::post('/favorito/{producto}', [FavoritoController::class, 'toggle'])
        ->name('favorito.toggle');

    // cambio de contrase
    Route::get('/perfil/seguridad', function () {
        return view('perfil.seguridad');
    })->name('perfil.seguridad')->middleware('auth');
    
    Route::post('/perfil/seguridad/cambiar-password', 
        [PerfilController::class, 'cambiarPassword']
    )->name('perfil.seguridad.cambiar')->middleware('auth');

    // Ver página de Asesoría
    Route::get('/perfil/asesoria', [PerfilController::class, 'asesoria'])
        ->name('perfil.asesoria');

    // Enviar consulta de soporte
    Route::post('/perfil/asesoria', [PerfilController::class, 'enviarConsulta'])
        ->name('perfil.asesoria.enviar');
    Route::post('/perfil/asesoria/{id}/respuesta', [PerfilController::class, 'responderConsulta'])
        ->name('perfil.asesoria.responder');



});
