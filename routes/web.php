<?php

use App\Http\Controllers\CargaVistasController;
use App\Http\Controllers\PersonasController;
use App\Http\Controllers\CuentasController;
use Illuminate\Support\Facades\Route;

// Carga de vistas
Route::get('/', [CargaVistasController::class, 'gestion'])->name('gestion');
Route::get('/gestion', [CargaVistasController::class, 'gestion']);
Route::get('/alta-personas', [CargaVistasController::class, 'altapersonas']);
Route::get('/alta-mto-puntos', [CargaVistasController::class, 'altamtopuntos'])->name('gestionCtaPuntos');
Route::get('/consulta-movimientos', [CargaVistasController::class, 'consultamovimientos']);
Route::get('/alta-movimientos', [CargaVistasController::class, 'altamovimientos']);
Route::get('/detalle-movimiento', [CargaVistasController::class, 'detallemovimiento']);

//*****OPERATIVAS SINCRONAS****

// alta persona

Route::post('/alta-personas', [PersonasController::class, 'alta'])->name('personas.alta');

// consulta persona por niff
Route::get('/personas/{nif?}', [PersonasController::class, 'consulta'])->name('personas.consulta');

//consulta detalle movimiento cuenta puntos
Route::get('/movimientos/{id}', [MovimientosController::class, 'detalle'])->name('movimientos.alta');

// alta movimiento cuenta puntos
Route::post('/movimientos', [MovimientosController::class, 'alta'])->name('movimientos.alta');

//****OPERATIVAS AJAX****

// consulta cuenta puntos
Route::get('/cuentas/{idPersona}', [CuentasController::class, 'consulta'])->name('cuentas.consulta');

// alta cuenta puntos
Route::post('/cuentas', [CuentasController::class, 'alta'])->name('cuentas.alta');

// modificacion cuenta puntos
Route::put('/cuentas/{cuenta}', [CuentasController::class, 'modificacion'])->name('cuentas.modificacion');

// baja cuenta puntos
Route::delete('/cuentas/{cuenta}', [CuentasController::class, 'baja'])->name('cuentas.baja');


