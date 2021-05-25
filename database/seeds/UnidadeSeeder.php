<?php

use Illuminate\Database\Seeder;
use App\Unidade;

class UnidadeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dados = [
        	'descricao' => 'Quilograma',
        	'abreviacao' => 'Kg',
        ];
  


        Unidade::create($dados);
    }
}
