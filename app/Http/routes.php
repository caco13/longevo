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

Route::get('chamados', ['as' => 'chamados', 'uses' => 'ChamadosController@index']);

Route::post('chamados', ['as' => 'filter', 'uses' => 'ChamadosController@filter']);

Route::get('chamados/create', ['as' => 'chamados_create', 'uses' => 'ChamadosController@create']);

Route::get('chamados/{chamados}', 'ChamadosController@show');
