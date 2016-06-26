<?php
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
//Entrust::routeNeedsRole('ListaOpex', 'superadmin', Redirect::to('/'));
//Entrust::routeNeedsRole('ListaCapex', 'superadmin', Redirect::to('/'));

//LOGIN
Route::get('/login','UsuarioController@getLogin');
Route::get('/','UsuarioController@getLogin');
Route::post('/','UsuarioController@postLogin');

/************ RUTA CMA ***************/

//INDEX
Route::group(array('before' => 'auth'), function()
{
    Route::group(array('prefix' => 'admin'), function(){
        Route::get('/home','UsuarioController@Home');

        Route::get('/IndexAlumno','UsuarioController@IndexAlumno');
        //logout
        Route::get('/auth/logout','UsuarioController@CerrarSesionGet');

        //OPEX
        Route::get('/opex/lista', 'OpexController@ListaOpex');
        Route::any('/opex/edit', 'OpexController@CrudOpex');
        Route::get('/catopex/lista', 'OpexController@ListaCatOpex');
        Route::any('/catopex/edit', 'OpexController@CrudCatOpex');

        //CAPEX
        Route::get('/capex/lista', 'CapexController@ListaCapex');
        Route::any('/capex/edit', 'CapexController@CrudCapex');
        Route::get('/catcapex/lista', 'CapexController@ListaCatCapex');
        Route::any('/catcapex/edit', 'CapexController@CrudCatCapex');

        //GASTOS ACMA
        Route::get('/gastos/lista', 'GastosController@ListaGastosAcma');
        Route::any('/gastos/edit', 'GastosController@CrudGastosAcma');

        //INGRESOS ACMA
        Route::get('/ingresos/lista', 'IngresosController@ListaIngresosAcma');
        Route::any('/ingresos/edit', 'IngresosController@CrudIngresosAcma');

        //INFO FINANCIERO
        Route::get('/infofinanciero', 'InfoFinancieroController@ListaInfoFinanciero');
        Route::any('/infofinanciero/edit', 'InfoFinancieroController@CrudInfoFinanciero');

        //MATRICULAS
        Route::get('/matriculas/lista/{incompleta?}','MatriculaController@ListaMatricula');
        Route::any('/matriculas/edit', 'MatriculaController@CrudMatricula');

        //HORARIOS
        Route::get('/HorarioUsuario/{usuario_id}','UsuarioController@HorarioUsuarioGet');
        Route::get('/GuardaHorario','UsuarioController@GuardaHorarioUsuarioGet');
        Route::get('/BorrarHorario','UsuarioController@BorrarHorarioGet');
        Route::get('/AllHorario','UsuarioController@AllHorario');

        //LABORES
        Route::get('/labores/usuario/{id}','LaboresController@ListaLaboresUser');
        Route::get('/labores/lista','LaboresController@ListaLabores');
        Route::any('/labores/edit', 'LaboresController@CrudLabores');

        //PLANES
        Route::get('/planes','PlanesController@ListaPlanes');
        Route::any('planes/edit','PlanesController@CrudPlan');

        //EXAMENES
        Route::get('/ListaExamenes','ExamenesController@ListaExamenes');
        Route::any('examenes/edit','ExamenesController@CrudExamen');
        Route::get('/AgregarPregunta/{examen_id}','ExamenesController@AgregarPreguntaGet');
        Route::get('/ExamenUsuarios','ExamenesController@ExamenUsuariosGet');
        Route::get('/AgregarPreguntaExamen/{id_examen}/{id_pregunta}','ExamenesController@AgregarPreguntaExamenGet');
        Route::get('/QuitarPreguntaExamen/{id_examen}/{id_pregunta}','ExamenesController@QuitarPreguntaExamenGet');
        Route::get('/ListaExamenAlumnos/{id_examen}','ExamenesController@ListaExamenAlumnosGet');
        Route::get('/RealizarExamen/{id_user}/{id_examen}','ExamenesController@RealizarExamenGet');

        //EVALUACIONES
        Route::get('/ListaEvaluaciones','ExamenesController@ListaEvaluaciones');
        Route::get('/MisNotas','ExamenesController@MisNotas');
        Route::get('/MisHorarios','UsuarioController@MisHorarios');
        Route::any('/evaluaciones/edit','ExamenesController@CrudEvaluaciones');


        //CLASES
        Route::get('/misClases','ClasesController@MisClases');
        Route::get('/clases/{usuario_id}','ClasesController@ListaClasesUsuario');
        Route::any('clases/{usuario_id}/edit', 'ClasesController@CrudClases');
        Route::get('/searchinstructor', 'ClasesController@getInstructorList');


        //PREGUNTAS
        Route::get('/ListaPreguntas','ExamenesController@ListaPreguntas');
        Route::any('/preguntas/edit','ExamenesController@CrudPreguntas');
        Route::post('/CrearPregunta','ExamenesController@CrearPreguntaPost');
        Route::get('/BorrarPregunta','ExamenesController@BorrarPreguntaGet');
        Route::get('/AgregarRespuesta/{pregunta_id}','ExamenesController@EditarPreguntaGet');
        Route::post('/EditarPregunta','ExamenesController@EditarPreguntaPost');

        //ALUMNOS
        Route::get('/alumnos/lista/{activo?}','AlumnosController@ListarAlumnos');
        Route::get('/alumnos/crear', 'AlumnosController@GetCrearAlumnos');
        Route::post('/alumnos/crear', 'AlumnosController@PostCrearAlumnos');
        Route::any('/alumnos/crud', 'AlumnosController@CrudAlumnos');

        //INSTRUCTORES
        Route::get('/instructores/lista','InstructoresController@ListarInstructores');
        Route::get('/instructores/crear', 'InstructoresController@GetCrearInstructor');
        Route::post('/instructores/crear', 'InstructoresController@PostCrearInsctructor');
        Route::any('/instructores/crud', 'InstructoresController@CrudInstructor');

        //ADMINISTRACIÓN
        Route::get('/administracion/lista','AdministracionController@ListarAdministracion');
        Route::get('/administracion/crear', 'AdministracionController@GetCrearAdministracion');
        Route::post('/admnistracion/crear', 'AdministracionController@PostCrearAdministracion');
        Route::any('/administracion/crud', 'AdministracionController@CrudAdministracion');

        //USUARIOS
        Route::get('/ListaUsuarios/{filtro?}','UsuarioController@ListaUsuarios');
        Route::any('usuarios/edit', 'UsuarioController@CrudUsuarios');
        Route::get('/LoginUsuario','UsuarioController@LoginUsuarioGet');
        Route::get('/LoginUsuario','UsuarioController@LoginUsuarioGet');
        Route::get('/ListaAdministracion','UsuarioController@ListaAdministracion');
        Route::get('/ListaIntructores','UsuarioController@ListaIntructores');

        Route::get('/ListaAlumnoExamenes/{user_id}','UsuarioController@ListaAlumnoExamenesGet');
        Route::get('/AgregarExamenAlumno/{id_examen}/{id_usuario}','UsuarioController@AgregarExamenAlumnoGet');
        Route::get('/QuitarExamenAlumno/{id_examen}/{id_usuario}','UsuarioController@QuitarExamenAlumnoGet');
        Route::get('/asignarol/{id}','UsuarioController@AsignarRolGet');
        Route::post('/asignarol','UsuarioController@AsignarRolPost');
        Route::get('/CrearRoles','UsuarioController@CrearRoles');
        Route::get('/searchuser', 'UsuarioController@getUsuarioList');
    });
});




