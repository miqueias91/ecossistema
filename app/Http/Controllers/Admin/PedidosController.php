<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Pedido;
use App\PedidoItem;
use App\Empresa;
use App\Mascara;
use Auth;
use Fpdf;

class PedidosController extends Controller{
    public function index()
    {
		$id = Auth::user()->id;
    	$registros = Pedido::listaPedidoFornecedor($id);   
    	return view('admin.pedidos.gerenciarPedidos',compact('registros'));
    }

    public function triar(Request $req, $id)
    {
    	$dados = $req->all();
    	$dados['status'] = 'triagem';
    	$dados['data_triagem'] = date('Y-m-d');
    	Pedido::find($id)->update($dados);
		return redirect()->route('admin.pedidos.gerenciarpedido');
    }

    public function finalizar(Request $req, $id)
    {
    	$dados = $req->all();
    	$dados['status'] = 'finalizado';
    	$dados['data_finalizado'] = date('Y-m-d');
    	
    	$dadosItem['id_pedido_item'] = $dados['id_pedido_item'];
    	$dadosItem['status_item'] = $dados['status_item'];
    	PedidoItem::alteraStatusItem($dadosItem);
   
    	Pedido::find($id)->update($dados);
		return redirect()->route('admin.pedidos.gerenciarpedido');
    }

