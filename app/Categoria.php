<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model{
    protected $fillable = [
      'id','nome_categoria','status'
  	];
}
