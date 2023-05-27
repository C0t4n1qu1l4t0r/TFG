<?php

use App\Http\Controllers\AlergenoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\PlatoController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\TipoController;
use App\Http\Controllers\TurnoController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('alergenos', AlergenoController::class);
Route::apiResource('categorias', CategoriaController::class);
Route::apiResource('images', ImageController::class);
Route::apiResource('platos', PlatoController::class);
Route::apiResource('reservas', ReservaController::class);
Route::apiResource('tipos', TipoController::class);
Route::apiResource('turnos', TurnoController::class);
Route::apiResource('users', UserController::class);
