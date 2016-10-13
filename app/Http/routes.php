<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/', 'HomeController@index');
//Route::get('/', 'WelcomeController@index');
Route::get('mail', 'WelcomeController@mail');
Route::get('admin2', 'WelcomeController@admin');
Route::get('home', 'HomeController@index');
Route::get('acceso', 'accesoController@index');
Route::get('ciclos', 'grupos\grupoController@findSemestres');
Route::get('modulos', 'grupos\grupoCetproController@findSemestres');
Route::get('grupos', 'grupos\grupoController@getGrupos');
Route::get('moduloscetpro', 'Planestudios\semestreController@getModulosCetpro');
Route::get('gruposcetpro', 'grupos\grupoCetproController@getGruposCetpro');
Route::get('grupocursos', 'grupos\grupoController@getCursos');
Route::get('listalumnos', 'Alumnos\AlumnosController@getAlumnos');
Route::get('generarPDF/{id}', 'Alumnos\AlumnosController@getPDF');
Route::get('unidad1PDF/{id}', 'Notas\notasController@getPDF1unidad');
Route::get('unidad2PDF/{id}', 'Notas\notasController@getPDF2unidad');
Route::get('unidad3PDF/{id}', 'Notas\notasController@getPDF3unidad');
Route::get('verificarAlumno', 'Matriculas\matriculasCetproController@verificarAlumno');
Route::get('GuardarNotas', 'Notas\notasController@updateNotas');
Route::get('GuardarNotasCETPRO', 'Notas\notasCetproController@updateNotasCETPRO');
Route::get('NotasReportesCETPRO', 'Reportes\reportesCetproController@showNotasCetpro');
Route::get('getCursos', 'Alumnos\RegistrosAntiguosOP2Controller@getCursos');
Route::get('asistenciaStore', 'Asistencia\asistenciaCetproController@store');
Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
Route::resource('sendmail', 'Mail\mailController');
Route::group(['prefix'=>'alu','namespace'=>'Alumnos'], function(){
	Route::resource('alumnos','AlumnosController');
	Route::resource('reportes', 'reportesNotasController');
	Route::resource('reportesOperacion', 'reportesNotasOperacionController');
	Route::resource('reportesSeguridad', 'reportesNotasSeguridadController');
	Route::resource('notasAntiguas', 'vaciarRegistrosController');	
        Route::resource('notasAntiguasOP2', 'RegistrosAntiguosOP2Controller');
});
Route::group(['prefix'=>'planestudio','namespace'=>'Planestudios'], function(){
	Route::resource('carrera','CarreraController');
	Route::resource('curso','CursoController');
	Route::resource('semestre','SemestreController');
	Route::resource('cursosemestre','CursosemestreController');
});
Route::group(['prefix'=>'generalgrupo','namespace'=>'grupos'], function(){
	Route::resource('grupo','grupoController');
	Route::resource('detallegrupo', 'detallegrupoController');
	Route::resource('grupocetpro', 'grupoCetproController');
	Route::resource('accionesGrupoCetpro', 'accionesGrupoCetproController');
	Route::resource('accionesGrupo', 'accionesGrupoController');
	Route::resource('accionesAdicionales', 'accionesCetproController');
});
Route::group(['prefix'=>'institutomatricula','namespace'=>'Matriculas'], function(){
	Route::resource('matricula','matriculaController');
});
Route::group(['prefix'=>'cetpromatricula','namespace'=>'Matriculas'], function(){
	Route::resource('matriculacetpro','matriculasCetproController');
	Route::resource('inscripcioncetpro','inscripcionesCetproController');
	Route::resource('inscripciones','inscripcionesController');
    Route::resource('modificarGrupo','modificarMatriculaCetproController');
});
Route::group(['prefix'=>'usuarios', 'namespace'=>'Notas'], function(){
	Route::resource('calificaciones', 'notasController');
	Route::resource('calificacionescetpro', 'notasCetproController');
        Route::resource('asistenciacetpro', 'asistenciaCetproController');
	Route::resource('calificacionescetpro2', 'notasCetpro2Controller');
});
Route::group(['prefix'=>'asistencia', 'namespace'=>'Asistencia'], function(){//nuevo
	Route::resource('asistenciacetpro', 'asistenciaCetproController');
});
Route::group(['prefix'=>'admin','namespace'=>'Usuarios'], function(){
	Route::resource('usuarios','usuarioController');
	Route::resource('usuariosAcciones','userAccionesController');
});
Route::group(['prefix'=>'reportes', 'namespace'=>'Reportes'], function()
{
	Route::resource('alumnosCetpro', 'reportesCetproController');
});
//Route::controller('alumnos','Alumnos\AlumnosController');
Route::group(['prefix'=>'pagos', 'namespace'=>'Pagos'], function()
{
	Route::resource('pensiones', 'pagosController');
});
