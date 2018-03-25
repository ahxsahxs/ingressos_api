<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePedidoComplementosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedido_complemento', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('pedido_id');
            $table->enum('forma_pagamento', ['Cartão de Crédito', 'Cartão de Débito', 'Dinheiro', 'Cortesia']);
            $table->string('cartao_numero')->nullable();
            $table->string('cartao_vencimento')->nullable();
            $table->unsignedInteger('parcelas')->default(1);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('pedido_id')
                ->references('id')->on('pedidos')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pedido_complemento');
    }
}
