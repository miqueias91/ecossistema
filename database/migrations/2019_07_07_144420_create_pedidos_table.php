<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
  
   
        Schema::create('pedidos', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('user_clientes')->unsigned();
            $table->index('user_clientes');
            $table->foreign('user_clientes')->references('id')->on('clientes')->onDelete('RESTRICT')->onUpdate('cascade');

            $table->index('user_fornecedor');
            $table->foreign('user_fornecedor')->references('id')->on('users')->onDelete('RESTRICT')->onUpdate('cascade');
            
            $table->float('valor_pedido', 8, 2);

            $table->enum('status',['pendente','triagem','finalizado','entregue'])->default('pendente');
            $table->date('data_pedido')->nullable(true);
            $table->date('data_triagem')->nullable(true);
            $table->date('data_finalizado')->nullable(true);
            $table->date('data_entrega')->nullable(true);
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
        Schema::dropIfExists('pedidos');
    }
}
