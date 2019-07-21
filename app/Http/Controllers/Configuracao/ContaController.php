<?php

namespace App\Http\Controllers\Configuracao;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class ContaController extends Controller
{
     public function index()
  	{
	    $id = Auth::user()->id;
	    //$registros = Conta::where('user_id',$id)->get();
	    //return view('admin.empresas.gerenciarEmpresas',compact('registros'));
  	}
}
