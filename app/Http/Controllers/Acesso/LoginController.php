<?php

namespace App\Http\Controllers\Acesso;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class LoginController extends Controller
{
  public function index()
  {
    return view('acesso.login');
  }

  public function autenticacao(Request $req)
  {
    $dados = $req->all();
    if(Auth::attempt(['email'=>$dados['email'],'password'=>$dados['senha']]))
    {
    	return redirect()->route('admin.inicio');
    }
    else
    {
      return redirect()->route('login');
    }
  }

  public function sair()
  {
    Auth::logout();
    return redirect()->route('login');
  }
}
