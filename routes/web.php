<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/logout', 'Auth\LoginController@logout');




Route::group(['middleware' => ['auth']], function(){

    Route::get('Cargues','CargueController@index');
    Route::get('CarguesOperacion','CargueController@indexA1');
    Route::get('RegistrarCargue','CargueController@create');
    Route::resource('Cargue', 'CargueController');
    Route::get('Cargue/destroy/{id}',['as'=> 'Cargue/destroy','uses'=> 'CargueController@destroy']);
    Route::post('Cargue/actualizarCargue', ['as' => 'Cargue/actualizarCargue', 'uses' => 'CargueController@actualizarCargue']);
    Route::get('Cargue/edit/{id}', ['uses' => 'Cargue@edit','as' => 'Cargue.edit']);
    Route::post('Cargue/store', ['as' => 'Cargue/store', 'uses' => 'CargueController@store']);

    Route::get('ProcesosDiarios', 'ProcesoController@index');
    Route::get('ProcesosMensuales', 'ProcesoController@indexMensual');
    Route::get('ProcesosSemanales', 'ProcesoController@indexSemanal');
    Route::get('ProcesosPorDemanda', 'ProcesoController@indexDemanda');
    Route::get('RegistrarProceso', 'ProcesoController@create');
    Route::resource('Proceso', 'ProcesoController');
    Route::get('Proceso/destroy/{id}',['as'=> 'Proceso/destroy','uses'=> 'ProcesoController@destroy']);
    Route::post('Proceso/search',['as' => 'Proceso/search', 'uses' => 'ProcesoController@search']);
    Route::post('Proceso/buscarGrupos',['as' => 'Proceso/buscarGrupos','uses' => 'ProcesoController@buscarGrupoPais']);
    Route::post('Proceso/actualizarP', ['as' => 'Proceso/actualizarP', 'uses' => 'ProcesoController@actualizarProceso']);
    Route::post('Proceso/buscarInformacion',['as' => 'Proceso/buscarInformacion','uses' => 'ProcesoController@buscarInformacion']);

    Route::post('Proceso/actualizarResponsable', ['as' => 'Proceso/actualizarResponsable', 'uses' => 'ProcesoController@actualizarResponsable']);
    Route::get('Proceso/edit/{id}', ['uses' => 'Proceso@edit','as' => 'Proceso.edit']);
    Route::post('Proceso/store', ['as' => 'Proceso/store', 'uses' => 'ProcesoController@store']);

    Route::get('Entregables', 'EntregableController@index');
    Route::resource('Entregable', 'EntregableController');
    Route::get('Entregable/destroy/{id}',['as'=> 'Entregable/destroy','uses'=> 'EntregableController@destroy']);
    Route::get('Entregable/NewEntregable', 'EntregableController@create');
    Route::post('Entregable/editFalla',['uses' => 'EntregableController@editFalla']);
    Route::post('Entregable/actualizarEstado', ['uses' => 'EntregableController@actualizarEstado']);

    Route::get('MinutogramaDiario', 'MinutogramaController@index');
    Route::get('MinutogramaSemanal', 'MinutogramaController@indexSemanal');
    Route::get('MinutogramaMensual', 'MinutogramaController@indexMensual');
    Route::get('MinutogramaDemanda', 'MinutogramaController@indexDemanda');
    Route::get('MinutogramaOficina', 'MinutogramaController@indexOficina');
    Route::resource('Minutograma', 'MinutogramaController');
    Route::get('Minutograma/destroy/{id}',['as'=> 'Minutograma/destroy','uses'=> 'MinutogramaController@destroy']);
    Route::post('Minutograma/search',['as' => 'Minutograma/search', 'uses' => 'MinutogramaController@search']);
    Route::post('Minutograma/registrarEjecucion',['as' => 'Minutograma/registrarEjecucion','uses' => 'MinutogramaController@registrarEjecucion']);
    Route::post('Minutograma/registrarEntrega',['uses' => 'MinutogramaController@registrarEntrega']);
    Route::post('Minutograma/registrarSLA',['uses' => 'MinutogramaController@storeSLA']);
    Route::post('Minutograma/store', ['as' => 'Minutograma/store', 'uses' => 'MinutogramaController@store']);
    Route::post('/editEntrega',['as' => '/editEntrega', 'uses' => 'MinutogramaController@editEntrega']);

    Route::get('FallasDiarias', 'FallaController@index');
    Route::get('FallasMensuales', 'FallaController@indexMensual');
    Route::resource('Falla', 'FallaController');
    Route::get('Falla/destroy/{id}',['as'=> 'Falla/destroy','uses'=> 'FallaController@destroy']);
    Route::post('Falla/search',['as' => 'Falla/search', 'uses' => 'FallaController@search']);
    Route::post('Falla/store', ['as' => 'Falla/store', 'uses' => 'FallaController@store']);
    Route::post('Falla/actualizarEstado', ['uses' => 'FallaController@actualizarEstado']);
    Route::post('Falla/editFalla',['uses' => 'FallaController@editFalla']);

    Route::get("SLAS", 'SLAController@index');
    Route::resource('SLA', 'SLAController');
    Route::get('SLA/destroy/{id}',['as'=> 'SLA/destroy','uses'=> 'SLAController@destroy']);
    Route::post('SLA/search',['as' => 'SLA/search', 'uses' => 'SLAController@search']);
    Route::post('SLA/store', ['as' => 'SLA/store', 'uses' => 'SLAController@store']);
    Route::post('SLA/actualizarSLA', ['as' => 'SLA/actualizarSLA', 'uses' => 'SLAController@actualizarSLA']);

    Route::get('Frecuencias', 'FrecuenciaController@index');
    Route::resource('Frecuencia','FrecuenciaController');
    Route::get('Frecuencia/destroy/{id}',['as'=> 'Frecuencia/destroy','uses'=> 'FrecuenciaController@destroy']);
    Route::post('Frecuencia/search',['as' => 'Frecuencia/search', 'uses' => 'FrecuenciaController@search']);
    Route::get('Frecuencia/edit/{id}', ['uses' => 'FrecuenciaController@edit','as' => 'Frecuencia.edit']);

    Route::get('Grupos', 'GrupoController@index');
    Route::resource('Grupo','GrupoController');
    Route::get('Grupo/destroy/{id}',['as'=> 'Grupo/destroy','uses'=> 'GrupoController@destroy']);
    Route::post('Grupo/search',['as' => 'Grupo/search', 'uses' => 'GrupoController@search']);
    Route::get('Grupo/edit/{id}', ['uses' => 'GrupoController@edit','as' => 'Grupo.edit']);

    Route::get('Paises', 'PaisController@index');
    Route::resource('Pais','PaisController');
    Route::get('Pais/destroy/{id}',['as'=> 'Pais/destroy','uses'=> 'PaisController@destroy']);
    Route::post('Pais/search',['as' => 'Pais/search', 'uses' => 'PaisController@search']);
    Route::get('Pais/edit/{id}', ['uses' => 'PaisController@edit','as' => 'Pais.edit']);

    Route::get('Responsables', 'UsuarioController@index');
    Route::resource('Usuario','UsuarioController');
    Route::get('Usuario/destroy/{id}',['as'=> 'Usuario/destroy','uses'=> 'UsuarioController@destroy']);
    Route::post('Usuario/search',['as' => 'Usuario/search', 'uses' => 'UsuarioController@search']);
    Route::get('Usuario/edit/{id}', ['uses' => 'Usuario@edit','as' => 'Usuario.edit']);
    Route::post('Usuario/actualizarUsuario', ['as' => 'Usuario/actualizarUsuario', 'uses' => 'UsuarioController@actualizarUsuario']);

    Route::resource('Semaforo','SemaforoController');
    Route::get('Semaforo/destroy/{id}',['as'=> 'Semaforo/destroy','uses'=> 'SemaforoController@destroy']);
    Route::post('Semaforo/search',['as' => 'Semaforo/search', 'uses' => 'SemaforoController@search']);
    Route::get('Semaforo/edit/{id}', ['uses' => 'Semaforo@edit','as' => 'Semaforo.edit']);

    Route::get('Turnos','TurnoController@index');
    Route::resource('Turno','TurnoController');
    Route::get('Turno/destroy/{id}',['as'=> 'Turno/destroy','uses'=> 'TurnoController@destroy']);
    Route::post('Turno/search',['as' => 'Turno/search', 'uses' => 'TurnoController@search']);
    Route::get('Turno/edit/{id}', ['uses' => 'Turno@edit','as' => 'Turnos.edit']);
    Route::post('Turno/actualizarTurno', ['as' => 'Turno/actualizarTurno', 'uses' => 'TurnoController@actualizarTurno']);
    Route::post('Turno/store', ['as' => 'Turno/store', 'uses' => 'TurnoController@store']);

    Route::get('Tipos','TipoController@index');
    Route::resource('Tipo','TipoController');
    Route::get('Tipo/destroy/{id}',['as'=> 'Tipo/destroy','uses'=> 'TipoController@destroy']);
    Route::post('Tipo/search',['as' => 'Tipo/search', 'uses' => 'TipoController@search']);
    Route::get('Tipo/edit/{id}', ['uses' => 'TipoController@edit','as' => 'Tipo.edit']);

    Route::get('ProcesosEntregadosDiarios',['as'=> 'ProcesosEntregadosDiarios','uses'=> 'ReporteController@indexDiarios']);
    Route::get('ProcesosEntregadosGeneral',['as'=> 'ProcesosEntregadosGeneral','uses'=> 'ReporteController@index']);

    Route::resource('Reportes','ReporteController');
    Route::get('Reportes/destroy/{id}',['as'=> 'Reportes/destroy','uses'=> 'ReporteController@destroy']);
    Route::post('Reportes/search',['as' => 'Reportes/search', 'uses' => 'ReporteController@search']);
    Route::post('Reportes/searchGeneral',['as' => 'Reportes/searchGeneral', 'uses' => 'ReporteController@searchGeneral']);
    Route::post('Reportes/searchDiario',['as' => 'Reportes/searchDiario', 'uses' => 'ReporteController@filtroDiarios']);
    Route::get('Reportes/edit/{id}', ['uses' => 'ReporteController@edit','as' => 'Reportes.edit']);

    Route::resource('excel','ExcelController');
    Route::get('downloadProcesosDiarios', ['uses' => 'ExcelController@index','as' => 'downloadProcesosDiarios']);
    Route::get('downloadProcesosSemanales', ['uses' => 'ExcelController@indexSemanal','as' => 'downloadProcesosSemanales']);
    Route::get('downloadProcesosMensuales', ['uses' => 'ExcelController@indexMensual','as' => 'downloadProcesosMensuales']);
    Route::get('downloadProcesosDemanda', ['uses' => 'ExcelController@indexDemanda','as' => 'downloadProcesosDemanda']);
    Route::get('downloadCargues', ['uses' => 'ExcelController@indexCargues','as' => 'downloadCargues']);
    Route::get('downloadCarguesColombia', ['uses' => 'ExcelController@indexCarguesColombia','as' => 'downloadCarguesColombia']);
    Route::get('downloadCarguesPanama', ['uses' => 'ExcelController@indexCarguesPanama','as' => 'downloadCarguesPanama']);
    Route::get('downloadEntregables', ['uses' => 'ExcelController@indexEntregable','as' => 'downloadEntregables']);
    Route::get('downloadFallasDiarias', ['uses' => 'ExcelController@indexFallaDiaria','as' => 'downloadFallasDiarias']);
    Route::get('downloadFallasMensuales', ['uses' => 'ExcelController@indexFallaMensual','as' => 'downloadFallasMensuales']);
    Route::get('downloadResponsables', ['uses' => 'ExcelController@indexResponsables','as' => 'downloadResponsables']);
    Route::get('downloadReporteSemaforoD', ['uses' => 'ExcelController@reporteSLADiario','as' => 'downloadReporteSemaforoD']);

    Route::post('importExcel', 'ImportController@importExcel');
});

