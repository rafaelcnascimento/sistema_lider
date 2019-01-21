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

Route::get('/', 'ProdutosController@index');

//Rotas Produto
Route::get('/produto-listar', 'ProdutosController@index');
Route::get('/produto/{produto}', 'ProdutosController@show');
Route::get('/produto-novo', 'ProdutosController@create');
Route::get('/produto-catalogo', 'ProdutosController@catalogo');

Route::post('/produto', 'ProdutosController@store');
Route::patch('/produto/{produto}', 'ProdutosController@update');
Route::delete('/produto/{produto}', 'ProdutosController@delete');

//Rotas Pedido
Route::get('/pedido-listar', 'PedidoController@index');
Route::get('/pedido/{pedido}', 'PedidoController@show');
Route::get('/pedido-novo', 'PedidoController@create');

Route::post('/pedido', 'PedidoController@store');
Route::patch('/pedido/{pedido}', 'PedidoController@update');
Route::delete('/pedido/{pedido}', 'PedidoController@delete');

//Rotas Cliente
Route::get('/cliente-listar', 'ClienteController@index');
Route::get('/cliente/{cliente}', 'ClienteController@show');
Route::get('/cliente-novo', 'ClienteController@create');

Route::post('/cliente', 'ClienteController@store');
Route::patch('/cliente/{cliente}', 'ClienteController@update');
Route::delete('/cliente/{cliente}', 'ClienteController@delete');

//Rotas Fornecedor
Route::get('/fornecedor-listar', 'FornecedorController@index');
Route::get('/fornecedor/{fornecedor}', 'FornecedorController@show');
Route::get('/fornecedor-novo', 'FornecedorController@create');

Route::post('/fornecedor', 'FornecedorController@store');
Route::patch('/fornecedor/{fornecedor}', 'FornecedorController@update');
Route::delete('/fornecedor/{fornecedor}', 'FornecedorController@delete');

//Rotas Entrada
Route::get('/entrada-listar', 'EntradaController@index');
Route::get('/entrada/{entrada}', 'EntradaController@show');
Route::get('/entrada-nova', 'EntradaController@create');

Route::post('/entrada', 'EntradaController@store');
Route::patch('/entrada/{entrada}', 'EntradaController@update');
Route::delete('/entrada/{entrada}', 'EntradaController@delete');

//Rotas Ajax
Route::get('/produtoAjax', 'ProdutosController@busca');
Route::get('/catalogoAjax', 'ProdutosController@buscaCatalogo');
Route::get('/fornecedorAjax', 'FornecedorController@busca');
Route::get('/entradaAjax', 'EntradaController@busca');



