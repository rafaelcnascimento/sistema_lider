<?php 

Route::get('/', 'DadoController@index');
Route::get('/importar', 'DadoController@importacao');
Route::get('/despesa-proximas', 'DespesaController@proximas');
