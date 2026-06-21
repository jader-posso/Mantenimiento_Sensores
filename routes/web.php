<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VehiculoController;
use App\Http\Controllers\SensorController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AlertaWebController;
use App\Http\Controllers\HistorialController;

// ── RUTAS PÚBLICAS ──────────────────────────────────────
Route::get('/', function () {
    return view('vehiculos.index');
})->name('home');

Route::get('/nosotros', [DashboardController::class, 'nosotros']);

// ── AUTH CLIENTE ─────────────────────────────────────────
Route::get('/login',     [AuthController::class, 'showLogin'])->name('login');
Route::post('/login',    [AuthController::class, 'login']);
Route::get('/register',  [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout',   [AuthController::class, 'logout'])->name('logout');

// ── RUTAS CLIENTE PROTEGIDAS ─────────────────────────────
Route::middleware('auth')->group(function () {
    Route::get('/dashboard',        [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/vehiculos',        [DashboardController::class, 'vehiculos']);
    Route::get('/vehiculos/create', [VehiculoController::class, 'create']);
    Route::post('/vehiculos',       [VehiculoController::class, 'store']);
    Route::get('/sensores',         [SensorController::class, 'index']);
    Route::get('/alertas',   [AlertaWebController::class, 'index']);
    Route::get('/historial', [HistorialController::class, 'index']);
});

// ── AUTH ADMIN ───────────────────────────────────────────
Route::get('/admin/login', function () {
    return view('admin.login');
})->name('admin.login');

Route::post('/admin/login', function (\Illuminate\Http\Request $request) {
    $usuario = \App\Models\Usuario::where('Correo', $request->correo)->first();

    if ($usuario && \Illuminate\Support\Facades\Hash::check($request->contrasena, $usuario->Contrasena)) {
        Auth::guard('admin')->login($usuario);
        return redirect('/admin');
    }

    return back()->withErrors(['correo' => 'Credenciales incorrectas.']);
});

Route::post('/admin/logout', function () {
    Auth::guard('admin')->logout();
    return redirect('/admin/login');
})->name('admin.logout');

// ── RUTAS ADMIN PROTEGIDAS ───────────────────────────────
Route::middleware(['admin'])->prefix('admin')->group(function () {
    Route::get('/',                          [AdminController::class, 'index']);
    Route::get('/vehiculo/{id}/editar',      [AdminController::class, 'editarVehiculo']);
    Route::post('/vehiculo/{id}/actualizar', [AdminController::class, 'actualizarVehiculo']);
    Route::post('/vehiculo/{id}/eliminar',   [AdminController::class, 'eliminarVehiculo']);
    Route::get('/sensor/{id}/editar',        [AdminController::class, 'editarSensor']);
    Route::post('/sensor/{id}/actualizar',   [AdminController::class, 'actualizarSensor']);
    Route::post('/sensor/{id}/eliminar',     [AdminController::class, 'eliminarSensor']);
    Route::post('/sensor/crear',             [AdminController::class, 'crearSensor']);
});