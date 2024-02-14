<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ModeratorController;
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
use App\Http\Controllers\ModeradorController;
use App\Http\Controllers\ModinscriptionsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;
use Barryvdh\DomPDF\Facade\Pdf as PDF;



Route::get('/', function () {
    return view('welcome');
});


// Miiddleware //
Auth::routes(['verify' => true]);

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/home', function () {
        return view('home');
});
  

Route::group(['middleware' => 'admin'], function () {
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
Route::get('/unidadcurricular/lista', [UnidadCurricularController::class, 'filter'])->name('unidadcurricular.filter');
Route::get('/unidadcurricular/{unidadcurricular}/edit', [UnidadCurricularController::class, 'edit'])->name('unidadcurricular.edit');
Route::delete('/unidadcurricular/{unidadcurricular}/destroy', [UnidadCurricularController::class, 'destroy'])->name('unidadcurricular.destroy');

//Exportar Lista de Inscripciones a Excel //
Route::get('/exportar-excel-unidadcurricular', [UnidadCurricularController::class, 'exportarExcel'])->name('exportar-excel-unidadcurricular');
//Exportar Lista de Inscripciones a Excel //


//FIN UNIDAD CURRICULAR//

    
//Mesa de Examenes //
Route::resource('mesaexamens', MesaexamenController::class);
Route::get('/mesaexamens/lista', [MesaexamenController::class, 'showLista'])->name('mesaexamens.lista');
Route::patch('/mesaexamens/{mesaexamens}')->name('mesaexamens.update');
Route::post('/get-unidades-curriculares', [MesaexamenController::class, 'getUnidadesCurriculares']);
Route::post('/mesaexamens/filter2', [MesaexamenController::class, 'filter2'])->name('mesaexamens.filter2');

// RUTA PARA EXPORTAR A EXCEL
Route::get('/exportar-excel-mesaexamens', [MesaexamenController::class,'exportarExcel'])->name('exportar-excel-mesaexamens');
//


//Fin Mesa de Examenes //


// Inicio Docentes
Route::get('/docentes', [DocenteController::class, 'index'])->name('docentes');
Route::post('/docentes', [DocenteController::class, 'store'])->name('docentes');
Route::get('/docentes/{id}', [DocenteController::class, 'show'])->name('docentes-show');
Route::get('/docentes/{id}/edit', [DocenteController::class, 'edit'])->name('docentes-edit');
Route::put('/docentes/{id}', [DocenteController::class, 'update'])->name('docentes-update');
Route::delete('/docentes/{id}', [DocenteController::class, 'destroy'])->name('docentes-destroy');

// Ruta para Exportar a Excel
Route::get('/exportar-excel-docentes', [DocenteController::class,'exportarExcel'])->name('exportar-excel-docentes');
//


// Fin Docentes 


// Inicio Ainscription //
Route::get('/ainscription', [AinscriptionController::class, 'index'])->name('ainscription.index');
Route::post('/ainscription/filtrar', [AinscriptionController::class, 'filtrarCarreras'])->name('filtrarCarreras');
Route::get('/ainscription/lista', [AinscriptionController::class, 'showForm'])->name('showForm');

//Exportar Lista de Inscripciones a Excel //
Route::get('/exportar-excel', [AinscriptionController::class, 'exportarExcel'])->name('exportar-excel');
//Exportar Lista de Inscripciones a Excel //



// Fin Ainscription //

}); // ↑ aqui arriba para rutas admin





//VISTAS USUARIOS NO ADMINISTRADORES
Route::get('/home', [HomeController::class, 'index'])->name('home');


// Rutas para Filtrar la mesa de Examen //
Route::get('/lista', [UinscriptionController::class, 'lista'])->name('lista');
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

//Exportar Comprobante PDF //

Route::get('/uinscription/{id}/pdf', [UinscriptionController::class,'generatePdf'])->name('uinscription.generatePdf');
//

// Ruta para ver términos y condiciones
Route::get('/terminos', function () {
    return view('terminos');
});


// Ruta para la vista "infofechas"
Route::get('/infofechas', function () {
    return view('infofechas');
});


// Ruta de Usuarios
Route::resource('usuarios', UsuarioController::class);


// Ruta Para Administrar La Carrera
Route::resource('usercarreras', UsercarrerasController::class);








// // Rutas Para Moderador
Route::group(['middleware' => 'auth'], function () {
Route::group(['middleware' => 'moderator'], function () {


Route::post('/moderator/filter3', [ModeradorController::class, 'filter3'])->name('moderator.filter3');
Route::get('moderator/filtro', [ModeradorController::class, 'filter3'])->name('filtro');


Route::get('/modinscriptions', [ModinscriptionsController::class, 'index'])->name('modinscriptions.index');
Route::post('/modinscriptions/filtrar', [ModinscriptionsController::class, 'filtrarCarreras4'])->name('filtrarCarreras4');
Route::get('/modinscriptions/lista', [ModinscriptionsController::class, 'showForm4'])->name('showForm4');
    
});
});
});