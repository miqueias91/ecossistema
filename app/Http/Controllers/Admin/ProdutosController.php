<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Configuracao\CategoriaController;
use App\Produto;
use App\Categoria;
use App\Unidade;
use Auth;

class ProdutosController extends Controller
{
    public function index()
    {
		$id = Auth::user()->id;
    	$registros = Produto::listarProdutos($id);
    	return view('admin.produtos.gerenciarProdutos',compact('registros'));
    }

    public function adicionar()
    {
		$status = 'ativo';
		$categorias = Categoria::where('status',$status)->get();
		$options_ca = '';
	    if($categorias)
	    {
	        foreach ($categorias as $row)
	        {
	            $options_ca .= "<option value='$row->id'>$row->nome_categoria</option>\n" ;
	        }
	    }

	   	//OPTION DA UNIDADE
	    $unidades = Unidade::where('status',$status)->get();
		$options_un = '';
	    if($unidades)
	    {
	        foreach ($unidades as $row)
	        {
	            $options_un .= "<option value='$row->id'>$row->descricao - $row->abreviacao</option>\n" ;
	        }
	    }
      	return view('admin.produtos.adicionar',compact('options_ca','options_un'));
    }

    public function salvar(Request $req)
    {
    	$id = Auth::user()->id;
      	$dados = $req->all();
      	$dados['user_id'] = $id;
      	$dados['valor_bruto'] = str_replace(",",".",$dados['valor_bruto']);
      	$dados['valor_promocional'] = str_replace(",",".",$dados['valor_promocional']);
      	$dados['estoque'] = str_replace(",",".",$dados['estoque']);
      
      	if($req->hasFile('imagem'))
      	{
	        $imagem = $req->file('imagem');
	        $num = rand(1111,9999);
	        $dir = "img/produtos/";
	        $ex = $imagem->guessClientExtension();
	        $nomeImagem = "imagem_".$num.".".$ex;
	        $imagem->move($dir,$nomeImagem);
	        $dados['imagem'] = $dir."/".$nomeImagem;
	    }
      	Produto::create($dados);
      	return redirect()->route('admin.produtos.gerenciarproduto');    
    }

    public function editar($id)
    {
      	$registro = Produto::find($id);
		
		$status = 'ativo';

		//OPTION DA CATEGORIA
		$categorias = Categoria::where('status',$status)->get();
		$options_ca = '';
	    if($categorias)
	    {
	        foreach ($categorias as $row)
	        {
	            $options_ca .= "<option value='$row->id'>$row->nome_categoria</option>\n" ;
	        }
	    }

	    //OPTION DA UNIDADE
	    $unidades = Unidade::where('status',$status)->get();
		$options_un = '';
	    if($unidades)
	    {
	        foreach ($unidades as $row)
	        {
	            $options_un .= "<option value='$row->id'>$row->descricao - $row->abreviacao</option>\n" ;
	        }
	    }

      	return view('admin.produtos.editar',compact('registro','options_ca', 'options_un'));
    }

    public function atualizar(Request $req, $id)
    {
		$dados = $req->all();
		if(isset($dados['publicado']))
		{
			$dados['publicado'] = 'sim';
		}else
		{
			$dados['publicado'] = 'nao';
		}
		if($req->hasFile('imagem')){
			$imagem = $req->file('imagem');
			$num = rand(1111,9999);
			$dir = "img/produtos/";
			$ex = $imagem->guessClientExtension();
			$nomeImagem = "imagem_".$num.".".$ex;
			$imagem->move($dir,$nomeImagem);
			$dados['imagem'] = $dir."/".$nomeImagem;
		}
		$dados['valor_bruto'] = str_replace(",",".",$dados['valor_bruto']);
		$dados['valor_promocional'] = str_replace(",",".",$dados['valor_promocional']);
		$dados['estoque'] = str_replace(",",".",$dados['estoque']);

		Produto::find($id)->update($dados);
		return redirect()->route('admin.produtos.gerenciarproduto');
    }

    public function deletar($id)
    {
      	Produto::find($id)->delete();
		return redirect()->route('admin.produtos.gerenciarproduto');
    }
}
