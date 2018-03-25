<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eventos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->string('cidade');
            $table->string('estado');
            $table->string('pais');
            $table->string('coordenadas');
            $table->dateTime('data');
            $table->boolean('passaporte')->default(FALSE);
            $table->boolean('destaque')->default(FALSE);
            $table->string('img_topo')->nullable();
            $table->string('img_rodape')->nullable();
            $table->string('img_anuncio')->nullable();
            $table->longText('descricao');
            $table->boolean('ativo')->default(TRUE);
            $table->boolean('exibir_valor')->default(TRUE);
            $table->unsignedInteger('usuario_inclusao_id');
            $table->unsignedInteger('usuario_responsavel_id');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('usuario_inclusao_id')
                ->references('id')->on('usuario')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            $table->foreign('usuario_responsavel_id')
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
        Schema::dropIfExists('eventos');
    }
}
