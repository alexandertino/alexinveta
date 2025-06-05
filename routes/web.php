<?php

use App\Http\Controllers\Cliente\ClienteController;
use App\Http\Controllers\Producto\ProductoController;
use App\Http\Controllers\Proyecto\ProyectoController;
use App\Http\Controllers\ProfileController;
use App\Models\Producto;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/cliente', [ClienteController::class, 'index'])->name('cliente.index');
Route::get('/cliente/create', [ClienteController::class, 'create'])->name('cliente.create');
Route::post('/cliente', [ClienteController::class, 'store'])->name('cliente.store');
Route::get('/cliente/{cliente}/edit', [ClienteController::class, 'edit'])->name('cliente.edit');
Route::put('/cliente/{cliente}', [ClienteController::class, 'update'])->name('cliente.update');
Route::delete('/cliente/{cliente}', [ClienteController::class, 'destroy'])->name('cliente.destroy');
Route::get('/cliente/exportar/pdf', [ClienteController::class, 'exportarPdf'])->name('cliente.exportarPdf');


Route::get('/proyectos', [ProyectoController::class, 'index'])->name('proyecto.index');
Route::get('/proyectos/create', [ProyectoController::class, 'create'])->name('proyecto.create');
Route::post('/proyectos', [ProyectoController::class, 'store'])->name('proyecto.store');
Route::get('/proyectos/{proyecto}/edit', [ProyectoController::class, 'edit'])->name('proyecto.edit');
Route::put('/proyectos/{proyecto}', [ProyectoController::class, 'update'])->name('proyecto.update');
Route::delete('/proyectos/{proyecto}', [ProyectoController::class, 'destroy'])->name('proyecto.destroy');
Route::get('/proyectos/exportar/pdf', [ProyectoController::class, 'exportarPdf'])->name('proyecto.exportarPdf');


Route::get('/productos', [ProductoController::class, 'index'])->name('producto.index');
Route::get('/productos/create', [ProductoController::class, 'create'])->name('producto.create');
Route::post('/productos', [ProductoController::class, 'store'])->name('producto.store');
Route::get('/productos/{producto}/edit', [ProductoController::class, 'edit'])->name('producto.edit');
Route::put('/productos/{producto}', [ProductoController::class, 'update'])->name('producto.update');
Route::delete('/productos/{producto}', [ProductoController::class, 'destroy'])->name('producto.destroy');
Route::get('/productos/exportar/pdf', [ProductoController::class, 'exportarPdf'])->name('producto.exportarPdf');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
