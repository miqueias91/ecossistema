<?php

use Illuminate\Database\Seeder;
use App\User;
class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        $dados = [
        	'name' => 'Administrador do Sistema',
        	'password' => bcrypt('matias1309'),
        	'email' => 'miqueiasmcaetano@gmail.com'
        ];

        if(User::where('email', '=', $dados['email'])->count()){
        	$usuario = User::where('email', '=', $dados['email'])->first();

        	$usuario->update($dados);
        	echo "Usuário Alterado\n";
        }
        else{
        	User::create($dados);
        	echo "Usuário Criado\n";
        }
    }
}
