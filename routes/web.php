<?php

Route::group(['prefix' => 'admin/produtos', 'namespace' => 'Admin', 'middleware' => 'auth'], function() {
    Route::get('/', 'ProdutoController@index')->name('admin/produtos/index');
    Route::get('/create', 'ProdutoController@create')->name('admin/produtos/create');
    Route::post('/', 'ProdutoController@store')->name('admin/produtos/store');
    Route::get('/{id}/edit', 'ProdutoController@edit')->name('admin/produtos/edit');
    Route::get('/{id}', 'ProdutoController@show')->name('admin/produtos/show');
    Route::put('{id}', 'ProdutoController@update')->name('admin/produtos/update');
    Route::delete('{id}', 'ProdutoController@destroy')->name('admin/produtos/destroy');
});

Route::group(['prefix' => 'admin/financeiro', 'namespace' => 'Admin', 'middleware' => 'auth'], function() {
    Route::get('saldo', 'SaldoController@index')->name('admin/financeiro/saldo/index');
    
    Route::get('saldo/deposito', 'SaldoController@deposito')->name('admin/financeiro/saldo/deposito');
    Route::post('saldo/deposito', 'SaldoController@depositostore')->name('admin/financeiro/saldo/deposito/store');
   
    Route::get('saldo/sacar', 'SaldoController@sacar')->name('admin/financeiro/saldo/sacar');
    Route::post('saldo/sacar', 'SaldoController@sacarstore')->name('admin/financeiro/saldo/sacar/store');
    
    Route::get('saldo/transferir', 'SaldoController@transferir')->name('admin/financeiro/saldo/transferir');
    Route::post('saldo/confirmartransferencia', 'SaldoController@confirmartransferencia')->name('admin/financeiro/saldo/confirmartransferencia');
    Route::post('saldo/transferir', 'SaldoController@transferirstore')->name('admin/financeiro/saldo/transferir/store');
    
    Route::get('historico', 'SaldoController@historico')->name('admin/financeiro/historico/index');
    Route::any('historicopesquisar', 'SaldoController@historicopesquisar')->name('admin/financeiro/historico/pesquisar');
});

Route::group(['prefix' => 'admin/meu_perfil', 'namespace' => 'Admin', 'middleware' => 'auth'], function() {
    Route::get('', 'UserController@profile')->name('admin/meu_perfil');
    Route::post('profileatualizar', 'UserController@profileatualizar')->name('admin/meu_perfil/profileatualizar');
});

Auth::routes();

Route::get('/', 'HomeController@index');