<div class="row">
  <div class="col s12">
    <div class="input-field">
        <select name="categoria_id" id="categoria_id">
          <option value="">Selecionar</option>
          <?=$options_ca?>
        </select>
        <label for="categoria_id">Categoria</label>
    </div>
  </div>  
</div>

<div class="row">
  <div class="col s12">
    <div class="input-field">
        <select name="unidade_id" id="unidade_id">
          <option value="">Selecionar</option>
          <?=$options_un?>
        </select>
        <label for="unidade_id">Unidade</label>
    </div>
  </div>  
</div>


<div class="row">
  <div class="col s12">
    <div class="input-field">
      <input type="text" name="nome_produto" id="nome_produto" value="{{isset($registro->nome_produto) ? $registro->nome_produto : ''}}">
      <label for="nome_produto">Nome produto</label>
    </div>  
  </div>  
</div>

<form class="col s12">
  <div class="row">
    <div class="col s12">
      <div class="input-field">
        <textarea id="descricao_produto" class="materialize-textarea" name="descricao_produto" id="descricao_produto">{{isset($registro->descricao_produto) ? $registro->descricao_produto : ''}}</textarea>
        <label for="descricao_produto">Descrição</label>
      </div>
    </div>
  </div>
</form>

<div class="row">

  <div class="col s4">    
    <div class="input-field">
      <input type="text" name="estoque" id="estoque" class="numeral" value="{{isset($registro->estoque) ? number_format($registro->estoque, 3, ',', '') : NULL}}">
      <label for="estoque">Estoque</label>
    </div>
  </div> 

  <div class="col s4">    
    <div class="input-field">
      <input type="text" name="valor_bruto" id="valor_bruto" class="valor" value="{{isset($registro->valor_bruto) ? number_format($registro->valor_bruto, 2, ',', '') : ''}}" data-thousands="" data-decimal=",">
      <label for="valor_bruto">Valor bruto</label>
    </div>
  </div>  

  <div class="col s4">    
    <div class="input-field">
      <input type="text" name="valor_promocional" id="valor_promocional" class="valor" value="{{isset($registro->valor_promocional) ? number_format($registro->valor_promocional, 2, ',', '') : ''}}" data-thousands="" data-decimal=",">
      <label for="valor_promocional">Valor promocional</label>
    </div>
  </div>
</div>

@if(isset($registro->imagem))
<div class="input-field">
  <img width="150" src="{{asset($registro->imagem)}}" />
</div>
@endif

<div class="file-field  input-field">
  <div class="btn light-blue darken-4 text-center">
    <span>Imagem</span>
    <input title="Imagem" type="file" name="imagem" id="imagem">
  </div>
  <div class="file-path-wrapper">
    <input class="file-path validate" type="text">
  </div>
</div>

<div class="input-field">
  <p>
    <label>
      <input type="checkbox" name="publicado" id="publicado" value="true" <?=isset($registro->publicado) && $registro->publicado == 'sim' ? 'checked' : ''?> />
      <span>Publicado</span>
    </label>
  </p>
</div>