Route::resource('chat', 'ChatController');

Route::group(['middleware' => ['auth', 'is_administrador']], function()
{
    Route::resource('Masivo','ImportController');
    Route::post('Masivo/MasivoItems',['as'=> 'Masivo/MasivoItems','uses'=> 'ImportController@MasivoItems']);
});
/*{Route::get('Fallas/listFalla', 'FallaController@index');
	/* Rutas Pais
	Route::resource('Pais','PaisController');
	Route::get('Pais/destroy/{id}',['as'=> 'Pais/destroy','uses'=> 'PaisController@destroy']);
	Route::post('Pais/search',['as' => 'Pais/search', 'uses' => 'PaisController@search']);
	Route::get('Pais/listPais', 'PaisController@index');
	/*Route::get('Pais/newPais', 'PaisController@create');*/

	// Rutas Procesos


	/*Route::resource('Procesos','ProcesoController');
	Route::get('Procesos/destroy/{id}',['as'=> 'Procesos/destroy','uses'=> 'ProcesoController@destroy']);
	Route::post('Procesos/search',['as' => 'Procesos/search', 'uses' => 'ProcesoController@search']);

	/*Route::get('Procesos/listProceso', 'ProcesoController@index');
	Route::get('Procesos/NewProceso', 'ProcesoController@create');
	*/

	// Rutas Entregables
