<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAmbientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ambientes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->unsignedInteger('evento_id');
            $table->unsignedInteger('grupo_ambiente_id');
            $table->string('img_topo');
            $table->string('img_rodape');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('evento_id')
                ->references('id')->on('eventos')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            $table->foreign('grupo_ambiente_id')
                ->references('id')->on('grupo_ambientes')
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
        Schema::dropIfExists('ambientes');
    }
}
