<?php

namespace App;
use DB;

use Illuminate\Database\Eloquent\Model;

class PedidoItem extends Model
{
    protected $fillable = [
		'pedido_id',
		'produtos_id',
		'unidade_id',
		'quantidade',
    'valor_produto',
    'status_item',
  	];

  	protected function buscaPedidoItemFornecedor($id_pedido, $fornecedor){

      $registros = DB::table('pedido_itens')
      ->join('pedidos', 'pedido_itens.pedido_id', '=', 'pedidos.id')
      ->join('clientes', 'pedidos.user_clientes', '=', 'clientes.id')
      //->join('produtos', 'pedido_itens.produtos_id', '=', 'produtos.id')
      ->join('empresas_produtos', 'pedido_itens.produtos_id', '=', 'empresas_produtos.id')
      ->join('unidades', 'pedido_itens.unidade_id', '=', 'unidades.id')
      ->select( 'pedido_itens.id',
                'pedido_itens.status_item',
                'pedidos.status',
                'pedidos.observacao_pedido',
                'clientes.nome',
                'clientes.cnpj_cpf',
                'clientes.endereco',
                'clientes.numero',
                'clientes.complemento',
                'clientes.contato',
                'clientes.bairro',
                'clientes.cidade',
                'clientes.uf',
                'clientes.pais',
                'clientes.cep',
                'pedido_itens.produtos_id',
                'pedido_itens.quantidade',
                'pedido_itens.pedido_id',
                'pedido_itens.valor_produto',
                //'produtos.nome_produto',
                'empresas_produtos.descricao_produto',
                'empresas_produtos.nome_produto',
                'unidades.descricao',
                'unidades.abreviacao'
              )->where('pedido_itens.pedido_id',$id_pedido)
              ->where('pedidos.user_fornecedor',$fornecedor)
              ->get();
      return $registros;
  }

  protected function alteraStatusItem($dados)
  {

    foreach ($dados['id_pedido_item'] as $key => $dado) {      
      DB::table('pedido_itens')
        ->where('id', $dado)
        ->update(['status_item' => $dados['status_item'][$key]]);
    }
  }

}
