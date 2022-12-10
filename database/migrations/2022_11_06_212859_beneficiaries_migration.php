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
            $table->string('noTel');
            $table->string('claveEsc');
            $table->integer('idProg')->unsigned();
            $table->integer('idTipo')->unsigned();
            $table->date('fechaIngreso');
            $table->string('enhina');
            $table->string('enhinaDoc');
            $table->string('actaDeNac');
            $table->string('curpDoc');
            $table->string('compDeDom');
            $table->string('ine');
            $table->string('cartaDeSeg');
            $table->string('cartaVac');
            $table->string('compDisc');
            $table->string('credDisc');
            $table->string('actaConst');
            $table->string('cartaComp');
            $table->string('comodato');
            $table->string('supHig');
            $table->string('supProtCiv');
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
