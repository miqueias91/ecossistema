<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model{
    protected $fillable = [
		'user_clientes',
		'status',
		'data_pedido',
    'data_triagem',
    'data_entrega',
    'data_finalizado',
    'observacao_pedido'
  	];

  	protected function listaPedidoFornecedor($fornecedor){
      $registros = DB::table('pedidos')
      ->join('clientes', 'pedidos.user_clientes', '=', 'clientes.id')
      ->select( 'pedidos.id', 
                'pedidos.valor_pedido', 
                'pedidos.status', 
                'pedidos.data_pedido',
                'pedidos.data_triagem',
                'pedidos.data_entrega',
                'pedidos.data_finalizado',
                'pedidos.user_clientes',
                'pedidos.observacao_pedido',
                'clientes.nome',
                'clientes.email',
                'clientes.endereco',
                'clientes.numero',
                'clientes.complemento',
                'clientes.bairro',
                'clientes.cidade',
                'clientes.uf',
                'clientes.pais',
                'clientes.cep',
                'clientes.cnpj_cpf'
              )->where('pedidos.user_fornecedor',$fornecedor)->paginate(4);
      return $registros;
    }

    protected function buscaPedidoFornecedor($fornecedor){
      $registros = DB::table('pedidos')
      ->join('clientes', 'pedidos.user_clientes', '=', 'clientes.id')
      ->select( 'pedidos.id', 
                'pedidos.valor_pedido', 
                'pedidos.status', 
                'pedidos.data_pedido',
                'pedidos.data_triagem',
                'pedidos.data_entrega',
                'pedidos.data_finalizado',
                'pedidos.user_clientes',
                'pedidos.observacao_pedido',
                'clientes.nome',
                'clientes.email',
                'clientes.endereco',
                'clientes.numero',
                'clientes.complemento',
                'clientes.bairro',
                'clientes.cidade',
                'clientes.uf',
                'clientes.pais',
                'clientes.cep',
                'clientes.cnpj_cpf'
              )->where('pedidos.user_fornecedor',$fornecedor)->get();
      return $registros;
    }
   

    
}
