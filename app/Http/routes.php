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

Route::get('/', function () {
    return view('welcome');
});

/**
 * Rotas para os chamados
 */
Route::get('chamados', ['as' => 'chamados', 'uses' => 'ChamadosController@index']);

Route::get('chamados/{chamados}', 'ChamadosController@show');

Route::post('chamados', ['as' => 'filter', 'uses' => 'ChamadosController@filter']);

Route::get('chamados/{pedidos}/create', ['as' => 'chamados_create', 'uses' => 'ChamadosController@create']);

Route::post('chamados/store', ['as' => 'chamados_store', 'uses' => 'ChamadosController@store']);

/**
 * Rotas para os pedidos
 */
Route::get('pedidos/buscar', ['as' => 'pedidos_buscar', 'uses' => 'PedidosController@search']);

Route::post('pedidos/encontrar', ['as' => 'pedidos_encontrar', 'uses' => 'PedidosController@find']);