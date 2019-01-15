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
Route::get('/produto', 'ProdutosController@show');
Route::get('/produto-novo', 'ProdutosController@create');

Route::post('/produto', 'ProdutosController@store');
Route::patch('/produto/{produto}', 'ProdutosController@update');
Route::delete('/produto/{produto}', 'ProdutosController@delete');

//Rotas Fornecedor
Route::get('/fornecedor-listar', 'FornecedorController@index');
Route::get('/fornecedor/{fornecedor}', 'FornecedorController@show');
Route::get('/fornecedor-novo', 'FornecedorController@create');

Route::post('/fornecedor', 'FornecedorController@store');
Route::patch('/fornecedor/{fornecedor}', 'FornecedorController@update');
Route::delete('/fornecedor/{fornecedor}', 'FornecedorController@delete');

//Rotas Ajax
Route::get('/produtoAjax', 'ProdutosController@busca');
Route::get('/fornecedorAjax', 'FornecedorController@busca');



