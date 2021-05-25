<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = [
      'nome',
      'usuario',
      'email',
      'password',
      'endereco',
      'numero',
      'complemento',
      'bairro',
      'cidade',
      'uf',
      'pais',
      'cep',
      'cnpj_cpf',
      'status'
  	];
}
