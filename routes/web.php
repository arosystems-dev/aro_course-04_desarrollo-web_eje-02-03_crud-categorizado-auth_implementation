<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CPrincipal;
use App\Http\Controllers\CCategoria;
use App\Http\Controllers\CArticulo;
use App\Http\Controllers\CReporte;
use Illuminate\Support\Facades\Auth;


// AUTENTICACIÓN
Auth::routes();

// RUTAS PROTEGIDAS
Route::middleware('auth')->group(function () {

    // PRINCIPAL
    Route::get('/', [CPrincipal::class, 'showVDashboard']);

    // RUTAS PARA LAS CATEGORÍAS
    Route::get('/categoria/index', [CCategoria::class, 'index']);
    Route::get('/categoria/search', [CCategoria::class, 'search']);
    Route::get('/categoria/create', [CCategoria::class, 'create']);
    Route::post('/categoria/store', [CCategoria::class, 'store']);
    Route::get('/categoria/edit/{id}', [CCategoria::class, 'edit']);
    Route::put('/categoria/update/{id}', [CCategoria::class, 'update']);
    Route::get('/categoria/destroy/{id}', [CCategoria::class, 'destroy']);

    // RUTAS PARA LOS ARTÍCULOS
    Route::get('/articulo/index', [CArticulo::class, 'index']);
    Route::get('/articulo/search', [CArticulo::class, 'search']);
    Route::get('/articulo/create', [CArticulo::class, 'create']);
    Route::post('/articulo/store', [CArticulo::class, 'store']);
    Route::get('/articulo/edit/{id}', [CArticulo::class, 'edit']);
    Route::put('/articulo/update/{id}', [CArticulo::class, 'update']);
    Route::get('/articulo/destroy/{id}', [CArticulo::class, 'destroy']);

    // RUTAS REPORTES
    Route::get('/reporte/stock', [CReporte::class, 'reporteStock']);
});
