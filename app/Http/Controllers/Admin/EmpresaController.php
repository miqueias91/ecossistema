<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Empresa;
use Auth;

class EmpresaController extends Controller
{
  public function index()
  {
    $id = Auth::user()->id;
    $registros = Empresa::where('user_id',$id)->get();
    return view('admin.empresas.gerenciarEmpresas',compact('registros'));
  }

  public function salvar(Request $req)
  {
  	$id = Auth::user()->id;

  	$dados = $req->all();
  	$dados['user_id'] = $id;
  	$dados['cep'] = str_replace(".","",$dados['cep']);
  	$dados['cep'] = str_replace("-","",$dados['cep']);

  	$dados['cnpj_cpf'] = str_replace(".","",$dados['cnpj_cpf']);
  	$dados['cnpj_cpf'] = str_replace("-","",$dados['cnpj_cpf']);
  	$dados['cnpj_cpf'] = str_replace("/","",$dados['cnpj_cpf']);

    $dados['telefone1'] = isset($dados['telefone1']) ? str_replace("(","",$dados['telefone1']) : NULL;
    $dados['telefone1'] = isset($dados['telefone1']) ? str_replace(")","",$dados['telefone1']) : NULL;
    $dados['telefone1'] = isset($dados['telefone1']) ? str_replace("-","",$dados['telefone1']) : NULL;
    $dados['telefone1'] = isset($dados['telefone1']) ? str_replace(" ","",$dados['telefone1']) : NULL;

    $dados['telefone2'] = isset($dados['telefone2']) ? str_replace("(","",$dados['telefone2']) : NULL;
    $dados['telefone2'] = isset($dados['telefone2']) ? str_replace(")","",$dados['telefone2']) : NULL;
    $dados['telefone2'] = isset($dados['telefone2']) ? str_replace("-","",$dados['telefone2']) : NULL;
    $dados['telefone2'] = isset($dados['telefone2']) ? str_replace(" ","",$dados['telefone2']) : NULL;

    $dados['celular1'] = isset($dados['celular1']) ? str_replace("(","",$dados['celular1']) : NULL;
    $dados['celular1'] = isset($dados['celular1']) ? str_replace(")","",$dados['celular1']) : NULL;
    $dados['celular1'] = isset($dados['celular1']) ? str_replace("-","",$dados['celular1']) : NULL;
    $dados['celular1'] = isset($dados['celular1']) ? str_replace(" ","",$dados['celular1']) : NULL;

    $dados['celular2'] = isset($dados['celular2']) ? str_replace("(","",$dados['celular2']) : NULL;
    $dados['celular2'] = isset($dados['celular2']) ? str_replace(")","",$dados['celular2']) : NULL;
    $dados['celular2'] = isset($dados['celular2']) ? str_replace("-","",$dados['celular2']) : NULL;
    $dados['celular2'] = isset($dados['celular2']) ? str_replace(" ","",$dados['celular2']) : NULL;


  	if($req->hasFile('imagem'))
    {
      $imagem = $req->file('imagem');
      $num = rand(1111,9999);
      $dir = "img/empresas/";
      $ex = $imagem->guessClientExtension();
      $nomeImagem = "imagem_".$num.".".$ex;
      $imagem->move($dir,$nomeImagem);
      $dados['imagem'] = $dir."/".$nomeImagem;
    }
    Empresa::create($dados);
    return redirect()->route('admin.empresas.gerenciarempresas');    
  }

  public function atualizar(Request $req, $id)
  {
    $dados = $req->all();

    $dados['cep'] = str_replace(".","",$dados['cep']);
    $dados['cep'] = str_replace("-","",$dados['cep']);

    $dados['cnpj_cpf'] = str_replace(".","",$dados['cnpj_cpf']);
    $dados['cnpj_cpf'] = str_replace("-","",$dados['cnpj_cpf']);
    $dados['cnpj_cpf'] = str_replace("/","",$dados['cnpj_cpf']);

    $dados['telefone1'] = isset($dados['telefone1']) ? str_replace("(","",$dados['telefone1']) : NULL;
    $dados['telefone1'] = isset($dados['telefone1']) ? str_replace(")","",$dados['telefone1']) : NULL;
    $dados['telefone1'] = isset($dados['telefone1']) ? str_replace("-","",$dados['telefone1']) : NULL;
    $dados['telefone1'] = isset($dados['telefone1']) ? str_replace(" ","",$dados['telefone1']) : NULL;

    $dados['telefone2'] = isset($dados['telefone2']) ? str_replace("(","",$dados['telefone2']) : NULL;
    $dados['telefone2'] = isset($dados['telefone2']) ? str_replace(")","",$dados['telefone2']) : NULL;
    $dados['telefone2'] = isset($dados['telefone2']) ? str_replace("-","",$dados['telefone2']) : NULL;
    $dados['telefone2'] = isset($dados['telefone2']) ? str_replace(" ","",$dados['telefone2']) : NULL;

    $dados['celular1'] = isset($dados['celular1']) ? str_replace("(","",$dados['celular1']) : NULL;
    $dados['celular1'] = isset($dados['celular1']) ? str_replace(")","",$dados['celular1']) : NULL;
    $dados['celular1'] = isset($dados['celular1']) ? str_replace("-","",$dados['celular1']) : NULL;
    $dados['celular1'] = isset($dados['celular1']) ? str_replace(" ","",$dados['celular1']) : NULL;

    $dados['celular2'] = isset($dados['celular2']) ? str_replace("(","",$dados['celular2']) : NULL;
    $dados['celular2'] = isset($dados['celular2']) ? str_replace(")","",$dados['celular2']) : NULL;
    $dados['celular2'] = isset($dados['celular2']) ? str_replace("-","",$dados['celular2']) : NULL;
    $dados['celular2'] = isset($dados['celular2']) ? str_replace(" ","",$dados['celular2']) : NULL;

    if($req->hasFile('imagem'))
    {
      $imagem = $req->file('imagem');
      $num = rand(1111,9999);
      $dir = "img/empresas/";
      $ex = $imagem->guessClientExtension();
      $nomeImagem = "imagem_".$num.".".$ex;
      $imagem->move($dir,$nomeImagem);
      $dados['imagem'] = $dir."/".$nomeImagem;
    }
    Empresa::find($id)->update($dados);
    return redirect()->route('admin.empresas.gerenciarempresas');
  }
}
