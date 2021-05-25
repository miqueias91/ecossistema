@extends('layout.content')

@section('titulo','Gerenciar Pedidos | Construmob')

@section('conteudo')
  <div class="section titulo_pagina">
    <h3>Gerenciar Pedidos</h3>
  </div>
         
      @if($registro[0]->status == 'pendente')
        <form class="" action="{{route('admin.pedidos.triar',$registro[0]->pedido_id)}}" method="post" enctype="multipart/form-data" id="form">
      @elseif ($registro[0]->status == 'triagem')
        <form class="" action="{{route('admin.pedidos.finalizar',$registro[0]->pedido_id)}}" method="post" enctype="multipart/form-data" id="form">
      @endif


        {{ csrf_field() }}
        <input type="hidden" name="_method" value="put">

        <div class="row">
          <table>
            <tr>
              <td style="text-align: left;width: 200px"><span style="font-weight: bold;"><h4 class="left">Dados do Cliente</h4></span><br>
              </td>
          </table>
          <table>
              <tr>
                <td style="text-align: left;width: 200px"><span style="font-weight: bold;">Pedido:</span><br>
                  <input style="width: 100px; text-align: center;" type="text" disabled="1" value="{{ str_pad($registro[0]->pedido_id, 9, '0', STR_PAD_LEFT) }}">                  
                </td>

                <td style="text-align: left;" colspan="3"><span style="font-weight: bold;">Cliente:</span><br>
                  <input style="width: 100%; text-align: left;" type="text" disabled="1" value="{{ $registro[0]->nome }}">
                </td>    

                <td style="text-align: left;" colspan="3"><span style="font-weight: bold;">Contato:</span><br>
                  <input class="cel" style="width: 150px; text-align: left;" type="text" disabled="1" value="{{ $registro[0]->contato }}">
                </td>            
              </tr>
          </table>
          <table>
              <tr>
                <td style="text-align: left;"><span style="font-weight: bold;">Endereço:</span>
                  <input style="width: 100%; text-align: left;" type="text" disabled="1" value="{{ $registro[0]->endereco }}">
                </td>

                <td style="text-align: left;width: 80px"><span style="font-weight: bold;">Nº:</span><br>
                  <input style="text-align: left;" type="text" disabled="1" value="{{ $registro[0]->numero }}">                  
                </td>

                <td style="text-align: left;"><span style="font-weight: bold;">Complemento:</span><br>
                  <input style="text-align: left;width: 80px" type="text" disabled="1" value="{{ $registro[0]->complemento }}">                  
                </td>
              </tr>            
          </table>
          <table>
              <tr>
                <td colspan="2" style="text-align: left;"><span style="font-weight: bold;">Bairro:</span>
                  <input style="width: 100%; text-align: left;" type="text" disabled="1" value="{{ $registro[0]->bairro }}">
                </td>

                <td style="text-align: left;width: 300px"><span style="font-weight: bold;">Cidade:</span><br>
                  <input style="text-align: left;" type="text" disabled="1" value="{{ $registro[0]->cidade }}">                  
                </td>

                <td style="text-align: left;"><span style="font-weight: bold;">Estado:</span><br>
                  <input style="text-align: left;width: 100px" type="text" disabled="1" value="{{ $registro[0]->uf }}">                  
                </td>

                <td style="text-align: left;"><span style="font-weight: bold;">CEP:</span><br>
                  <input class="cep" style="text-align: left;width: 100px" type="text" disabled="1" value="{{ $registro[0]->cep }}">                  
                </td>
              </tr>            
          </table>
        </div>
        <br><br>
      <table>
            <tr>
              <td style="text-align: left;width: 200px"><span style="font-weight: bold;"><h4 class="left">Dados do Pedido</h4></span><br>
              </td>
          </table>

        @include('admin.pedidos._form')
        <div class="row">
          <div class="col s12 center-align">
            @if($registro[0]->status == 'pendente')
              <button title="Triar pedido" class="btn light-blue darken-4 text-center" type="button" id="triar_pedido">Triar pedido</button>
            @elseif ($registro[0]->status == 'triagem')

              <a title="Imprimir pedido para triagem" target="_BLANK" class="btn light-blue darken-4" href="{{ route('admin.pedidos.imprimirTriagem',$registro[0]->pedido_id) }}">
                Imprimir pedido para triagem
              </a>

              <button title="Finalizar pedido" class="btn light-blue darken-4 text-center" type="button" id="finalizar_pedido">Finalizar pedido</button>
            @else
              <a title="Imprimir pedido" target="_BLANK" class="btn light-blue darken-4" href="{{ route('admin.pedidos.imprimirPedido',$registro[0]->pedido_id) }}">
                Imprimir pedido
              </a>
            @endif
          </div>
        </div>
      </form>
@endsection