<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Pedido;
use App\PedidoItem;
use Auth;

class PedidosItemController extends Controller
{
    public function gerenciar($id)
    {
    	$idfornecedor = Auth::user()->id;
		$registro = PedidoItem::buscaPedidoItemFornecedor($id, $idfornecedor);
		//echo "<pre>";print_r($registro);die;
      	return view('admin.pedidos.editar',compact('registro'));
    }
}
