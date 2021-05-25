<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) 
        {
            $table->bigIncrements('id');

            $table->string('nome_produto');

            $table->string('descricao_produto')->nullable(true);

            $table->float('estoque', 8, 3);

            $table->bigInteger('unidade_id')->unsigned();
            $table->index('unidade_id');
            $table->foreign('unidade_id')->references('id')->on('unidades')->onDelete('cascade')->onUpdate('cascade');

            $table->float('valor_bruto', 8, 2);
            $table->float('valor_promocional', 8, 2);
            $table->string('imagem')->nullable(true);

            $table->bigInteger('user_id')->unsigned();
            $table->index('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

            $table->bigInteger('categoria_id')->unsigned();
            $table->index('categoria_id');
            $table->foreign('categoria_id')->references('id')->on('categorias')->onDelete('cascade')->onUpdate('cascade');
            $table->enum('publicado',['sim','nao'])->default('sim');
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
        Schema::dropIfExists('produtos');
    }
}
