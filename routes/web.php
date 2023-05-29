<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlergenoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\PlatoController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\TipoController;
use App\Http\Controllers\TurnoController;
use App\Http\Controllers\UserController;

Route::get('/dashboard',[DashboardController::class, 'index'])->name('dashboard');

Route::get('/', [IndexController::class, 'index'])->name('index');
Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserController::class, 'login'])->name('login');
Route::get('/logout', [UserController::class, 'logout']);
Route::get('/register', [UserController::class, 'create'])->name('register');
Route::post('/register', [UserController::class, 'register'])->name('register');
Route::get('/registerAdmin', [UserController::class, 'createAdmin'])->name('registerAdmin');
Route::post('/registerAdmin', [UserController::class, 'registerAdmin'])->name('registerAdmin');

Route::get('/reservas', [ReservaController::class, 'reservas'])->name('reservas');
Route::get('/reservar', [ReservaController::class, 'create'])->name('reservar');
Route::post('/reservar', [ReservaController::class, 'store'])->name('reservar.store');
Route::get('/reservas/{id}/edit', [ReservaController::class, 'edit']);
Route::put('/reservas/{id}', [ReservaController::class, 'update']);
Route::delete('/reservas/{id}', [ReservaController::class, 'destroy']);

Route::get('/users', [UserController::class, 'users'])->name('users/index');
Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users/edit');
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
Route::get('/users/{id}/delete', [UserController::class, 'delete'])->name('users/delete');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

Route::get('/categorias/create', [CategoriaController::class, 'create'])->name('categorias/new');
Route::post('/categorias', [CategoriaController::class, 'store'])->name('categorias.store');
Route::get('/categorias/{id}/edit', [CategoriaController::class, 'edit'])->name('categorias/edit');
Route::put('/categorias/{categoria}', [CategoriaController::class, 'update'])->name('categorias.update');
Route::get('/categorias/{id}/delete', [CategoriaController::class, 'delete'])->name('categorias/delete');
Route::delete('/categorias/{id}', [CategoriaController::class, 'destroy'])->name('categorias.destroy');

Route::get('/tipos/create', [TipoController::class, 'create'])->name('tipos/new');
Route::post('/tipos', [TipoController::class, 'store'])->name('tipos.store');
Route::get('/tipos/{id}/edit', [TipoController::class, 'edit'])->name('tipos/edit');
Route::put('/tipos/{id}', [TipoController::class, 'update'])->name('tipos.update');
Route::get('/tipos/{id}/delete', [TipoController::class, 'delete'])->name('tipos/delete');
Route::delete('/tipos/{id}', [TipoController::class, 'destroy'])->name('tipos.destroy');

Route::get('/alergenos/create', [AlergenoController::class, 'create'])->name('alergenos/create');
Route::post('/alergenos', [AlergenoController::class, 'store'])->name('alergenos.store');
Route::get('/alergenos/{id}/edit', [AlergenoController::class, 'edit'])->name('alergenos/edit');
Route::put('/alergenos/{id}', [AlergenoController::class, 'update'])->name('alergenos.update');
Route::get('/alergenos/{id}/delete', [AlergenoController::class, 'delete'])->name('alergenos/delete');
Route::delete('/alergenos/{id}', [AlergenoController::class, 'destroy'])->name('alergenos.destroy');

Route::get('/turnos/create', [TurnoController::class, 'create'])->name('turnos/create');
Route::post('/turnos', [TurnoController::class, 'store'])->name('turnos.store');
Route::get('/turnos/{id}/edit', [TurnoController::class, 'edit'])->name('turnos/edit');
Route::put('/turnos/{id}', [TurnoController::class, 'update'])->name('turnos.update');
Route::get('/turnos/{id}/delete', [TurnoController::class, 'delete'])->name('turnos/delete');
Route::delete('/turnos/{id}', [TurnoController::class, 'destroy'])->name('turnos.destroy');

Route::get('/platos/create', [PlatoController::class, 'create'])->name('platos/create');
Route::post('/platos', [PlatoController::class, 'store'])->name('platos.store');
Route::get('/platos/{id}/edit', [PlatoController::class, 'edit'])->name('platos/edit');
Route::put('/platos/{id}', [PlatoController::class, 'update'])->name('platos.update');
Route::get('/platos/{id}/delete', [PlatoController::class, 'delete'])->name('platos.delete');
Route::delete('/platos/{id}', [PlatoController::class, 'destroy'])->name('platos.destroy');
