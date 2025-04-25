<?php

use App\Http\Controllers\CitasController;
use App\Http\Controllers\ConsultaCitaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ApiController;

use App\Http\Controllers\MenuController;
use App\Http\Controllers\NavigationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistroController;




Route::get('/', HomeController::class)->name('home');


//NAVEGACION HOME PAGE---------------------------------------------------------------------------------------
Route::get('nosotros',[NavigationController::class,'nosotros' ])->name('nosotros');
Route::get('cita', [NavigationController::class, 'cita'])->name('cita');
Route::get('cita/consulta',[NavigationController::class,'consulta' ])->name('consulta.dni');
Route::post('/buscar-cita', [ConsultaCitaController::class, 'buscarCita'])->name('buscar.cita');


Route::get('especialidades1',[NavigationController::class,'especialidades' ])->name('especialidades');
Route::get('noticias',[NavigationController::class,'noticias' ])->name('noticias');
Route::get('noticias/{id}',[NavigationController::class, 'show' ])->name( 'mostrarNoticia');
Route::post('/noticia/{id}/like', [NavigationController::class, 'like'])->name('noticia.like');
Route::post('/noticia/{id}/compartir', [NavigationController::class, 'compartir'])->name('noticia.compartir');
Route::post('/noticia/{id}/comentar', [NavigationController::class, 'comentar'])->name('noticia.comentar');
Route::post('/comentario/{id}/like', [NavigationController::class, 'likeComentario'])->name('comentario.like');



Route::get('/filtrar-noticias', [NavigationController::class, 'filtrarNoticias'])->name('filtrarNoticias');
Route::get('contactanos',[NavigationController::class,'contactanos' ])->name('contactanos');


//CitaApp
Route::get('cita/login', [LoginController::class,'login'])->name('login');
Route::post('/registro', [RegistroController::class, 'guardar'])->name('registro');

// En routes/web.php
Route::post('/api/consulta-dni', [ApiController::class, 'consultaDNI'])->name('api.consulta.dni');
Route::post('/verificar', [LoginController::class, 'verificacion'])->name('verificar');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

//-----------------------------------------------------------------------------------------------------------


// routes/web.php
Route::post('/reservar', [CitasController::class, 'store'])->name('cita.store');

Route::get('/mis-citas', [CitasController::class, 'obtenerCitasUsuario'])->middleware('auth')->name('citas.usuario');

Route::post('/cancelar-cita', [CitasController::class, 'cancelarCita'])->name('cancelar.cita');

Route::get('/citas/estado/{id}', [CitasController::class, 'verificarEstado'])->name('cita.estado');



//-----------------------------------------------------------------------------------------------------------
Route::post('/registro', [RegistroController::class, 'guardar'])->name('registro');
Route::get('registro', [RegistroController::class, 'mostrarFormulario'])->name('registro');
Route::get('obtener-provincias', [RegistroController::class, 'obtenerProvincias'])->name('obtener-provincias');
Route::get('/obtener-distritos', [RegistroController::class, 'obtenerDistritos'])->name('obtener-distritos');

//MENU
Route::get('/menu', [MenuController::class, 'menu'])->middleware('auth')->name('menu');
Route::get('/especialidades', [CitasController::class, 'obtenerEspecialidades'])->name('obtener-especialidades');
Route::get('/doctores', [CitasController::class, 'obtenerDoctoresPorEspecialidad'])->name('doctores.especialidad');
Route::get('/horarios', [CitasController::class, 'obtenerHorarios'])->name('horarios');






