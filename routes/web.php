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

//LOGIN
Route::get('/',['as' => 'login','uses' => 'Acesso\LoginController@index']);

Route::get('/login/sair',['as' => 'acesso.sair','uses' => 'Acesso\LoginController@sair']);

Route::post('/login/autenticacao',['as' => 'acesso.autenticacao','uses' => 'Acesso\LoginController@autenticacao']);

//TUDO QUE ESTÁ AQUI, PRECISA ESTAR AUTENTICADO PARA ACESSAR
Route::group(['middleware' => 'auth'], function(){
	//INICIO
	Route::get('/admin/inicio',['as' => 'admin.inicio','uses' => 'Admin\InicioController@index']);

	//GERENCIAR A CONTA
	Route::get('/acesso/conta',['as' => 'acesso.conta.gerenciarconta','uses' => 'Acesso\UserController@index']);

	Route::put('/acesso/conta/atualizar/{id}',['as' => 'acesso.conta.atualizar','uses' => 'Acesso\UserController@atualizar']);

	//GERENCIAR EMPRESA
	Route::get('/admin/empresas',['as' => 'admin.empresas.gerenciarempresas','uses' => 'Admin\EmpresaController@index']);
	
	Route::post('/admin/empresas/salvar',['as' => 'admin.empresas.salvar','uses' => 'Admin\EmpresaController@salvar']);

	Route::put('/admin/empresas/atualizar/{id}',['as' => 'admin.empresas.atualizar','uses' => 'Admin\EmpresaController@atualizar']);

	//GERENCIAR PRODUTO
	Route::get('/admin/produtos',['as' => 'admin.produtos.gerenciarproduto','uses' => 'Admin\ProdutosController@index']);

	Route::get('/admin/produtos/adicionar',['as'=>'admin.produtos.adicionar','uses'=>'Admin\ProdutosController@adicionar']);

  	Route::post('/admin/produtos/salvar',['as'=>'admin.produtos.salvar','uses'=>'Admin\ProdutosController@salvar']);

  	Route::get('/admin/produtos/editar/{id}',['as'=>'admin.produtos.editar','uses'=>'Admin\ProdutosController@editar']);

  	Route::put('/admin/produtos/atualizar/{id}',['as'=>'admin.produtos.atualizar','uses'=>'Admin\ProdutosController@atualizar']);

  	Route::get('/admin/produtos/deletar/{id}',['as'=>'admin.produtos.deletar','uses'=>'Admin\ProdutosController@deletar']);

  	//GERENCIAR PEDIDO
	Route::get('/admin/pedidos',['as' => 'admin.pedidos.gerenciarpedido','uses' => 'Admin\PedidosController@index']);

	Route::get('/admin/pedidos/imprimirTriagem/{id}',['as'=>'admin.pedidos.imprimirTriagem','uses'=>'Admin\PedidosController@imprimirTriagem']);

	Route::get('/admin/pedidos/imprimirPedido/{id}',['as'=>'admin.pedidos.imprimirPedido','uses'=>'Admin\PedidosController@imprimirPedido']);

  	Route::put('/admin/pedidos/finalizar/{id}',['as'=>'admin.pedidos.finalizar','uses'=>'Admin\PedidosController@finalizar']);

  	Route::put('/admin/pedidos/triar/{id}',['as'=>'admin.pedidos.triar','uses'=>'Admin\PedidosController@triar']);

  	//GERENCIAR PEDIDO ITEM
  	Route::get('/admin/pedidos/gerenciar/{id}',['as'=>'admin.pedidos.gerenciar','uses'=>'Admin\PedidosItemController@gerenciar']);







});
