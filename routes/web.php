<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('auth.login');
})->name('main');

Auth::routes();

Route::middleware(['auth','acceso'])->group(function () {
	Route::resource('/blog', 'BlogController');
	Route::resource('/categoria_blog', 'CategoriaBlogController');
	Route::post('blog/content_image', 'BlogController@upload');
	Route::resource('/contactos', 'ContactoController');
	Route::resource('/ventas', 'VentaController');
	Route::resource('/usuario', 'UsuarioController');
	Route::resource('/free_trial', 'FreetrialController');
	Route::resource('/cuestionarios', 'CuestionarioController');
	Route::post('CrearCuestionario', 'CuestionarioController@guardar')->name('CrearCuestionario');
	Route::get('/cuestionario_estado/{id_cuestionario}', 'CuestionarioController@cambiar_estado')->name('CambiarEstado');
	Route::resource('/preguntas', 'PreguntaController');
	Route::resource('/respuestas', 'RespuestaController');
	Route::resource('/cuestionario_pregunta', 'CuestionarioPreguntaController');
});