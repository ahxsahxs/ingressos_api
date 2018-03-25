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
            $table->increments('id');
            $table->unsignedDecimal('valor_bruto');
            $table->unsignedDecimal('valor_final');
            $table->unsignedDecimal('desconto');
            $table->unsignedDecimal('taxa_mp');
            $table->dateTime('data_aprovacao');
            $table->unsignedInteger('usuario_id');
            $table->unsignedInteger('pdv_id');
            $table->boolean('status');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('usuario_id')
                ->references('id')->on('usuario')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            $table->foreign('pdv_id')
                ->references('id')->on('pdv')
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
        Schema::dropIfExists('pedidos');
    }
}