    public function imprimirTriagem($id_pedido)
    {
    	error_reporting(1);
    	$id = Auth::user()->id;
    	$dadosEmpresa = Empresa::where('user_id',$id)->get();
    	$dadosPedido = Pedido::buscaPedidoFornecedor($id_pedido);   
    	$registro = PedidoItem::buscaPedidoItemFornecedor($id_pedido, $id);

    	//DADOS DA EMPRESA
		$emblema = $dadosEmpresa[0]->imagem;
		$razao_social = strtoupper($dadosEmpresa[0]->razao_social);
		$cnpj = Mascara::mascaraCNPJ_CPF($dadosEmpresa[0]->cnpj_cpf);
		$logradouro = strtoupper($dadosEmpresa[0]->endereco);
		$numero = $dadosEmpresa[0]->numero;
		$complemento = $dadosEmpresa[0]->complemento;
		$bairro = $dadosEmpresa[0]->bairro;
		$cidade = $dadosEmpresa[0]->cidade;
		$uf = $dadosEmpresa[0]->uf;
		$cep = Mascara::mascaraCEP($dadosEmpresa[0]->cep);
		$telefone1 = Mascara::mascaraTelefone_Celular($dadosEmpresa[0]->telefone1);
		$celular1 = Mascara::mascaraTelefone_Celular($dadosEmpresa[0]->celular1);

		$telefone2 = Mascara::mascaraTelefone_Celular($dadosEmpresa[0]->telefone2);
		$celular2 = Mascara::mascaraTelefone_Celular($dadosEmpresa[0]->celular2);

		$endereco = "";
		if (isset($logradouro)) {
			$endereco .= $logradouro;
		}
		if (isset($numero)) {
			$endereco .= ", ".$numero;
		}
		if (isset($complemento)) {
			$endereco .= ", ".$complemento;
		}

		$id_pedido = str_pad($dadosPedido[0]->id, 9, '0', STR_PAD_LEFT);
		$emissao = implode('/', array_reverse(explode('-', $dadosPedido[0]->data_pedido)));
		$triagem = implode('/', array_reverse(explode('-', $dadosPedido[0]->data_triagem)));
		$valor_pedido = number_format($dadosPedido[0]->valor_pedido, 2, ',', '');

		$cliente = utf8_decode($registro[0]->nome);
		$cnpj_cpf = Mascara::mascaraCNPJ_CPF($registro[0]->cnpj_cpf);
		$logradouro_cliente = utf8_decode($registro[0]->endereco);
		$numero_cliente = $registro[0]->numero;
		$complemento_cliente = $registro[0]->complemento;
		$bairro_cliente = $registro[0]->bairro;
		$cidade_cliente = $registro[0]->cidade;
		$uf_cliente = $registro[0]->uf;
		$cep_cliente = Mascara::mascaraCEP($registro[0]->cep);
		$telefone_cliente = Mascara::mascaraTelefone_Celular($registro[0]->contato);

		$endereco_cliente = "";
		if (isset($logradouro_cliente)) {
			$endereco_cliente .= $logradouro_cliente;
		}
		if (isset($numero_cliente)) {
			$endereco_cliente .= ", ".$numero_cliente;
		}
		if (isset($complemento_cliente)) {
			$endereco_cliente .= ", ".$complemento_cliente;
		}

		$valor_frete = '00,00';

		$observacao = "";

		$tam=5.5;
		$pdf = new Fpdf();
		$pdf::AddPage('P');

		$pdf::SetFillColor(100 , 200, 200);
		$pdf::SetTextColor(0 , 0, 0);
		$pdf::SetFont("Arial", "B", 12);
		$pdf::Cell(0, 10, "TRIAGEM DE PEDIDO","B T","","C");
		$pdf::Ln();

		$pdf::SetTextColor(0,0,0);
		$pdf::Cell(40, $tam, "","","","");
		$pdf::SetFont("Arial", "B", 7);
		$pdf::Cell(100, $tam, "$razao_social","L","","");
		$pdf::Ln();

		$pdf::SetTextColor(0,0,0);
		$pdf::Cell(40, $tam, "","","","");
		$pdf::SetFont("Arial", "", 7);
		$pdf::Cell(100, $tam, "$cnpj","L","","");
		$pdf::Ln();

		$pdf::SetTextColor(0,0,0);
		$pdf::Cell(40, $tam, "","","","");
		$pdf::SetFont("Arial", "", 7);
		$pdf::Cell(80, $tam, "$endereco","L","","");

		$pdf::Image("$emblema",11,25,35,20);	

		$pdf::Cell(50, $tam, "$bairro - $cidade/$uf","","","");
		$pdf::Cell(100, $tam, "CEP: $cep","","","");
		$pdf::Ln();

		$pdf::Cell(40, $tam, "","","","");
		$pdf::Cell(30, $tam, "$telefone1","L","","");
		$pdf::Cell(30, $tam, "$telefone2","","","");
		$pdf::Cell(30, $tam, "$celular1","","","");
		$pdf::Cell(10, $tam, "$celular2","","","");
		$pdf::Ln();

		$pdf::SetFont("Arial", "B", 7);
		$pdf::Cell(48,$tam,"Nº DO PEDIDO","1","","L");
		$pdf::Cell(48,$tam,"DATA DO PEDIDO","1","","L");
		$pdf::Cell(48,$tam,"DATA DA TRIAGEM","1","","L");
		$pdf::Cell(48,$tam,"VALOR DO PEDIDO","1","","L");
		$pdf::Ln();

		$pdf::SetFont("Arial", "", 6);
		$pdf::Cell(48,$tam,str_pad("$id_pedido",8,"0",STR_PAD_LEFT),"1","","L");
		$pdf::Cell(48,$tam,"$emissao","1","","L");
		$pdf::Cell(48,$tam,"$triagem","1","","L");
		$pdf::Cell(48,$tam,"$valor_pedido","1","","L");
		$pdf::Ln();

		$pdf::Ln();
		$pdf::SetFont("Arial", "B", 7);
		$pdf::Cell(0,$tam,"DADOS DO CLIENTE","","","");
		$pdf::Ln();

		$pdf::SetFont("Arial", "B", 7);
		$pdf::Cell(142,$tam,"NOME / RAZÃO SOCIAL","1","","L");
		$pdf::Cell(50,$tam,"CNPJ/CPF","1","","L");
		$pdf::Ln();

		$pdf::SetFont("Arial", "", 6);
		$pdf::Cell(142,$tam,"$cliente","1","","L");
		$pdf::Cell(50,$tam,"$cnpj_cpf","1","","L");
		$pdf::Ln();

		$pdf::SetFont("Arial", "B", 7);
		$pdf::Cell(122,$tam,"ENDEREÇO","1","","L");
		$pdf::Cell(35,$tam,"BAIRRO/DISTRITO","1","","L");
		$pdf::Cell(35,$tam,"CEP","1","","L");
		$pdf::Ln();

		$pdf::SetFont("Arial", "", 6);
		$pdf::Cell(122,$tam,"$endereco_cliente","1","","L");
		$pdf::Cell(35,$tam,"$bairro_cliente","1","","L");
		$pdf::Cell(35,$tam,"$cep_cliente","1","","L");
		$pdf::Ln();

		$pdf::SetFont("Arial", "B", 7);
		$pdf::Cell(122,$tam,"MUNICÍPIO","1","","L");
		$pdf::Cell(35,$tam,"FONE/FAX","1","","L");
		$pdf::Cell(35,$tam,"UF","1","","L");
		$pdf::Ln();

		$pdf::SetFont("Arial", "", 6);
		$pdf::Cell(122,$tam,"$cidade_cliente","1","","L");
		$pdf::Cell(35,$tam,"$telefone_cliente","1","","L");
		$pdf::Cell(35,$tam,"$uf_cliente","1","","L");
		$pdf::Ln();

		$pdf::Ln();
		$pdf::SetFont("Arial", "B", 7);
		$pdf::Cell(0,$tam,"DADOS DOS PRODUTOS / SERVIÇOS","","","");
		$pdf::Ln();

		$pdf::SetFont("Arial", "B", 7);
		$pdf::Cell(13,$tam,"STATUS","1","","L");
		$pdf::Cell(100,$tam,"DESCRIÇÃO DOS PRODUTOS / SERVIÇOS","1","","L");
		$pdf::Cell(13.5,$tam,"UNID.","1","","L");
		$pdf::Cell(13.5,$tam,"QUANT.","1","","L");
		$pdf::Cell(26,$tam,"VLR. UNIT","1","","L");
		$pdf::Cell(26,$tam,"VLR. TOTAL","1","","L");
		$pdf::Ln();

		$total_item = 0;
		$total_produto = 0;
		foreach ($registro as $key => $item) {
			$total_item = $item->quantidade * $item->valor_produto;
			$total_produto += $total_item;

			$pdf::SetFont("Arial", "", 6);
			$pdf::Cell(13,$tam,'',"1","","L");			

			$x = $pdf::GetX();
			$y = $pdf::GetY();
			$pdf::MultiCell(100,$tam,utf8_decode($item->nome_produto),"1","","");	
			$pdf::SetXY($x + 100, $y);

			$pdf::Cell(13.5,$tam,"$item->abreviacao","1","","C");
			$pdf::Cell(13.5,$tam,number_format($item->quantidade, 3, ',', ''),"1","","R");
			$pdf::Cell(26,$tam,number_format($item->valor_produto, 2, ',', ''),"1","","R");
			$pdf::Cell(26,$tam,number_format($total_item, 2, ',', ''),"1","","R");
			$pdf::Ln();
		}
		$pdf::SetFont("Arial", "B", 7);
		$pdf::Cell(166, $tam, "VALOR TOTAL DOS PRODUTOS","","","R");
		$pdf::Cell(26, $tam, number_format($total_produto, 2, ',', ''),"1","","R");
		$pdf::Ln();

		$pdf::SetFont("Arial", "B", 7);
		$pdf::Cell(166, $tam, "FRETE","","","R");
		$pdf::Cell(26, $tam, number_format($valor_frete, 2, ',', ''),"1","","R");
		$pdf::Ln();

		$total_pedido = $total_produto + $valor_frete;
		$pdf::SetFont("Arial", "B", 7);
		$pdf::Cell(166, $tam, "VALOR TOTAL DO PEDIDO","","","R");
		$pdf::Cell(26, $tam, number_format($total_pedido, 2, ',', ''),"1","","R");
		$pdf::Ln();

		$pdf::Ln();
		$pdf::SetFont("Arial", "B", 7);
		$pdf::Cell(0,$tam,"DADOS ADICIONAIS","","","");
		$pdf::Ln();

		$pdf::SetFont("Arial", "", 6);
		$pdf::Cell(192,($tam * 5),"$observacao","1","","L");
		$pdf::Ln();
		$pdf::Ln();

		$pdf::SetFont("Arial", "B", 7);
		$pdf::Cell(45, $tam, "","","","");
		$pdf::Cell(102,$tam,"","B","","C");
		$pdf::Ln();

		$pdf::SetFont("Arial", "", 7);
		$pdf::Cell(192,$tam,"ASS. SEPARADOR","","","C");
		$pdf::Ln();

			
		$pdf::Output(NULL,'triagem_pedido_'.str_pad($dadosPedido[0]->id, 9, '0', STR_PAD_LEFT).'.pdf');
	 exit;
    }

