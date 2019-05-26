<?php 
//Rotas BI
Route::get('/', 'DadoController@index');
Route::get('/importar', 'DadoController@importacao');
Route::get('/despesa-proximas', 'DespesaController@proximas');

//Rotas Dados
Route::get('/dados', 'DadoController@show');
Route::patch('/dados/{dado}', 'DadoController@update');

//Rotas gráficos
Route::get('/balanco-anual', 'DadoController@grafico_anos');
Route::get('/balanco-mensal/{ano}', 'DadoController@grafico_meses');
