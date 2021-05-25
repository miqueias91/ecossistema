<?php

use Illuminate\Database\Seeder;
use App\Cliente;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        $dados = [
        	'nome' => 'Miquéias Matias Caetano',
        	'usuario' => 'miqueiasm91',
        	'email' => 'miqueiasmcaetano@gmail.com',
        	'password' => bcrypt('matias1309'),
			'endereco' => 'Rua Doutor Maninho',
			'numero' => '145',
			'complemento' => 'B',
			'bairro' => 'Santa Cruz',
			'cidade' => 'Caratinga',
			'uf' => 'MG',
			'pais' => 'Brasil',
			'cep' => '35300188',
			'cnpj_cpf' => '28752922006',
			'status' => 'ativo'
        ];

        if(Cliente::where('email', '=', $dados['email'])->count()){
        	$usuario = Cliente::where('email', '=', $dados['email'])->first();

        	$usuario->update($dados);
        	echo "Cliente Alterado\n";
        }
        else{
        	Cliente::create($dados);
        	echo "Cliente Criado\n";
        }
    }
}
