<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCascadeDeleteToPedidosAndPedidosProdutos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pedidos', function (Blueprint $table) {
            $table->dropForeign(['cliente_id']);
            $table->foreign('cliente_id')
                  ->references('id')->on('clientes')
                  ->onDelete('cascade');
        });



        Schema::table('pedidos_produtos', function (Blueprint $table) {
            $table->dropForeign(['pedido_id']);
            $table->foreign('pedido_id')
                  ->references('id')->on('pedidos')
                  ->onDelete('cascade');

            $table->dropForeign(['produto_id']);
            $table->foreign('produto_id')
                  ->references('id')->on('produtos')
                  ->onDelete('cascade'); 
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pedidos', function (Blueprint $table) {
            $table->dropForeign(['cliente_id']);
            $table->foreign('cliente_id')
                  ->references('id')->on('clientes');
        });

        Schema::table('pedidos_produtos', function (Blueprint $table) {
            $table->dropForeign(['pedido_id']);
            $table->foreign('pedido_id')->references('id')->on('pedidos');

            $table->dropForeign(['produto_id']);
            $table->foreign('produto_id')->references('id')->on('produtos');
        });
    
    }
}
