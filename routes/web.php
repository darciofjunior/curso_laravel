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

Route::group(['prefix' => 'admin/produtos', 'namespace' => 'Admin', 'middleware' => 'auth'], function() {
    Route::get('/', 'ProdutoController@index')->name('admin/produtos/index');
    Route::get('/create', 'ProdutoController@create')->name('admin/produtos/create');
    Route::post('/', 'ProdutoController@store')->name('admin/produtos/store');
    Route::get('/{id}/edit', 'ProdutoController@edit')->name('admin/produtos/edit');
    Route::get('/{id}', 'ProdutoController@show')->name('admin/produtos/show');
    Route::put('{id}', 'ProdutoController@update')->name('admin/produtos/update');
    Route::delete('{id}', 'ProdutoController@destroy')->name('admin/produtos/destroy');
    
    /*GET 	/photos 	index 	photos.index
    GET 	/photos/create 	create 	photos.create
    POST 	/photos 	store 	photos.store
    GET 	/photos/{photo} 	show 	photos.show
    GET 	/photos/{photo}/edit 	edit 	photos.edit
    PUT/PATCH 	/photos/{photo} 	update 	photos.update
    DELETE 	/photos/{photo} 	destroy 	photos.destroy*/
});

Route::group(['prefix' => 'admin/financeiro', 'namespace' => 'Admin', 'middleware' => 'auth'], function() {
    Route::get('saldo', 'SaldoController@index');
    Route::get('saldo/deposito', 'SaldoController@deposito')->name('saldo/deposito');
    Route::post('saldo/deposito', 'SaldoController@store')->name('saldo/deposito/store');
    Route::get('historico', 'HistoricoController@index');
});

Auth::routes();

Route::get('/', 'HomeController@index');