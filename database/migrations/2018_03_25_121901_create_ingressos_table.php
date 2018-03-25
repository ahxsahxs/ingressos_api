<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIngressosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingressos', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('sexo', ['M', 'F', 'U']);
            $table->unsignedInteger('pedido_id');
            $table->unsignedInteger('lote_id');
            $table->string('codigo_leitura');
            $table->unsignedInteger('leitor_id')->nullable();
            $table->enum('status', ['Não Aprovado', 'Aprovado', 'Lido'])
                ->default('Não Aprovado');
            $table->decimal('valor');
            $table->dateTime('data_leitura');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('lote_id')
                ->references('id')->on('lotes')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            $table->foreign('leitor_id')
                ->references('id')->on('usuario')
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
        Schema::dropIfExists('ingressos');
    }
}
