<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/principal', function () {
    return view('layouts.principalEncuesta');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//CONTROLADOR TIPODOCUMENTO
Route::get('crearTipoDocumento', 'MSistema\TipoDocumentoController@CrearTipoDocumento')->name('crearTipoDocumento');//cargar la vista para crear un tipo de documento
Route::post('guardarTipoDocumento', 'MSistema\TipoDocumentoController@GuardarTipoDocumento')->name('guardarTipoDocumento');//Guardar la informacion del tipo documento
Route::get('tiposDocumentos', 'MSistema\TipoDocumentoController@ObtenerTiposDocumentos')->name('tiposDocumentos');//Obtiene la lista de tipos de documentos


//CONTROLADOR ROL
Route::get('crearRol', 'MSistema\RolController@CrearRol')->name('crearRol');//cargar la vista para crear un rol
Route::post('guardarRol', 'MSistema\RolController@GuardarRol')->name('guardarRol');//Guardar la informacion del rol
Route::get('roles', 'MSistema\RolController@ObtenerRoles')->name('roles');//Obtiene la lista de tipos de roles

//CONTROLADOR USUARIOS
Route::get('crearUsuario', 'MSistema\UsuarioController@CrearUsuarioEmpresa')->name('crearUsuario');//cargar la vista para crear un usuario
Route::post('guardarUsuario', 'MSistema\UsuarioController@GuardarUsuarioEmpresa')->name('guardarUsuario');//Guardar la informacion del usuario
Route::get('usuarios', 'MSistema\UsuarioController@ObtenerUsuarios')->name('usuarios');//Obtiene la lista de usuarios
Route::get('/register/verify/{code}', 'MSistema\UsuarioController@verifarCorreo'); //verificar correo electronico

//CONTROLADOR ENCUESTA
Route::get('vistaCrearEncuesta', 'MAutonomia\EncuestaController@VistaCrearEncuesta')->name('vistaCrearEncuesta');//cargar la vista para crear un proveedor
Route::post('guardarEncuesta', 'MAutonomia\EncuestaController@GuardarEncuesta')->name('guardarEncuesta');//Guardar la informacion del proveedor
Route::get('encuestasUsuario', 'MAutonomia\EncuestaController@ObtenerEncuestasUsuario')->name('encuestas');//Obtiene la lista de encuestas
Route::get('encuestas', 'MAutonomia\EncuestaController@ObtenerEncuestas')->name('encuestas');//Obtiene la lista de encuestas
Route::get('FormularioEncuesta/{idEncuesta}', ['uses' =>'MAutonomia\EncuestaController@obtenerFormularioEncuesta']);/** Obtiene el formulario de la encuesta*/
Route::post('registrarEncuesta',['uses' =>'MAutonomia\EncuestaController@registrarEncuesta']);

//CONTROLADOR SEDES
Route::get('crearSede', 'MEmpresa\SedeController@CrearSede')->name('crearSede');//cargar la vista para crear una sede
Route::post('guardarSede', 'MEmpresa\SedeController@GuardarSede')->name('guardarSede');//Guardar la informacion de la sede
Route::get('sedes', 'MEmpresa\SedeController@ObtenerSedes')->name('sedes');//Obtiene la lista de sedes