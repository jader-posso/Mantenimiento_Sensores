<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\VehiculoApiController;
use App\Http\Controllers\Api\SensorApiController;
use App\Http\Controllers\Api\LecturaApiController;
use App\Http\Controllers\Api\AlertaApiController;

// ── AUTH ─────────────────────────────────────────────────
Route::post('/login',    [AuthApiController::class, 'login']);
Route::post('/register', [AuthApiController::class, 'register']);

// ── RUTAS PROTEGIDAS ─────────────────────────────────────
Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthApiController::class, 'logout']);
    Route::get('/me',      [AuthApiController::class, 'me']);

    // Vehículos
    Route::get('/vehiculos',         [VehiculoApiController::class, 'index']);
    Route::post('/vehiculos',        [VehiculoApiController::class, 'store']);
    Route::get('/vehiculos/{id}',    [VehiculoApiController::class, 'show']);
    Route::put('/vehiculos/{id}',    [VehiculoApiController::class, 'update']);
    Route::delete('/vehiculos/{id}', [VehiculoApiController::class, 'destroy']);

    // Sensores
    Route::get('/sensores',      [SensorApiController::class, 'index']);
    Route::get('/sensores/{id}', [SensorApiController::class, 'show']);

    // Lecturas — OBD2
    Route::get('/lecturas',  [LecturaApiController::class, 'index']);
    Route::post('/lecturas', [LecturaApiController::class, 'store']);

    // Alertas
    Route::get('/alertas',              [AlertaApiController::class, 'index']);
    Route::post('/alertas/{id}/leer',   [AlertaApiController::class, 'marcarLeida']);
});