/*;
	// Rutas Frecuencias
	Route::get('Frecuencia/listFrecuencia', 'FrecuenciaController@index');

	// Rutas Turnos
	Route::get('Turnos/listTurnos', 'TurnosController@index');

	// Rutas Fallas
	Route::get('fallas/listFalla', 'FallaController@index');

	// Rutas SLA
	Route::get('SLA/listSLA', 'SLAController@index');

	// Rutas Grupo
	Route::get('Grupos/listGrupo', 'GrupoController@index');

	// Rutas Horario
	Route::get('horario/listHorario', 'HorarioController@index');

	// Rutas Reponsable
	Route::get('Responsable/listResponsable', 'ResponsableController@index');
});


/* Vistas que puede ver el Analista1 de 7X24
Route::group(['middleware' => ['auth', 'is_A17X24']], function()
{

	Route::get('fallas/listFalla', 'FallaController@index');

});/*

// Vistas que puede ver el Analistas1 7X24N
Route::group(['middleware' => ['auth', 'is_A17X24N']], function()
{

	// Rutas Fallas
	Route::get('fallas/listFalla', 'FallaController@index');
});

// Vistas que puede ver el Analistas1 Analistas AC
Route::group(['middleware' => ['auth', 'is_A1_AC']], function()
{

	
	//Route::get('Tipo/listTipo', 'TipoController@index');
	// Rutas Entregables
	

});


// Vistas que puede ver el Analistas 1 WG
Route::group(['middleware' => ['auth', 'is_A1_WG']], function()
{

	
	//Route::get('fallas/listFalla', 'FallaController@index');
});


// Vistas que puede ver el Analistas 2
Route::group(['middleware' => ['auth', 'is_Analista2']], function()
{

	
	//Route::get('Turnos/listTurnos', 'TurnosController@index');

	
});

// Vistas que puede ver el Cliente
Route::group(['middleware' => ['auth', 'is_Cliente']], function()
{
	// Rutas Tipo
	//Route::get('Turnos/listTurnos', 'TurnosController@index');



});

// Vistas que puede ver el Gerencia
Route::group(['middleware' => ['auth', 'is_Gerencia']], function()
{
	// Rutas Tipo
	//Route::get('Tipo/listTipo', 'TipoController@index');
});

