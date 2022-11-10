<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beneficiaries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('apellidoP');
            $table->string('apellidoM');
            $table->string('img');
            $table->date('fechaNac');
            $table->string('curp');
            $table->integer('noTel');
            $table->string('claveEsc');
            $table->integer('idProg')->unsigned();
            $table->integer('idTipo')->unsigned();
            $table->date('fechaIngreso');
            $table->string('enhina');
            $table->boolean('enhinaDoc');
            $table->boolean('actaDeNac');
            $table->boolean('curpDoc');
            $table->boolean('compDeDom');
            $table->boolean('ine');
            $table->boolean('cartaDeSeg');
            $table->boolean('cartaVac');
            $table->boolean('compDisc');
            $table->boolean('credDisc');
            $table->boolean('actaConst');
            $table->boolean('cartaComp');
            $table->boolean('comodato');
            $table->boolean('supHig');
            $table->boolean('supProtCiv');
            $table->timestamps();

            $table->foreign('idProg')->references('id')->on('programs');
            $table->foreign('idTipo')->references('id')->on('types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('beneficiaries');
    }
};
