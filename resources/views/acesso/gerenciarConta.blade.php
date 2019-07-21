@extends('layout.content')
@section('titulo','Gerenciar Conta | Ecossistema')
@section('conteudo')
<div class="section titulo_pagina">
	<h1>Gerenciar Conta</h1>
</div>

<form id="form" class="col s12 center-align" action="{{route('acesso.conta.atualizar',$registros[0]->id)}}" method="post" enctype="multipart/form-data">
	<input type="hidden" name="_method" value="put">

    {{ csrf_field() }}

	<div class="row">
		<div class="input-field col s12">
	        <input value="{{$registros[0]->name}}" name="name" id="name" type="text" data-length="50">
	        <label for="name">Nome</label>
		</div>
		<div class="input-field col s12">
	        <input disabled value="{{$registros[0]->email}}" name="email" id="email" type="email" data-length="50">
	        <label for="email">E-mail</label>
		</div>
		<div class="input-field col s6">
	        <input value="" name="password" id="password" type="password" data-length="50">
	        <label for="password">Senha atual</label>
		</div>
		<div class="input-field col s6">
	        <input value="" name="new_password" id="new_password" type="password" data-length="50">
	        <label for="new_password">Nova Senha</label>
		</div>		
	</div>
	<div class="row">
	    <div class="col s12 center-align">
			<button id="atualizar_conta" class="btn light-blue darken-4 text-center" type="button" name="action">Atualizar</button>		
	    </div>
	</div>
</form>
@endsection