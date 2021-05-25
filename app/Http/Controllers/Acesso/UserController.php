<?php

namespace App\Http\Controllers\Acesso;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;

class UserController extends Controller
{
	public function index()
	{
		$id = Auth::user()->id;
		$registros = User::where('id',$id)->get();
		return view('acesso.gerenciarConta',compact('registros'));
	}
	public function atualizar(Request $req, $id)
	{
		$dados = $req->all();

		if(Auth::attempt(['id'=>$id,'password'=>$dados['password']]))
	    {
	    	$dados['password'] = isset($dados['new_password']) && !empty($dados['new_password']) ? bcrypt($dados['new_password']) : bcrypt($dados['password']);

	    	User::find($id)->update($dados);
			return redirect()->route('acesso.conta.gerenciarconta');

	    }
	    else
	    {
	    	$registros = User::where('id',$id)->get();
	    	$registros[0]['error_atualizar_conta'] = "Senha incorreta, não foi possível atualizar os dados.";
			return view('acesso.gerenciarConta',compact('registros'));			
	    }
	}
}