    public function imprimirPedido($id_pedido)
    {
    	error_reporting(1);
    	$id = Auth::user()->id;
    	$dadosEmpresa = Empresa::where('user_id',$id)->get();
    	$dadosPedido = Pedido::buscaPedidoFornecedor($id_pedido);   
    	$dadosItem = PedidoItem::buscaPedidoItemFornecedor($id_pedido, $id);

    	//DADOS DA EMPRESA
		$emblema = $dadosEmpresa[0]->imagem;
		$razao_social = strtoupper($dadosEmpresa[0]->razao_social);
		$cnpj = Mascara::mascaraCNPJ_CPF($dadosEmpresa[0]->cnpj_cpf);
		$logradouro = utf8_decode(strtoupper($dadosEmpresa[0]->endereco));
		$numero = $dadosEmpresa[0]->numero;
		$complemento = $dadosEmpresa[0]->complemento;
		$bairro = $dadosEmpresa[0]->bairro;
		$cidade = $dadosEmpresa[0]->cidade;
		$uf = $dadosEmpresa[0]->uf;
		$cep = Mascara::mascaraCEP($dadosEmpresa[0]->cep);
		$telefone1 = Mascara::mascaraTelefone_Celular($dadosEmpresa[0]->telefone1);
		$celular1 = Mascara::mascaraTelefone_Celular($dadosEmpresa[0]->celular1);

		$telefone2 = Mascara::mascaraTelefone_Celular($dadosEmpresa[0]->telefone2);
		$celular2 = Mascara::mascaraTelefone_Celular($dadosEmpresa[0]->celular2);

		$endereco = "";
		if (isset($logradouro)) {
			$endereco .= $logradouro;
		}
		if (isset($numero)) {
			$endereco .= ", ".$numero;
		}
		if (isset($complemento)) {
			$endereco .= ", ".$complemento;
		}

		$id_pedido = str_pad($dadosPedido[0]->id, 9, '0', STR_PAD_LEFT);
		$emissao = implode('/', array_reverse(explode('-', $dadosPedido[0]->data_pedido)));
		$triagem = implode('/', array_reverse(explode('-', $dadosPedido[0]->data_triagem)));
		$finalizacao = implode('/', array_reverse(explode('-', $dadosPedido[0]->data_finalizado)));
		$valor_pedido = number_format($dadosPedido[0]->valor_pedido, 2, ',', '');

		$cliente = utf8_decode($dadosItem[0]->nome);
		$cnpj_cpf = Mascara::mascaraCNPJ_CPF($dadosItem[0]->cnpj_cpf);
		$logradouro_cliente = utf8_decode($dadosItem[0]->endereco);
		$numero_cliente = $dadosItem[0]->numero;
		$complemento_cliente = $dadosItem[0]->complemento;
		$bairro_cliente = $dadosItem[0]->bairro;
		$cidade_cliente = $dadosItem[0]->cidade;
		$uf_cliente = $dadosItem[0]->uf;
		$cep_cliente = Mascara::mascaraCEP($dadosItem[0]->cep);
		$telefone_cliente = Mascara::mascaraTelefone_Celular($dadosItem[0]->contato);
		$observacao = utf8_decode($dadosPedido[0]->observacao_pedido);
		$endereco_cliente = "";
		if (isset($logradouro_cliente)) {
			$endereco_cliente .= $logradouro_cliente;
		}
		if (isset($numero_cliente)) {
			$endereco_cliente .= ", ".$numero_cliente;
		}
		if (isset($complemento_cliente)) {
			$endereco_cliente .= ", ".$complemento_cliente;
		}

		$valor_frete = '00,00';		

		$tam=5.5;
		$pdf = new Fpdf();
		$pdf::AddPage('P');

		$pdf::SetFillColor(100 , 200, 200);
		$pdf::SetTextColor(0 , 0, 0);
		$pdf::SetFont("Arial", "B", 12);
		$pdf::Cell(0, 10, "RECIBO DE PEDIDO","B T","","C");
		$pdf::Ln();

		$pdf::SetTextColor(0,0,0);
		$pdf::Cell(40, $tam, "","","","");
		$pdf::SetFont("Arial", "B", 7);
		$pdf::Cell(100, $tam, "$razao_social","L","","");
		$pdf::Ln();

		$pdf::SetTextColor(0,0,0);
		$pdf::Cell(40, $tam, "","","","");
		$pdf::SetFont("Arial", "", 7);
		$pdf::Cell(100, $tam, "$cnpj","L","","");
		$pdf::Ln();

		$pdf::SetTextColor(0,0,0);
		$pdf::Cell(40, $tam, "","","","");
		$pdf::SetFont("Arial", "", 7);
		$pdf::Cell(80, $tam, "$endereco","L","","");

		$pdf::Image("$emblema",11,25,35,20);	

		$pdf::Cell(50, $tam, "$bairro - $cidade/$uf","","","");
		$pdf::Cell(100, $tam, "CEP: $cep","","","");
		$pdf::Ln();

		$pdf::Cell(40, $tam, "","","","");
		$pdf::Cell(30, $tam, "$telefone1","L","","");
		$pdf::Cell(30, $tam, "$telefone2","","","");
		$pdf::Cell(30, $tam, "$celular1","","","");
		$pdf::Cell(10, $tam, "$celular2","","","");
		$pdf::Ln();

		$pdf::SetFont("Arial", "B", 7);
		$pdf::Cell(48,$tam,"Nº DO PEDIDO","1","","L");
		$pdf::Cell(48,$tam,"DATA DO PEDIDO","1","","L");
		$pdf::Cell(48,$tam,"DATA DA TRIAGEM","1","","L");
		$pdf::Cell(48,$tam,"DATA DA FINALIZAÇÃO","1","","L");
		$pdf::Ln();

		$pdf::SetFont("Arial", "", 6);
		$pdf::Cell(48,$tam,str_pad("$id_pedido",8,"0",STR_PAD_LEFT),"1","","L");
		$pdf::Cell(48,$tam,"$emissao","1","","L");
		$pdf::Cell(48,$tam,"$triagem","1","","L");
		$pdf::Cell(48,$tam,"$finalizacao","1","","L");
		$pdf::Ln();

		$pdf::Ln();
		$pdf::SetFont("Arial", "B", 7);
		$pdf::Cell(0,$tam,"DADOS DO CLIENTE","","","");
		$pdf::Ln();

		$pdf::SetFont("Arial", "B", 7);
		$pdf::Cell(142,$tam,"NOME / RAZÃO SOCIAL","1","","L");
		$pdf::Cell(50,$tam,"CNPJ/CPF","1","","L");
		$pdf::Ln();

		$pdf::SetFont("Arial", "", 6);
		$pdf::Cell(142,$tam,"$cliente","1","","L");
		$pdf::Cell(50,$tam,"$cnpj_cpf","1","","L");
		$pdf::Ln();

		$pdf::SetFont("Arial", "B", 7);
		$pdf::Cell(122,$tam,"ENDEREÇO","1","","L");
		$pdf::Cell(35,$tam,"BAIRRO/DISTRITO","1","","L");
		$pdf::Cell(35,$tam,"CEP","1","","L");
		$pdf::Ln();

		$pdf::SetFont("Arial", "", 6);
		$pdf::Cell(122,$tam,"$endereco_cliente","1","","L");
		$pdf::Cell(35,$tam,"$bairro_cliente","1","","L");
		$pdf::Cell(35,$tam,"$cep_cliente","1","","L");
		$pdf::Ln();

		$pdf::SetFont("Arial", "B", 7);
		$pdf::Cell(122,$tam,"MUNICÍPIO","1","","L");
		$pdf::Cell(35,$tam,"FONE/FAX","1","","L");
		$pdf::Cell(35,$tam,"UF","1","","L");
		$pdf::Ln();

		$pdf::SetFont("Arial", "", 6);
		$pdf::Cell(122,$tam,"$cidade_cliente","1","","L");
		$pdf::Cell(35,$tam,"$telefone_cliente","1","","L");
		$pdf::Cell(35,$tam,"$uf_cliente","1","","L");
		$pdf::Ln();

		$pdf::Ln();
		$pdf::SetFont("Arial", "B", 7);
		$pdf::Cell(0,$tam,"DADOS DOS PRODUTOS / SERVIÇOS","","","");
		$pdf::Ln();

		$pdf::SetFont("Arial", "B", 7);
		$pdf::Cell(113,$tam,"DESCRIÇÃO DOS PRODUTOS / SERVIÇOS","1","","L");
		$pdf::Cell(13.5,$tam,"UNID.","1","","L");
		$pdf::Cell(13.5,$tam,"QUANT.","1","","L");
		$pdf::Cell(26,$tam,"VLR. UNIT","1","","L");
		$pdf::Cell(26,$tam,"VLR. TOTAL","1","","L");
		$pdf::Ln();

		$total_item = 0;
		$total_produto = 0;
		foreach ($dadosItem as $key => $item) {
			
			if ($item->status_item == 'disponivel') {
				$total_item = $item->quantidade * $item->valor_produto;
				$total_produto += $total_item;


				$x = $pdf::GetX();
				$y = $pdf::GetY();
				$pdf::MultiCell(113,$tam,utf8_decode($item->nome_produto),"1","","");	
				$pdf::SetXY($x + 113, $y);

				$pdf::Cell(13.5,$tam,"$item->abreviacao","1","","C");
				$pdf::Cell(13.5,$tam,number_format($item->quantidade, 3, ',', ''),"1","","R");
				$pdf::Cell(26,$tam,number_format($item->valor_produto, 2, ',', ''),"1","","R");
				$pdf::Cell(26,$tam,number_format($total_item, 2, ',', ''),"1","","R");
				$pdf::Ln();
			}
		}
		$pdf::SetFont("Arial", "B", 7);
		$pdf::Cell(166, $tam, "VALOR TOTAL DOS PRODUTOS","","","R");
		$pdf::Cell(26, $tam, number_format($total_produto, 2, ',', ''),"1","","R");
		$pdf::Ln();

		$pdf::SetFont("Arial", "B", 7);
		$pdf::Cell(166, $tam, "FRETE","","","R");
		$pdf::Cell(26, $tam, number_format($valor_frete, 2, ',', ''),"1","","R");
		$pdf::Ln();

		$total_pedido = $total_produto + $valor_frete;
		$pdf::SetFont("Arial", "B", 7);
		$pdf::Cell(166, $tam, "VALOR TOTAL DO PEDIDO","","","R");
		$pdf::Cell(26, $tam, number_format($total_pedido, 2, ',', ''),"1","","R");
		$pdf::Ln();

		$pdf::Ln();
		$pdf::SetFont("Arial", "B", 7);
		$pdf::Cell(0,$tam,"DADOS ADICIONAIS","","","");
		$pdf::Ln();

		$pdf::SetFont("Arial", "", 6);
		$pdf::Cell(192,($tam * 5),"$observacao","1","","L");
		$pdf::Ln();


			
		$pdf::Output(NULL,'triagem_pedido_'.str_pad($dadosPedido[0]->id, 9, '0', STR_PAD_LEFT).'.pdf');
	 exit;
    }


}
