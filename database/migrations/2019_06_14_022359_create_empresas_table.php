<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) 
        {
            $table->bigIncrements('id');
            $table->string('fantasia');
            $table->string('razao_social');
            $table->string('telefone1')->nullable(true);
            $table->string('telefone2')->nullable(true);
            $table->string('celular1')->nullable(true);
            $table->string('celular2')->nullable(true);
            $table->string('endereco');
            $table->string('numero')->nullable(true);
            $table->string('complemento')->nullable(true);
            $table->string('bairro');
            $table->string('cidade');
            $table->string('uf');
            $table->string('pais');
            $table->string('cep');
            $table->string('cnpj_cpf');
            $table->string('ie')->nullable(true);
            $table->string('im')->nullable(true);
            $table->enum('status',['ativo','inativo'])->default('ativo');
            $table->bigInteger('user_id')->unsigned();
            $table->index('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('imagem')->nullable(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empresas');
    }
}
