<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Produto extends Model
{
    protected $fillable = [
		'nome_produto',
		'descricao_produto',
		'unidade_id',
		'valor_bruto',
		'valor_promocional',
		'imagem',
		'user_id',
		'categoria_id',
		'publicado',
		'estoque'
  	];

  	protected function listarProdutos($idfornecedor)
  	{
  		#$registros = Produto::where('user_id',$idfornecedor)->get();
    	$registros = DB::table('produtos')->where('user_id',$idfornecedor)->paginate(4);
    	return $registros;
  	}
}