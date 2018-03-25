<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePdvsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pdv', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('data_entrega');
            $table->string('serial');
            $table->string('marca');
            $table->string('modelo');
            $table->unsignedDecimal('taxa');
            $table->string('tipo_pdv');
            $table->unsignedInteger('usuario_id');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('usuario_id')
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
        Schema::dropIfExists('pdv');
    }
}
