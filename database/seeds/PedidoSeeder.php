<?php

use Illuminate\Database\Seeder;
use App\Pedido;

class PedidoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dados = [
        	'user_clientes' => '1',
        	'produtos_id' => '7',
        	'unidade_id' => '2',
        	'quantidade' => '5',
        	'valor_produto' => '18.99',
        ];	

        Pedido::create($dados);
	
    }
}
