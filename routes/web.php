<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TurnosController;
use App\Http\Controllers\CarrerasController;
use App\Http\Controllers\AniosController;
use App\Http\Controllers\UnidadCurricularController;
use App\Models\UnidadCurricular;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/register', function () {
    return view('users/register');
});

//TRUNOS//

Route::get('/turnos', function () {
    return view('turnos.index');
})->name('turnos');

Route::get('/turnos', [TurnosController::class, 'index'])->name('turnos');

Route::post('/turnos', [TurnosController::class, 'store'])->name('turnos');

Route::get('/turnos/{id}', [TurnosController::class, 'show'])->name('turnos-edit');
Route::patch('/turnos/{id}', [TurnosController::class, 'update'])->name('turnos-update');
Route::delete('/turnos{id}', [TurnosController::class, 'destroy'])->name('turnos-destroy');

//FIN TURNOS//


// CARRERAS //

Route::get('/carreras', function () {
    return view('carreras.index');
})->name('carreras');

Route::get('/carreras', [CarrerasController::class, 'index'])->name('carreras');

Route::post('/carreras', [CarrerasController::class, 'store'])->name('carreras');

Route::get('/carreras/{id}', [CarrerasController::class, 'show'])->name('carreras-edit');
Route::patch('/carreras/{id}', [CarrerasController::class, 'update'])->name('carreras-update');
Route::delete('/carreras{id}', [CarrerasController::class, 'destroy'])->name('carreras-destroy');

//FIN CARRERAS//


//INICIO AÑOS//
Route::get('/anios', function () {
    return view('anios.index');
})->name('anios');

Route::get('/anios', [AniosController::class, 'index'])->name('anios');

Route::post('/anios', [AniosController::class, 'store'])->name('anios');

Route::get('/anios/{id}', [AniosController::class, 'show'])->name('anios-edit');
Route::patch('/anios/{id}', [AniosController::class, 'update'])->name('anios-update');
Route::delete('/anios{id}', [AniosController::class, 'destroy'])->name('anios-destroy');

//FIN AÑOS//

//INICIO UNIDAD CURRICULAR//

Route::resource('unidadcurricular', UnidadCurricularController::class);

//FIN UNIDAD CURRICULAR//

// INICIO USERS //

Route::get('/users', function () {
    return view('users.register');
})->name('users');

Route::get('/users', [UserController::class, 'index'])->name('users');

Route::post('/users', [UserController::class, 'store'])->name('users');

Route::get('/users/{id}', [UserController::class, 'show'])->name('users-edit');
Route::patch('/users/{id}', [UserController::class, 'update'])->name('users-update');
Route::delete('/users{id}', [UserController::class, 'destroy'])->name('users-destroy');

// FIN USERS // 
