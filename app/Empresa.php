<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model{
    protected $fillable = [
      'fantasia','razao_social','endereco','numero','complemento','bairro','cidade','uf','pais','cep','cnpj_cpf','ie','im','status','user_id', 'imagem', 'telefone1', 'telefone2', 'celular1', 'celular2'
  	];
}
