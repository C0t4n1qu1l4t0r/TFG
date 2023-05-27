<?php

use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlergenoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\PlatoController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\TipoController;
use App\Http\Controllers\TurnoController;
use App\Http\Controllers\UserController;

Route::get('/', [IndexController::class, 'index'])->name('index');

Route::get('/categorias/create', [CategoriaController::class, 'create'])->name('new-categoria');
Route::post('/categorias', [CategoriaController::class, 'store'])->name('categorias.store');
Route::get('/categorias/{id}/edit', [CategoriaController::class, 'edit'])->name('edit-categoria');
Route::put('/categorias/{categoria}', [CategoriaController::class, 'update'])->name('categorias.update');

Route::get('/alergenos', [AlergenoController::class, 'index']);
Route::get('/alergenos/create', [AlergenoController::class, 'create']);
Route::post('/alergenos', [AlergenoController::class, 'store']);
Route::get('/alergenos/{id}/edit', [AlergenoController::class, 'edit']);
Route::put('/alergenos/{id}', [AlergenoController::class, 'update']);
Route::delete('/alergenos/{id}', [AlergenoController::class, 'destroy']);



Route::get('/edit-categoria/{id}', [CategoriaController::class, 'edit']);
Route::put('/categorias/{id}', [CategoriaController::class, 'update']);
Route::delete('/categorias/{id}', [CategoriaController::class, 'destroy']);

Route::get('/platos/create', [PlatoController::class, 'create']);
Route::post('/platos', [PlatoController::class, 'store']);
Route::get('/platos/{id}/edit', [PlatoController::class, 'edit']);
Route::put('/platos/{id}', [PlatoController::class, 'update']);
Route::delete('/platos/{id}', [PlatoController::class, 'destroy']);

Route::get('/reservas', [ReservaController::class, 'index']);
Route::get('/reservas/create', [ReservaController::class, 'create']);
Route::post('/reservas', [ReservaController::class, 'store']);
Route::get('/reservas/{id}/edit', [ReservaController::class, 'edit']);
Route::put('/reservas/{id}', [ReservaController::class, 'update']);
Route::delete('/reservas/{id}', [ReservaController::class, 'destroy']);


Route::get('/tipos/create', [TipoController::class, 'create']);
Route::post('/tipos', [TipoController::class, 'store']);
Route::get('/tipos/{id}/edit', [TipoController::class, 'edit']);
Route::put('/tipos/{id}', [TipoController::class, 'update']);
Route::delete('/tipos/{id}', [TipoController::class, 'destroy']);

Route::get('/turnos', [TurnoController::class, 'index']);
Route::get('/turnos/create', [TurnoController::class, 'create']);
Route::post('/turnos', [TurnoController::class, 'store']);
Route::get('/turnos/{id}/edit', [TurnoController::class, 'edit']);
Route::put('/turnos/{id}', [TurnoController::class, 'update']);
Route::delete('/turnos/{id}', [TurnoController::class, 'destroy']);

Route::get('/users', [UserController::class, 'index']);
Route::get('/users/create', [UserController::class, 'create']);
Route::post('/users', [UserController::class, 'store']);
Route::get('/users/{id}/edit', [UserController::class, 'edit']);
Route::put('/users/{id}', [UserController::class, 'update']);
Route::delete('/users/{id}', [UserController::class, 'destroy']);
