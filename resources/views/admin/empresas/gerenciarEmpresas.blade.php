@extends('layout.content')
@section('titulo','Gerenciar Empresa | Construmob')
@section('conteudo')
<div class="section titulo_pagina">
	<h1>Gerenciar Empresa</h1>
</div>

@if(isset($registros[0]->id))
	<form id="form" class="col s12 center-align" action="{{route('admin.empresas.atualizar',$registros[0]->id)}}" method="post" enctype="multipart/form-data">
		<input type="hidden" name="_method" value="put">
@else
	<form id="form" class="col s12 center-align" action="{{route('admin.empresas.salvar')}}" method="post" enctype="multipart/form-data">
@endif

    {{ csrf_field() }}

	<div class="row">
		<div class="col s6">
		@if(isset($registros[0]->imagem))
			<div class="input-field">
				<img width="150" src="{{asset($registros[0]->imagem)}}" />
			</div>
		@endif
			<div class="file-field  input-field">
				<div class="btn light-blue darken-4 text-center">
					<span>Logo</span>
					<input title="Logo" type="file" name="imagem">
				</div>
				<div class="file-path-wrapper">
					<input class="file-path validate" type="text">
				</div>
			</div>			
		</div>
		<div class="input-field col s6">
	        <input value="{{isset($registros[0]->fantasia) ? $registros[0]->fantasia : ''}}" name="fantasia" id="fantasia" type="text" data-length="50">
	        <label for="fantasia">Nome fantasia</label>
		</div>
	   	<div class="input-field col s6">
	        <input value="{{isset($registros[0]->razao_social) ? $registros[0]->razao_social : ''}}" name="razao_social" id="razao_social" type="text" data-length="50">
	        <label for="razao_social">Nome razão social</label>
		</div>
		<div class="input-field col 12">
			<?php
				$tam = 0;
				$checked_cnpj = '';
				$checked_cpf = 'checked';
				$class_cnpj_cpf = 'cpf';

				if (isset($registros[0]->cnpj_cpf)) {
					$tam = strlen($registros[0]->cnpj_cpf);
					if ($tam > 11) {
						$checked_cnpj = 'checked';
						$class_cnpj_cpf = 'cnpj';
					}
					else{
						$checked_cpf = 'checked';
						$class_cnpj_cpf = 'cpf';
					}
				}
			?>
			<p>
				<label>
					<input name="group1" type="radio" class="tipopessoa" tipopessoa='pf' <?=$checked_cpf?> />
					<span>Pessoa física</span>
				</label>
		  
				<label>
					<input name="group1" type="radio" class="tipopessoa" tipopessoa='pj' <?=$checked_cnpj?> />
					<span>Pessoa jurídica</span>
				</label>
		    </p>
		</div>

		<div class="input-field col s8">
	        <input value="{{isset($registros[0]->endereco) ? $registros[0]->endereco : ''}}" name="endereco" id="endereco" type="text" data-length="50">
	        <label for="endereco">Endereço</label>
		</div>
		<div class="input-field col s2">
	        <input value="{{isset($registros[0]->numero) ? $registros[0]->numero : ''}}" name="numero" id="numero" type="text" data-length="50">
	        <label for="numero">Número</label>
		</div>
		<div class="input-field col s2">
	        <input value="{{isset($registros[0]->complemento) ? $registros[0]->complemento : ''}}" name="complemento" id="complemento" type="text" data-length="50">
	        <label for="complemento">Complemento</label>
		</div>
		<div class="input-field col s3">
	        <input value="{{isset($registros[0]->bairro) ? $registros[0]->bairro : ''}}" name="bairro" id="bairro" type="text" data-length="50">
	        <label for="bairro">Bairro</label>
		</div>
		<div class="input-field col s3">
	        <input value="{{isset($registros[0]->cidade) ? $registros[0]->cidade : ''}}" name="cidade" id="cidade" type="text" data-length="50">
	        <label for="cidade">Cidade</label>
		</div>
		<div class="input-field col s3">
	        <input value="{{isset($registros[0]->uf) ? $registros[0]->uf : ''}}" name="uf" id="uf" type="text" data-length="50">
	        <label for="uf">Estado</label>
		</div>
		<div class="input-field col s3">
	        <input value="{{isset($registros[0]->pais) ? $registros[0]->pais : ''}}" name="pais" id="pais" type="text" data-length="50">
	        <label for="pais">País</label>
		</div>
			<div class="input-field col s3">
	        <input value="{{isset($registros[0]->cep) ? $registros[0]->cep : ''}}" name="cep" id="cep" type="text" data-length="50" class="cep">
	        <label for="cep">CEP</label>
		</div>
		<div class="input-field col s3">
	        <input value="{{isset($registros[0]->cnpj_cpf) ? $registros[0]->cnpj_cpf : ''}}" name="cnpj_cpf" id="cnpj_cpf" type="text" data-length="50" class="<?=$class_cnpj_cpf?>">
	        <label for="cnpj_cpf">CNPJ/CPF</label>
		</div>
		<div class="input-field col s3">
	        <input value="{{isset($registros[0]->im) ? $registros[0]->im : ''}}" name="im" id="im" type="text" data-length="50">
	        <label for="im">Inscrição Municipal</label>
		</div>
		<div class="input-field col s3">
	        <input value="{{isset($registros[0]->ie) ? $registros[0]->ie : ''}}" name="ie" id="ie" type="text" data-length="50">
	        <label for="ie">Inscrição Estadual</label>
		</div>
		<div class="input-field col s3">
	        <input value="{{isset($registros[0]->telefone1) ? $registros[0]->telefone1 : ''}}" name="telefone1" id="telefone1" type="text" data-length="50" class="tel">
	        <label for="telefone1">Telefone 1</label>
		</div>
		<div class="input-field col s3">
	        <input value="{{isset($registros[0]->telefone2) ? $registros[0]->telefone2 : ''}}" name="telefone2" id="telefone2" type="text" data-length="50" class="tel">
	        <label for="telefone2">Telefone 2</label>
		</div>
		<div class="input-field col s3">
	        <input value="{{isset($registros[0]->celular1) ? $registros[0]->celular1 : ''}}" name="celular1" id="celular1" type="text" data-length="50" class="cel">
	        <label for="celular1">Celular 1</label>
		</div>
		<div class="input-field col s3">
	        <input value="{{isset($registros[0]->celular2) ? $registros[0]->celular2 : ''}}" name="celular2" id="celular2" type="text" data-length="50" class="cel">
	        <label for="celular2">Celular 2</label>
		</div>
	</div>
	<div class="row">
	    <div class="col s12 center-align">
		@if(isset($registros[0]->id))
			<button title="Atualizar" id="salvar_empresa" class="btn light-blue darken-4 text-center" type="button" name="action">Atualizar</button>
		@else
			<button title="Salvar" id="salvar_empresa" class="btn light-blue darken-4 text-center" type="button" name="action">Salvar</button>
		@endif
	    </div>
	</div>
</form>
@endsection