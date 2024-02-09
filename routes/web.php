<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TurnosController;
use App\Http\Controllers\CarrerasController;
use App\Http\Controllers\AniosController;
use App\Http\Controllers\UnidadCurricularController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\MesaexamenController;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\UsercarrerasController;
use App\Http\Controllers\UinscriptionController;
use App\Http\Controllers\AinscriptionController;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    return view('welcome');
});


// Miiddleware //
Auth::routes();


Route::group(['middleware' => 'auth'], function () {
Route::get('/dashboard', function () {
    return view('dashboard');
});
  

Route::group(['middleware' => ['auth', 'admin']], function () {
Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
Route::resource('roles', RolController::class);


// Para Abajo Rutas Protegidas // 


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
Route::get('/unidadcurricular/lista', [UnidadCurricularController::class, 'showLista'])->name('unidadcurricular.lista');
Route::get('/unidadcurricular/{unidadcurricular}/edit', [UnidadCurricularController::class, 'edit'])->name('unidadcurricular.edit');
//FIN UNIDAD CURRICULAR//

    
//Mesa de Examenes //
Route::resource('mesaexamens', MesaexamenController::class);
Route::get('/mesaexamens/lista', [MesaexamenController::class, 'showLista'])->name('mesaexamens.lista');
Route::patch('/mesaexamens/{mesaexamens}')->name('mesaexamens.update');
Route::post('/get-unidades-curriculares', [MesaexamenController::class, 'getUnidadesCurriculares']);
Route::post('/mesaexamens/filter2', [MesaexamenController::class, 'filter2'])->name('mesaexamens.filter2');



//Fin Mesa de Examenes //


// Inicio Docentes
Route::get('/docentes', function () {
    return view('docentes.index');
})->name('docentes');
Route::get('/docentes', [DocenteController::class, 'index'])->name('docentes');
Route::post('/docentes', [DocenteController::class, 'store'])->name('docentes');
Route::get('/docentes/{id}', [DocenteController::class, 'show'])->name('docentes-show');
Route::get('/docentes/{id}/edit', [DocenteController::class, 'edit'])->name('docentes-edit');
Route::put('/docentes/{id}', [DocenteController::class, 'update'])->name('docentes-update');
Route::delete('/docentes/{id}', [DocenteController::class, 'destroy'])->name('docentes-destroy');
// Fin Docentes 


// Inicio Uinscription //
Route::get('/ainscription', [AinscriptionController::class, 'index'])->name('ainscription.index');
Route::post('/ainscription/filtrar', [AinscriptionController::class, 'filtrarCarreras'])->name('filtrarCarreras');
Route::get('/ainscription/lista', [AinscriptionController::class, 'showForm'])->name('showForm');
// Fin Uinscription //


}); // ↑ aqui arriba para rutas admin















// Rutas para Filtrar la mesa de Examen //

Route::get('/lista', [UinscriptionController::class, 'lista'])->name('lista');

// Ruta para el primer filtro
Route::post('/ver-mesas', [UinscriptionController::class, 'showMesas'])->name('ver_mesas');

Route::get('/unidades-curriculares', [UinscriptionController::class, 'showUnidadesCurriculares'])->name('unidades_curriculares');
Route::get('/unidades-curriculares/filter', [UinscriptionController::class, 'filterUnidadesCurriculares'])->name('unidades-curriculares.filter');

Route::post('/unidades-curriculares', [UinscriptionController::class, 'showUnidadesCurriculares'])->name('unidades_curriculares');





// Rutas para inscripción a mesas de examen
Route::get('/uinscription/{mesaexamen_id}', [UinscriptionController::class, 'index'])->name('uinscription.index');
Route::post('/uinscription', [UinscriptionController::class, 'store'])->name('uinscription.store');
Route::get('/uinscription/{id}', [UinscriptionController::class, 'show'])->name('uinscription.show');
Route::patch('/uinscription/{id}', [UinscriptionController::class, 'update'])->name('uinscription.update');
Route::delete('/uinscription/{id}/{mesaexamen_id}', [UinscriptionController::class, 'destroy'])->name('uinscription.destroy');



//VISTAS USUARIOS NO ADMINISTRADORES
Route::get('/home', [HomeController::class, 'index'])->name('home');


// Ruta para ver términos y condiciones
Route::get('/terminos', function () {
    return view('terminos');

});


// Ruta para la vista "infofechas"
Route::get('/infofechas', function () {
    return view('infofechas');
});


// Ruta para mostrar la lista de usuarios
Route::resource('usuarios', UsuarioController::class);


// Ruta para usercarreras
Route::resource('usercarreras', UsercarrerasController::class);

    
});