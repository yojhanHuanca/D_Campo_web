<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoriaController;
use App\Http\Controllers\Admin\ProductoController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\StoreController;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [HomeController::class, 'index'])->name('home');

// FORMULARIO DE REGISTRO (mostrar la vista)
Route::get('/registro', [AuthController::class, 'showRegisterForm'])->name('auth.register.form');

// PROCESAR REGISTRO (guardar usuario en DB)
Route::post('/registro', [AuthController::class, 'register'])->name('auth.register');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('auth.login.form');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');


Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

// PANEL DE ADMINISTRACIÓN
Route::get('/admin/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'admin'])
    ->name('admin.dashboard');

// HOME DE CLIENTE
Route::get('/home', function () {
    return 'Bienvenido al Home del cliente ';
})->name('home');



// RUTAS ADMIN (CATEGORÍAS + PRODUCTOS)
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

});

// Carrito (solo usuarios registrados)
Route::middleware('auth')->group(function () {
    Route::get('/carrito', [CartController::class, 'index'])->name('cart.index');
    Route::post('/carrito/agregar', [CartController::class, 'add'])->name('cart.add');
    Route::post('/carrito/actualizar', [CartController::class, 'update'])->name('cart.update');
    Route::post('/carrito/eliminar', [CartController::class, 'remove'])->name('cart.remove');
});



Route::get('/tienda', [StoreController::class, 'index'])->name('store.index');
Route::get('/producto/{id}', [StoreController::class, 'show'])->name('store.show');
