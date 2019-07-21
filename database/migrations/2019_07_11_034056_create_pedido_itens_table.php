<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePedidoItensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      
        Schema::create('pedido_itens', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('pedido_id')->unsigned();
            $table->index('pedido_id');
            $table->foreign('pedido_id')->references('id')->on('pedidos')->onDelete('RESTRICT')->onUpdate('cascade');

            $table->bigInteger('produtos_id')->unsigned();
            $table->index('produtos_id');
            $table->foreign('produtos_id')->references('id')->on('produtos')->onDelete('RESTRICT')->onUpdate('cascade');
            
            $table->bigInteger('unidade_id')->unsigned();
            $table->index('unidade_id');
            $table->foreign('unidade_id')->references('id')->on('unidade')->onDelete('RESTRICT')->onUpdate('cascade');
            
            $table->bigInteger('quantidade');
            $table->float('valor_produto', 8, 2);

            $table->enum('status_item',['disponivel','indisponivel'])->default('disponivel');

           
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
        Schema::dropIfExists('pedido_itens');
    }
}
