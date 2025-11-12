<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;


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
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'admin'])->name('admin.dashboard');

// HOME DE CLIENTE
Route::get('/home', function () {
    return 'Bienvenido al Home del cliente 🛒';
})->name('home');