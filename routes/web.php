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

Route::get('/', 'ProdutoController@index');

//Rotas Produto
Route::get('/produto-listar', 'ProdutoController@index');
Route::get('/produto/{produto}', 'ProdutoController@show');
Route::get('/produto-novo', 'ProdutoController@create');
Route::get('/produto-catalogo', 'ProdutoController@catalogo');
Route::get('/estoque-baixo', 'ProdutoController@estoqueBaixo');

Route::post('/produto', 'ProdutoController@store');
Route::patch('/produto/{produto}', 'ProdutoController@update');
Route::delete('/produto/{produto}', 'ProdutoController@delete');

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
Route::get('/produtoAjax', 'ProdutoController@busca');
Route::get('/clienteAjax', 'ClienteController@busca');
Route::get('/catalogoAjax', 'ProdutoController@buscaCatalogo');
Route::get('/checkoutAjax', 'PedidoController@buscaCheckout');
Route::get('/fornecedorAjax', 'FornecedorController@busca');
Route::get('/entradaAjax', 'EntradaController@busca');

//Carrinho
Route::get('/adicionarProduto', 'pedidoController@add');
Route::get('/removerProduto', 'pedidoController@remove');




