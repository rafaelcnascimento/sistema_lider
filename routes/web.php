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
Route::get('/pedido-entrega/{pedido}', 'PedidoController@showEntrega');
Route::get('/pedido-cliente/{pedido}', 'PedidoController@showCliente');

Route::post('/pedido-filtrar', 'PedidoController@filter');
Route::post('/pedido', 'PedidoController@store');
Route::patch('/pedido_quantidade/{pedido}&{produto}&{quantidade}&{preco}', 'PedidoController@updateProduto');
Route::patch('/pedido/{pedido}', 'PedidoController@update');
Route::delete('/pedido_remover/{pedido}&{produto}', 'PedidoController@removerProduto');
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

//Rotas Ajax
Route::get('/clienteAjax', 'ClienteController@busca');
Route::get('/clientesAjax', 'ClienteController@clientesAjax');
Route::get('/saldoAjax', 'ClienteController@saldoAjax');
Route::get('/produtoAjax', 'ProdutoController@busca');
Route::get('/catalogoAjax', 'ProdutoController@buscaCatalogo');
Route::get('/checkoutAjax', 'PedidoController@buscaCheckout');
Route::get('/pagarAjax', 'PedidoController@pago');
Route::get('/despagarAjax', 'PedidoController@naoPago');
Route::get('/pmaisAjax', 'PedidoController@pmais');
Route::get('/pmenosAjax', 'PedidoController@pmenos');
Route::get('/pagarDespesaAjax', 'DespesaController@pago');
Route::get('/despagarDespesaAjax', 'DespesaController@naoPago');
Route::get('/fornecedorAjax', 'FornecedorController@busca');
Route::get('/entradaAjax', 'EntradaController@busca');

//Orçamento
Route::get('/orcamento-listar', 'OrcamentoController@index');
Route::get('/orcamento-converter/{orcamento}', 'OrcamentoController@converter');
Route::get('/orcamento/{orcamento}', 'OrcamentoController@show');
Route::post('/orcamento', 'OrcamentoController@store');

//Carrinho
Route::get('/adicionarProduto', 'PedidoController@add');
Route::get('/alterarProduto', 'PedidoController@alterar');
Route::get('/removerProduto', 'PedidoController@remove');

//Rotas imagens
Route::get('/redirect-orcamento/{orcamento}&{fechar}', 'OrcamentoController@redirect');
Route::get('/redirect-pedido/{pedido}&{flag}&{fechar}', 'PedidoController@redirect');
Route::get('/gerar-orcamento/{orcamento}', 'OrcamentoController@gerarImagem');
Route::get('/gerar-cliente/{pedido}', 'OrcamentoController@gerarCliente');
Route::get('/gerar-entrega/{pedido}', 'OrcamentoController@gerarEntrega');

//Rotas Unidade
Route::get('/unidade-listar', 'UnidadeController@index');
Route::get('/unidade/{unidade}', 'UnidadeController@show');
Route::get('/unidade-nova', 'UnidadeController@create');

Route::post('/unidade', 'UnidadeController@store');
Route::patch('/unidade/{unidade}', 'UnidadeController@update');
Route::delete('/unidade/{unidade}', 'UnidadeController@delete');

//Rotas Despesa
Route::get('/despesa-listar', 'DespesaController@index');
Route::get('/despesa/{despesa}', 'DespesaController@show');
Route::get('/despesa-nova', 'DespesaController@create');
Route::get('/arquivo/{despesa}', 'DespesaController@showArquivo');

Route::post('/despesa', 'DespesaController@store');
Route::patch('/despesa/{despesa}', 'DespesaController@update');
Route::delete('/despesa/{despesa}', 'DespesaController@delete');

//Estocador
Route::get('/produto-estocador', 'ProdutoController@estocador');
Route::get('/estocadorAjax', 'ProdutoController@estocadorBusca');
Route::get('/estocadorQuantidadeAjax', 'ProdutoController@quantidade');
Route::get('/estocadorCodigoAjax', 'ProdutoController@codigo');

//Excel 
Route::get('/importar', 'ProdutoController@import');

//Rotas Tipo Despesa
Route::get('/tipoDespesa-listar', 'TipoDespesaController@index');
Route::get('/tipoDespesa/{tipoDespesa}', 'TipoDespesaController@show');
Route::get('/tipoDespesa-nova', 'TipoDespesaController@create');

Route::post('/tipoDespesa', 'TipoDespesaController@store');
Route::patch('/tipoDespesa/{tipoDespesa}', 'TipoDespesaController@update');
Route::delete('/tipoDespesa/{tipoDespesa}', 'TipoDespesaController@delete');
