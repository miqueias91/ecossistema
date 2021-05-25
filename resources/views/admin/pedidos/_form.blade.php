<?php
  $disponivel = '';
  $indisponivel = '';
  $desativado = '';

  if ($registro[0]->status == 'finalizado' || $registro[0]->status == 'entregue') {
    $desativado = 'disabled';
  }
?>
<div class="row">
  <table>
    <thead>
      <tr>
        <th style="text-align: center;">Status</th>
        <th style="text-align: left;">Produto</th>
        <th style="text-align: center;">Unidade</th>
        <th style="text-align: center;">Quantidade</th>
        <th style="text-align: right;">Valor unitário</th>
        <th style="text-align: right;">Valor total</th>
      </tr>
    </thead>
    <tbody>
      @foreach($registro as $row)
        <input type="hidden" name="id_pedido_item[]" value="{{$row->id}}">
        <tr>        
          <td style="text-align: center;">
            <?php
              if ($row->status_item == 'disponivel') {
                $disponivel = 'selected';
                $indisponivel = '';
              }
              elseif ($row->status_item == 'indisponivel') {
                $disponivel = '';
                $indisponivel = 'selected';              
              }
            ?>


            <div class="">
              <select {{$desativado}} name="status_item[]" class="status_item">
                <option {{$disponivel}} value="disponivel">Disponível</option>
                <option {{$indisponivel}} value="indisponivel">Indisponível</option>                
              </select>
            </div>
          </td>

          <td style="text-align: left;" class="" title="">
            {{ $row->nome_produto }}
          </td>

          <td style="text-align: center;" class="" title="">
            {{ $row->abreviacao }}
          </td>

          <td style="text-align: center;" class="" title="">
            {{ $row->quantidade }}
          </td>

          <td style="text-align: right;">
            {{ number_format($row->valor_produto, 2, ',', '') }}
          </td>

          <td style="text-align: right;">
            {{ number_format(($row->quantidade * $row->valor_produto), 2, ',', '') }}
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
  @if($registro[0]->status != 'pendente')
  <table>
    <tr>        
      <td style="text-align: left;width: 200px"><span style="font-weight: bold;"><h4 class="left">Observações para o cliente</h4></span><br>
    </tr>
    <tr>
      <td rowspan="5">
        
        <textarea {{$desativado}} rows='30' id="observacao_pedido" name="observacao_pedido">{{ $registro[0]->observacao_pedido }}</textarea>
      </td>
    </tr>
  </table>
  @endif

</div>