<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/', function() {
    return response()->json(['message'=>'Ingressos API', 'status'=>'Connected']);
});

Route::post('auth/login', 'AuthController@authenticate');
Route::post('auth/user', 'AuthController@getAuthenticatedUser');

Route::resource('usuario', 'UsuarioController');
Route::resource('eventos', 'EventoController');
Route::resource('grupoambiente', 'GrupoAmbienteController');
Route::resource('ambientes', 'AmbienteController');
Route::resource('lotes', 'LoteController');
Route::resource('pdvs', 'PdvController');
Route::resource('pedidos', 'PedidoController');
Route::resource('ingressos', 'IngressoController');
Route::resource('pedidocomplemento', 'PedidoComplementoController');


// Rotas dos Eventos
Route::get('evento/destaques/{n}', 'EventoController@destaques');