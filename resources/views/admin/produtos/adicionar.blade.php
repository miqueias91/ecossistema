@extends('layout.content')
@section('titulo','Gerenciar Produtos | Ecossistema')
@section('conteudo')

  <div class="section titulo_pagina">
    <h3>Adicionar Produto</h3>
  </div>

  <div class="row">
    <form id="form" class="" action="{{route('admin.produtos.salvar')}}" method="post" enctype="multipart/form-data">
      {{ csrf_field() }}
      @include('admin.produtos._form')
      <div class="row">
        <div class="col s12 center-align">
          <button title="Salvar" class="btn light-blue darken-4 text-center" type="button" id="salvar_produto">Salvar</button>
        </div>
      </div>
    </form>
  </div>
@endsection