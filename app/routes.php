<?php
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\GraphObject;
use Facebook\GraphUser;
use Facebook\GraphLocation;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphSessionInfo;
session_start();
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

//filtro rutas
Entrust::routeNeedsRole('ListaOpex', 'administracion', Redirect::to('/'));
Entrust::routeNeedsRole('ListaCapex', 'administracion', Redirect::to('/'));

Route::get("/", function()
{
    return Redirect::to('/indexcma');
});

/************ RUTA CMA ***************/

//INDEX
Route::get('/indexcma','UsuarioController@IndexCMA');
Route::get('/IndexAlumno','UsuarioController@IndexAlumno');


//USUARIOS
Route::any('usuarios/edit', 'UsuarioController@CrudUsuarios');
Route::get('/LoginUsuario','UsuarioController@LoginUsuarioGet');
Route::get('/CerrarSesion','UsuarioController@CerrarSesionGet');
Route::get('/ListaUsuarios','UsuarioController@ListaUsuarios');
Route::get('/HorarioUsuario/{usuario_id}','UsuarioController@HorarioUsuarioGet');
Route::get('/GuardaHorario','UsuarioController@GuardaHorarioUsuarioGet');
Route::get('/BorrarHorario','UsuarioController@BorrarHorarioGet');
Route::get('/ListaAlumnoExamenes/{user_id}','UsuarioController@ListaAlumnoExamenesGet');
Route::get('/AgregarExamenAlumno/{id_examen}/{id_usuario}','UsuarioController@AgregarExamenAlumnoGet');
Route::get('/QuitarExamenAlumno/{id_examen}/{id_usuario}','UsuarioController@QuitarExamenAlumnoGet');
Route::get('/AsignaRol/{id}','UsuarioController@AsignarRolGet');
Route::post('/AsignaRol','UsuarioController@AsignarRolPost');
Route::get('/CrearRoles','UsuarioController@CrearRoles');



//PLANES
Route::get('/ListaPlanes','UsuarioController@ListaPlanes');
Route::any('plan/edit','UsuarioController@CrudPlan');



//EXAMENES
Route::get('/ListaExamenes','ExamenesController@ListaExamenes');
Route::any('examenes/edit','ExamenesController@CrudExamen');
Route::get('/AgregarPregunta/{examen_id}','ExamenesController@AgregarPreguntaGet');
Route::get('/ExamenUsuarios','ExamenesController@ExamenUsuariosGet');
Route::get('/AgregarPreguntaExamen/{id_examen}/{id_pregunta}','ExamenesController@AgregarPreguntaExamenGet');
Route::get('/QuitarPreguntaExamen/{id_examen}/{id_pregunta}','ExamenesController@QuitarPreguntaExamenGet');
Route::get('/ListaExamenAlumnos/{id_examen}','ExamenesController@ListaExamenAlumnosGet');
Route::get('/RealizarExamen/{id_user}/{id_examen}','ExamenesController@RealizarExamenGet');



//PREGUNTAS
Route::get('/ListaPreguntas','ExamenesController@ListaPreguntas');
Route::any('/preguntas/edit','ExamenesController@CrudPreguntas');
Route::post('/CrearPregunta','ExamenesController@CrearPreguntaPost');
Route::get('/BorrarPregunta','ExamenesController@BorrarPreguntaGet');
Route::get('/AgregarRespuesta/{pregunta_id}','ExamenesController@EditarPreguntaGet');
Route::post('/EditarPregunta','ExamenesController@EditarPreguntaPost');


//OPEX
Route::get('/ListaOpex', 'OpexController@ListaOpex');
Route::any('/opex/edit', 'OpexController@CrudOpex');
Route::get('/ListaCatOpex', 'OpexController@ListaCatOpex');
Route::any('/catopex/edit', 'OpexController@CrudCatOpex');

//CAPEX
Route::get('/ListaCapex', 'CapexController@ListaCapex');
Route::any('/capex/edit', 'CapexController@CrudCapex');
Route::get('/ListaCatCapex', 'CapexController@ListaCatCapex');
Route::any('/catcapex/edit', 'CapexController@CrudCatCapex');















/************ FIN RUTA CMA ***************/












/************ RUTA DE CACHEI ***************/


//USUARIOS








/***** FIN RUTA CEACHEI *******/






