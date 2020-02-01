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
Route::prefix('api')->group(function () {

	Route::get('/');

	Route::get('detalhes/vendido/{id}', 'Veiculo@vendido')->name('api.vendido');

	Route::get('detalhes/disponivel/{id}', 'Veiculo@disponivel')->name('api.disponivel');

	//TODOS OS CARROS/ ITENS POR PAGINA
	Route::get('/carros/{registrosPagina}', 'Veiculos@index')->name('api.carros');

	//MARCA OU MODELOS/ITENS POR PAGINA
	Route::get('/carros/{filters}/{registrosPagina}', 'Veiculos@indexFilter');


});