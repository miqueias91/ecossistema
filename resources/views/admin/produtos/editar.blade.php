@extends('layout.content')

@section('titulo','Editar Produtos | Ecossistema')

@section('conteudo')
  <div class="section titulo_pagina">
    <h3>Editando Produtos</h3>
  </div>
  <div class="row">
    <form class="" action="{{route('admin.produtos.atualizar',$registro->id)}}" method="post" enctype="multipart/form-data" id="form">
      {{ csrf_field() }}
      <input type="hidden" name="_method" value="put">
      @include('admin.produtos._form')
      <div class="row">
        <div class="col s12 center-align">
          <button class="btn light-blue darken-4 text-center" type="button" id="atualizar_produto">Atualizar</button>
        </div>
      </div>
    </form>
  </div>
@endsection