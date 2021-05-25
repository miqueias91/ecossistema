@extends('layout.content')
@section('titulo','Listar Pedidos | Construmob')
@section('conteudo')
 <div class="section titulo_pagina">
	<h1>Listar Pedidos</h1>
</div>
<div class="row">

  <table>
    <thead>
      <tr>
        <th style="text-align: center;">Pedido</th>
        <th style="text-align: center;">Cliente</th>
        <th style="text-align: center;">Valor do pedido</th>
        <th style="text-align: center;">Data do pedido</th>
        <th style="text-align: center;">Data da triagem</th>
        <th style="text-align: center;">Data da Finalização</th>
        <th style="text-align: center;">Status</th>
        <th colspan="2" style="text-align: center;">Ação</th>
      </tr>
    </thead>
    <tbody>
      @foreach($registros as $registro)
        <tr>
          <td style="text-align: center;" class="" title="">
            {{ str_pad($registro->id, 9, '0', STR_PAD_LEFT) }}
          </td>

          <td style="text-align: center;" class="resumo_pequeno" title="{{ $registro->nome }}">
            {{ $registro->nome }}
          </td>

          <td style="text-align: center;">
            {{ number_format($registro->valor_pedido, 2, ',', '') }}
          </td>

          <td style="text-align: center;">
            {{ isset($registro->data_pedido) ? $registro->data_pedido : null }}
          </td>

          <td style="text-align: center;">
            {{ isset($registro->data_triagem) ? $registro->data_triagem : null }}
          </td>

          <td style="text-align: center;">
            {{ isset($registro->data_finalizado) ? $registro->data_finalizado : null }}
          </td>

          <td style="text-align: center;">
            {{ strtoupper($registro->status) }}
          </td>

          <td style="text-align: center;">
            <a title="Gerenciar" class="btn light-blue darken-4 text-center" href="{{ route('admin.pedidos.gerenciar',$registro->id) }}">Gerenciar</a>
          </td>
          
        </tr>
      @endforeach
    </tbody>
  </table>
</div>

@endsection