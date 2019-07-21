@extends('layout.content')
@section('titulo','Gerenciar Produtos | Ecossistema')
@section('conteudo')
<div class="section titulo_pagina">
  <h1>Gerenciar Produtos</h1>
</div>
<div class="row">
  <table>
    <thead>
      <tr>
        <th style="text-align: center;">Nome</th>
        <th style="text-align: center;">Valor Bruto</th>
        <th style="text-align: center;">Valor Promocional</th>
        <th style="text-align: center;">Estoque</th>
        <th style="text-align: center;">Imagem</th>
        <th style="text-align: center;">Publicado</th>
        <th colspan="2" style="text-align: center;">Ação</th>
      </tr>
    </thead>
    <tbody>
      {{ $registros }}
      @foreach($registros as $registro)

        <tr>
          <td style="text-align: center;" class="resumo_pequeno" title="{{ $registro->nome_produto }}">{{ $registro->nome_produto }}</td>
          <td style="text-align: center;">{{ number_format($registro->valor_bruto, 2, ',', '') }}</td>

          <td style="text-align: center;">{{ number_format($registro->valor_promocional, 2, ',', '') }}</td>

          <td style="text-align: center;">{{ number_format($registro->estoque, 3, ',', '') }}</td>

          <td style="text-align: center;"><img height="60" src="{{asset($registro->imagem)}}" alt="{{ $registro->nome_produto }}" /></td>
          <td style="text-align: center;">{{ $registro->publicado }}</td>
          <td style="text-align: center;">
            <a title="Editar" class="btn light-blue darken-4 text-center" href="{{ route('admin.produtos.editar',$registro->id) }}"><i class="material-icons right">edit</i></a>
          </td>
          <td style="text-align: center;">      
            <a title="Deletar" idproduto="{{$registro->id}}" class="btn light-blue darken-4 deletar_produto" href="#"><i class="material-icons right">delete_forever</i></a>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>

<div class="row">
  <div class="col s12 center-align">
    <a class="btn light-blue darken-4" href="{{ route('admin.produtos.adicionar') }}">Adicionar</a>
  </div>
</div>
@endsection